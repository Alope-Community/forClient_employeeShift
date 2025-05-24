<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftReport extends Model
{
    protected $fillable = [
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
