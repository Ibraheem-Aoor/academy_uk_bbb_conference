<?php

namespace App\Notifications;

use App\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingScheduled extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected  $meeting)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $startTime = $this->meeting->start_date . ' ' . $this->meeting->start_time;
        $endTime = $this->meeting->end_date . ' ' . $this->meeting->end_time;
        $link = !is_null(getAuthUser('web')) ? route('site.user.join_public_meeting', ($this->meeting->meeting_id)) : route('site.join_public_meeting', encrypt($this->meeting->id));
        return (new MailMessage)
            ->subject('Meeting Scheduled: ' . $this->meeting->name)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('You are invited to the following meeting:')
            ->line('**Meeting Name:** ' . $this->meeting->name)
            ->line('**Description:** ' . $this->meeting->welcome_message)
            ->line('**Start Time:** ' . Carbon::parse($startTime)->format('l, F j, Y g:i A') . ' (' . config('app.timezone') . ')')
            ->line('**End Time:** ' . Carbon::parse($endTime)->format('l, F j, Y g:i A') . ' (' . config('app.timezone') . ')')
            ->action('Join Meeting', $link)
            ->line('We look forward to your participation.')
            ->line('Thank you!')
            ->salutation('Best regards,')
            ->salutation(config('app.name') . ' Team');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
