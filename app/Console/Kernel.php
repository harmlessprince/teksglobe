<?php

namespace App\Console;

use App\Models\Investment;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $date = now()->subDays(30);
            Investment::where('balance', '>', 0)
                ->whereDate('created_at', '>', $date)
                ->chunkById(500, function ($investments) {
                    foreach ($investments as $investment) {
                        $balance = $investment->balance;
                        $interest = ($balance * 4) / 100;
                        dump($balance, $interest);
                        $left = $balance - $interest;
                        creditInterestTable(
                            $investment->user_id,
                            $investment->id,
                            $interest,
                            'Interest gained'
                        );
                        dump($left);
                        $investment->balance = $left;
                        $investment->save();
                    }
                });
        })
        ->everyMinute()
        // ->weekly()
        // ->fridays()
        ->appendOutputTo('/storage/app');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
