<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'report_date',
        'document_type',
        'user_id'
    ];

    protected $casts = [
        'report_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope para filtrar por tipo
    public function scopeType($query, $type)
    {
        return $query->where('document_type', $type);
    }
}