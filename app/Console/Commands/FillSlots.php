<?php

namespace App\Console\Commands;

use App\Helpers\IsSunday;
use App\Models\Opening;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FillSlots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill:slots {clincId=1 : clinc id to fill it\'s slots and openings} {capacity=3 : the capacity for each slot} {startDate=01-01-2023 : fill dates starting with this date} {endDate=01-01-2024 : fill dates till this date}';

    // '01-01-2027'

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fill slots and openings for clinc';

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
     * @return int
     */
    public function handle()
    {
        $clincId = $this->argument('clincId');
        $capacity = $this->argument('capacity');
        $startDate = $this->argument('startDate');
        $EndDate = $this->argument('endDate');
        // $limit=0;
        $openings=[];
        $slots=[];
        for ($date = Carbon::parse($startDate); $date->lte(Carbon::parse($EndDate)); $date->addDay()) {
            // for testing purpuses
            // if($limit==2){
            //     break;
            // }
            $opening = [
                'date' => $date->toDateString(),
                'time' => '12:30',
                'clinc_id' => $clincId,
                'is_vacation'=>IsSunday::check($date)
            ];
            if(!Opening::where(['date'=>$date->toDateString(),'clinc_id'=>$clincId])->exists()){
                array_push($openings,$opening);
            }

            if(!IsSunday::check($date)){
                for ($time = Carbon::parse('14:00'); $time->lte(Carbon::parse('24:00')); $time->addMinutes(30)) {

                    $slot = [
                        'date' => $date->toDateString(),
                        'number' => $capacity,
                        'from' => $time->format('H:i'),
                        'to' => $time->copy()->addMinutes(30)->format('H:i'),
                        'clinc_id'=>$clincId
                    ];
                    if(!Slot::where(['date'=>$date->toDateString(),'clinc_id'=>$clincId])->exists()){
                        array_push($slots,$slot);
                    }

                }
            }

            // for testing purpuses
            // $limit = $limit+1;
        }
        Opening::insert($openings);
        Slot::insert($slots);
        return 0;
    }
}
