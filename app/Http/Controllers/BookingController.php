<?php

namespace App\Http\Controllers;

use App\Mail\BookingMailable;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
            'service' => 'required|string',
            'date'    => 'required|date|after_or_equal:today',
            'time'    => 'required|string',
            'branch'  => 'required|string',
            'note'    => 'nullable|string|max:500',
        ]);

        $booking = Booking::create($validated);

        Mail::to('nhatnguyen27042005@gmail.com')->send(new BookingMailable($booking));

        $this->sendMessenger($booking);

        return response()->json(['success' => true]);
    }

    private function sendMessenger(Booking $booking): void
    {
        $token = config('services.facebook.page_access_token');
        $psid  = config('services.facebook.psid');

        if (!$token || !$psid) return;

        $date = \Carbon\Carbon::parse($booking->date)->format('d/m/Y');
        $note = $booking->note ? "\n📝 Ghi chú: {$booking->note}" : '';

        $text = "🗓️ ĐẶT LỊCH MỚI – LUTRA Beauty\n"
              . "──────────────────\n"
              . "👤 {$booking->name}\n"
              . "📞 {$booking->phone}\n"
              . "💅 {$booking->service}\n"
              . "📅 {$date} lúc {$booking->time}\n"
              . "📍 {$booking->branch}"
              . $note;

        try {
            Http::post("https://graph.facebook.com/v21.0/me/messages?access_token={$token}", [
                'recipient' => ['id' => $psid],
                'message'   => ['text' => $text],
            ]);
        } catch (\Throwable $e) {
            Log::error('Messenger notification failed: ' . $e->getMessage());
        }
    }
}
