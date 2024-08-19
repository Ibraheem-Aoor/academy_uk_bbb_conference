<?php

namespace App\Console\Commands;

use App\Models\AllRecording;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DownloadPresentations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:presentations';
    protected $description = 'Download BBB presentations for all recordings';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        info('START');
        // Retrieve all meetings
        $meetings = AllRecording::query()->inRandomOrder()->limit(3)->get();
        info($meetings);

        foreach ($meetings as $meeting) {
            $meeting_id = $meeting->record_id;

            // Prepare the Python script command
            $command = [
                'python',
                base_path('bbb-download/scripts/download_presentation.py'),
                'https://bbb.academy-uk.net',
                $meeting_id
            ];

            // Run the command
            $process = new Process($command);
            $process->setTimeout(1000000000);
            $process->run();

            // Check if the process was successful
            if (!$process->isSuccessful()) {
                info('Error for meeting:('.$meeting_id.') : ' . $process->getErrorOutput());
                throw new ProcessFailedException($process);
            }
            $meeting->is_backed_up = true;
            $meeting->save();
            // Output the result of the command
            info("Downloaded presentation for meeting ID: {$meeting_id}");
        }
        info('END');

        return 0;
    }
}
