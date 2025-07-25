<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'employee_id',
        'shift_id',
        'date',
        'end_date',
        'is_replaced',
        'replaced_with',
    ];
    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function replacedWith() {
        return $this->belongsTo(Employee::class, 'replaced_with');
    }
}
