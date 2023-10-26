<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchTime extends Model
{
    use HasFactory;

    protected $table = 'branchtime';


    protected $fillable = [
       
        'startDate',
        'endDate',
        'branch_id',
        'startTime',
        'endTime',
        'closed'

    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
