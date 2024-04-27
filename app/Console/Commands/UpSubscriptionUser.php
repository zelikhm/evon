<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpSubscriptionUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
          User\Subscription::updateOrCreate([
            'user_id' => $user->id,
          ], [
            'active' => 1,
            'finished_at' => Carbon::now()->addDays(365),
            'free' => 0,
            'free_link' => 0
          ]);
        }
    }
}
