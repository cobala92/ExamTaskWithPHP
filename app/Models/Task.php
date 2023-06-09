<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'numbers',
        'status',
        'start_date',
        'due_date',
        'assignee',
        'estimate',
        'actual',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }
}
