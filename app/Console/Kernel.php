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
        // SELECT *,  verified_at + INTERVAL 30 DAY  FROM `investments` WHERE ;
        $schedule->call(function () {
            Investment::where('balance', '>', 0)
                ->whereNotNull('verified_at')
                // ->whereRaw('(verified_at + INTERVAL 30 DAY) < NOW()')
                ->chunkById(500, function ($investments) {
                    foreach ($investments as $investment) {
                        $amount = $investment->amount;
                        $balance = $investment->balance;
                        $interest = ($amount * 4) / 100;
                        dump($balance, $interest);
                        $left = $balance - $interest;
                        creditInterestTable(
                            $investment->user_id,
                            $interest,
                            'Interest gained',
                            $investment->id
                        );
                        dump($left);
                        $investment->balance = $left;
                        $investment->save();
                    }
                });
        })
        ->everyMinute();
        // ->weekly()
        // ->fridays()
        // ->appendOutputTo('/storage/app');
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
