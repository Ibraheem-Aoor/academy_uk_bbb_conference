<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckUserSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-account:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check User Accounts And Disable If Subscription Expired';

    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::query()->chunk(20, function ($users) {
            foreach ($users as $user) {
                $user->updateSubscriptionStatus();
            }
        });
        info('Update Users Subscription Status Command Done');
        return Command::SUCCESS;
    }
}
