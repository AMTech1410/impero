<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $table = 'business';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'logo',
    ];

    public function branch(){
        return $this->hasMany(Branch::class, 'business_id');
    }
}
