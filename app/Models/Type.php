<?php

namespace App\Models;

use App\Models\Exhibition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;

    public function exhibitions()
    {
        return $this->hasMany(Exhibition::class, 'type_id');
    }
}
