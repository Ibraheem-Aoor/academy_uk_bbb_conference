<?php
namespace App\Exports;

use App\Models\Meeting;
use App\Models\User\UserMeeting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Font;

class MeetingExport implements FromCollection, WithHeadings, WithTitle, WithProperties , ShouldAutoSize
{
    protected $meeting;

    public function __construct($meeting)
    {
        $this->meeting = $meeting;
    }

    public function collection()
    {
        $participants = $this->meeting->participants;
        if($this->meeting instanceof UserMeeting)
        {
            $participants = $this->meeting->createdParticipants;
        }
        return $participants->map(function ($participant) {
            return [
                'participant_name' => $participant->name,
                'password' => $participant->bridge_password,
                'join_url' => $participant->bridge_url,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Participant Name',
            'Password',
            'Join URL',
        ];
    }

    public function title(): string
    {
        return $this->meeting->name;
    }

    public function properties(): array
    {
        return [
            'title'          => $this->meeting->name,
        ];
    }

}
