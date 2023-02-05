<?php

namespace App\Console\Commands;

use App\Models\Area;
use Illuminate\Console\Command;

class FixAreas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:area';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        foreach (Area::all() as $item){
            $name = [
                "en"=>$item->name,
                "ar"=>$item->name,
            ];
            $item->name = $name;
            $item->save();
        }
        return 0;
    }
}
