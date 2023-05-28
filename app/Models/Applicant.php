<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    
    // Relationship with Application model
    public function applications()
    {
        return $this->hasMany(Application::class, 'applicant_id');
    }
}
