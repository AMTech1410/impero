<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchTime extends Model
{
    use HasFactory;

    protected $table = 'branchtime';


    protected $fillable = [
       
        'weekdays',
        'startDate',
        'endDate',
        'branch_id'

    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
