<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ShiftReportNotification extends Notification
{
    use Queueable;

    protected $employeeName;
    protected $cutiTanggal;
    protected $alasan;

    /**
     * Create a new notification instance.
     */
    public function __construct($employeeName, $cutiTanggal, $alasan)
    {
        $this->employeeName = $employeeName;
        $this->cutiTanggal = $cutiTanggal;
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
            'title' => 'Pengajuan Cuti',
            'message' => "Karyawan {$this->employeeName} mengajukan cuti pada tanggal {$this->cutiTanggal}. Alasan: {$this->alasan}",
            'employee_name' => $this->employeeName,
            'tanggal' => $this->cutiTanggal,
            'alasan' => $this->alasan,
        ];
    }
}
