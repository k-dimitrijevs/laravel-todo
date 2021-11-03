<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    protected $dates = [
        'completed_at'
    ];

    public function toggleComplete(): void
    {
        $this->completed_at = $this->completed_at ? null : now();
    }

}
