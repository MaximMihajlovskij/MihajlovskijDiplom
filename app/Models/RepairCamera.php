<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Completed;

class RepairCamera extends Model
{
    protected $table = 'repairscameras';

    protected $fillable = [
        'user_id',
        'name_camera',
        'DateCreateRepair',
        'image',
        'telephon',
        'email',
        'ProblemDescription',
        'status_id',
        'complete_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class,'status_id');
    }

    public function complete()
    {
        return $this->belongsTo(Completed::class,'complete_id');
    }
}
