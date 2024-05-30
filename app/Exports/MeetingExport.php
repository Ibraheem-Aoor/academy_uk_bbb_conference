<?php
namespace App\Exports;

use App\Models\Meeting;
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

    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    public function collection()
    {
        return $this->meeting->participants->map(function ($participant) {
            return [
                'participant_name' => $participant->name,
                'join_url' => $participant->join_url,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Participant Name',
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
