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
        'status'
    ];

    protected $dates = ['due_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
