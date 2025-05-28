<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ShiftReportNotification extends Notification
{
    use Queueable;

    protected $reportId;
    protected $employeeName;
    protected $shiftTanggal;
    protected $alasan;

    /**
     * Create a new notification instance.
     */
    public function __construct($reportId, $employeeName, $shiftTanggal, $alasan)
    {
        $this->reportId = $reportId;
        $this->employeeName = $employeeName;
        $this->shiftTanggal = $shiftTanggal;
        $this->alasan = $alasan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'report_id' => $this->reportId,
            'title' => 'Pengajuan Pergantian Shift',
            'message' => "Karyawan {$this->employeeName} mengajukan pergantian shift pada tanggal {$this->shiftTanggal}. Alasan: {$this->alasan}",
            'employee_name' => $this->employeeName,
            'tanggal' => $this->shiftTanggal,
            'alasan' => $this->alasan,
        ];
    }
}
