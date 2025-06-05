<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftReport extends Model
{
    protected $fillable = [
        'from_employee_id',
        'employee_id',
        'from_shift_id',
        'to_shift_id',
        'title',
        'description',
        'time',
        'address',
        'image',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function fromEmployee()
    {
        return $this->belongsTo(Employee::class, 'from_employee_id');
    }

    public function fromShift()
    {
        return $this->belongsTo(Shift::class, 'from_shift_id');
    }

    public function toShift()
    {
        return $this->belongsTo(Shift::class, 'to_shift_id');
    }

    public function shiftChange()
    {
        return $this->hasOne(ShiftChange::class);
    }
}
