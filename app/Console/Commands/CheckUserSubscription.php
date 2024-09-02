<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\User\UserMeetingRoom;
use App\Models\User\UserRoom;
use Illuminate\Console\Command;

class CheckUserSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-rooms:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable User Expired Rooms and Enable Active Rooms';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $active_rooms = UserMeetingRoom::query()->where('start_date', today()->toDateString())->pluck('id');
        $expired_rooms = UserMeetingRoom::query()->where('end_date', today()->toDateString())->pluck('id');
        UserRoom::query()->whereIn('room_id', $active_rooms)->update(['status' => 1]);
        UserRoom::query()->whereIn('room_id', $expired_rooms)->update(['status' => 0]);
        return Command::SUCCESS;
    }
}
