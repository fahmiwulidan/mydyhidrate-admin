<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'time',
        'reminder_time',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
