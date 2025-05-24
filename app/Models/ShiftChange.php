<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftChange extends Model
{
    protected $fillable = [
        'shift_report_id',
        'approved_by',
        'status',
        'approved_at',
    ];

    public function shiftReport()
    {
        return $this->belongsTo(ShiftReport::class);
    }

    public function approver()
    {
        return $this->belongsTo(ShiftLeader::class, 'approved_by');
    }
}
