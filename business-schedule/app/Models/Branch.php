<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Branch extends Model
{
    use HasFactory;

    protected $table = 'branch';

    protected $fillable = [
        'name',
        'business_id'
    ];

    protected $weekDay = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];

    public function branchtime(){
        return $this->hasMany(BranchTime::class, 'branch_id');
    }

    public function branchimage(){
        return $this->hasMany(BranchImage::class, 'branch_id');
    }

    public function business(){
        return $this->belongsTo(Business::class, 'business_id');
    }
}
