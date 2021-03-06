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
        // $schedule->call(function () {
        //     Investment::where('balance', '>', 0)
        //         ->where('status', 'approved')
        //         ->whereNotNull('verified_at')
        //         ->whereRaw('DATE(verified_at + INTERVAL 30 DAY) < DATE(NOW())')
        //         ->chunkById(500, function ($investments) {
        //             foreach ($investments as $investment) {
        //                 // dump($investment->id);
        //                 $balance = $investment->balance;
        //                 $returns = $investment->returns;
        //                 $weekly = $returns / 50;
        //                 $interest = ($weekly > $balance) ? $balance : $weekly;
        //                 creditInterestTable(
        //                     $investment->user_id,
        //                     $interest,
        //                     'Interest gained on investment',
        //                     $investment->id
        //                 );
        //                 $investment->decrement('balance', $interest);
        //                 $loan = abs($investment->loanAccountSum());
        //                 if ($loan > 0) {
        //                     $liquidation = ($loan > $interest) ? $interest : $loan;
        //                     creditLoanAccountTable($investment->user_id, $liquidation, 'Loan Liquidation', $investment->id);
        //                     debitInterestTable($investment->user_id, $liquidation, 'Loan liquidation', $investment->id);
        //                 }
        //             }
        //         });
        // })
        // // ->everyMinute();
        // ->weekly()
        // ->fridays();
        // ->appendOutputTo('/storage/app');

        $schedule->call(function () {
            
            // ::where('balance', '>', 0)
                // ->where('status', 'approved')
                // ->whereNotNull('verified_at')
                // ->whereRaw('DATE(verified_at + INTERVAL 30 DAY) < DATE(NOW())')
                Investment::chunk(500, function ($investments) {
                    foreach ($investments as $investment) {
                        dump($investment->id);
                        $balance = $investment->balance;
                        // $returns = $investment->returns;
                        $returns = 1;
                        $weekly = $returns ;
                        $interest = ($weekly > $balance) ? $balance : $weekly;
                        creditInterestTable(
                            $investment->user_id,
                            $interest,
                            'Interest gained on investment',
                            $investment->id
                        );
                        $investment->decrement('balance', $interest);
                        $loan = abs($investment->loanAccountSum());
                        if ($loan > 0) {
                            $liquidation = ($loan > $interest) ? $interest : $loan;
                            creditLoanAccountTable($investment->user_id, $liquidation, 'Loan Liquidation', $investment->id);
                            debitInterestTable($investment->user_id, $liquidation, 'Loan liquidation', $investment->id);
                        }
                    }
                });
        })
        ->everyMinute();
        // ->weekly()
        // ->fridays();
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
