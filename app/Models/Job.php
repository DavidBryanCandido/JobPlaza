<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    // Relationship with Employer model
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    // Relationship with Application model
    public function application()
    {
        return $this->hasMany(Application::class);
    }
}
