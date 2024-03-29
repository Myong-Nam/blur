<?php

namespace App\Models;

use App\Models\Exhibition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function exhibitions()
    {
        return $this->belongsTo(Exhibition::class, 'exhibition_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
