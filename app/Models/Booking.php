<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['name', 'phone', 'service', 'date', 'time', 'branch', 'note', 'status'];

    protected $casts = ['date' => 'date'];

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'confirmed'  => 'Đã xác nhận',
            'completed'  => 'Hoàn thành',
            'cancelled'  => 'Đã hủy',
            default      => 'Chờ xác nhận',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'confirmed'  => 'blue',
            'completed'  => 'green',
            'cancelled'  => 'red',
            default      => 'yellow',
        };
    }
}
