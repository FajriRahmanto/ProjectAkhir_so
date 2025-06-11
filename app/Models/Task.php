<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;    protected $fillable = [
        'title',
        'type',
        'due_date',
        'due_time',
        'priority',
        'description',
        'user_id',
        'status',
        'completed_at'
    ];    protected $casts = [
        'due_date' => 'date',
        'completed_at' => 'datetime',
        'due_time' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
