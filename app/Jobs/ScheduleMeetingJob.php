<?php

namespace App\Jobs;

use App\Models\Meeting;
use App\Notifications\MeetingScheduled;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;
use Spatie\GoogleCalendar\Event;
use \Illuminate\Support\Facades\Notification;

class ScheduleMeetingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Determine number of times the job may be attempted.
     */
    public function tries(): int
    {
        return 0;
    }

    public function retryUntil()
    {
        return now()->addHours(12);
    }

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected $meeting)
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->scheduleMeetingForparticipants();
        } catch (Throwable $e) {
            info('Error While Schedule Meeting In :' . __METHOD__ . ': ' . $e->getMessage());
        }
        return 0;
    }


    /**
     * Create Events On Google Calendar.
     */
    private function scheduleMeetingForParticipants()
    {
        // if (getAuthUser('admin')) {
        //     $event = new Event;
        //     $event->name = $this->meeting->welcome_message;
        //     $event->description = $this->meeting->welcome_message;
        //     $event->startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $this->meeting->start_date . ' ' . $this->meeting->start_time);
        //     $event->endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $this->meeting->end_date . ' ' . $this->meeting->end_time);
        //     $event->startDateTime->setTimezone(config('app.timezone'));
        //     $event->endDateTime->setTimezone(config('app.timezone'));
        //     $event->save();
        // }
        $participants = $this->meeting->participants()->whereNotNull('email')->get();
        Notification::send($participants, new MeetingScheduled($this->meeting));
    }

}
