<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($service = $request->input('service')) {
            $query->where('service', $service);
        }

        if ($date = $request->input('date')) {
            $query->whereDate('date', $date);
        }

        $bookings = $query->orderBy('date')->orderBy('time')->paginate(10)->withQueryString();

        // Calendar: lấy bookings trong tháng hiện tại (hoặc tháng được chọn)
        $calMonth = $request->input('cal_month', Carbon::now()->format('Y-m'));
        $calStart = Carbon::parse($calMonth . '-01')->startOfMonth();
        $calEnd   = $calStart->copy()->endOfMonth();

        $calBookings = Booking::whereBetween('date', [$calStart, $calEnd])
            ->orderBy('date')->orderBy('time')
            ->get()
            ->groupBy(fn($b) => $b->date->format('Y-m-d'));

        // Pre-format for JS (avoid complex closures inside @json in Blade)
        $calData = $calBookings->map(function ($items) {
            return $items->map(function ($b) {
                return [
                    'id'      => $b->id,
                    'name'    => $b->name,
                    'phone'   => $b->phone,
                    'service' => $b->service,
                    'time'    => $b->time,
                    'status'  => $b->status,
                    'label'   => $b->status_label,
                ];
            })->values();
        });

        $stats = [
            'total'     => Booking::count(),
            'today'     => Booking::whereDate('date', Carbon::today())->count(),
            'pending'   => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
        ];

        $services = Booking::distinct()->pluck('service');

        return view('admin.bookings.index', compact(
            'bookings', 'calBookings', 'calData', 'calStart', 'stats', 'services', 'calMonth'
        ));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,completed,cancelled']);
        $booking->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'status'  => $booking->status,
            'label'   => $booking->status_label,
            'color'   => $booking->status_color,
        ]);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(['success' => true]);
    }

    public function show(Booking $booking)
    {
        return response()->json([
            'id'      => $booking->id,
            'name'    => $booking->name,
            'phone'   => $booking->phone,
            'service' => $booking->service,
            'date'    => $booking->date->format('d/m/Y'),
            'time'    => $booking->time,
            'branch'  => $booking->branch,
            'note'    => $booking->note,
            'status'  => $booking->status,
            'label'   => $booking->status_label,
            'color'   => $booking->status_color,
            'created' => $booking->created_at->format('d/m/Y H:i'),
        ]);
    }
}
