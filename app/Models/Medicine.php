<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'dose',
        'description',
        'time',
        'duration',
        'taken',
        'taken_at',
    ];

    protected $casts = [
        'taken' => 'boolean',
        'taken_at' => 'datetime',
    ];

    public function schedules()
    {
        return $this->hasMany(MedicineSchedule::class);
    }
}
