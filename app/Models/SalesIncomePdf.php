<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesIncomePdf extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'report_date', // Asegúrate de que esté incluido
        'user_id'
    ];

    // Define explícitamente los campos que deben tratarse como fechas
    protected $dates = [
        'report_date',
        'created_at',
        'updated_at'
    ];

    // O en Laravel 8+ puedes usar casts
    protected $casts = [
        'report_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}