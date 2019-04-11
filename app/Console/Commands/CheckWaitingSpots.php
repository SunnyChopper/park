<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\ParkingSpot;

class CheckWaitingSpots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spots:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This function automatically checks for any waiting spots that are overdue.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (ParkingSpot::where('status', 2)->count() == 0) {
            return;
        } else {
            $waiting_parking_spots = ParkingSpot::where('status', 2)->get();

            // Loop through and check last updated time
            foreach($waiting_parking_spots as $spot) {
                // get updated time
                $now = Carbon::now();
                $diff = $now->diffInSeconds($spot->updated_at);
                if ($diff > 30) {
                    $spot->status = 3;
                    $spot->save();
                }
            }
        }
    }
}
