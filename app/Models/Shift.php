<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'name',
        'group',
        'start_time',
        'end_time',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function employees()
    {
        return $this->hasManyThrough(Employee::class, Schedule::class, 'shift_id', 'id', 'id', 'employee_id');
    }
}
