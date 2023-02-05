<?php

namespace App\Observers;

use App\Models\Vaccination;

class DaysObserver
{
 public function Days(Vaccination $vaccination){
        $day=$vaccination->day;
        $month = $vaccination->month;
        // $calmonth = $month * 30;
        $year = $vaccination->year;
        // $calyear = $year *365;
        // $caldays = $day + $calmonth + $calyear;
        $caldays = $day + $month * 30 + $year * 365;
        $vaccination->days = $caldays;
        $vaccination->save();
        // // dd($days);
        // return $days;

    }

    /**
     * Handle the Vaccination "created" event.
     *
     * @param  \App\Models\Vaccination  $vaccination
     * @return void
     */
    public function created(Vaccination $vaccination)
    {
        // $this->Days($vaccination);
    }

    /**
     * Handle the Vaccination "updated" event.
     *
     * @param  \App\Models\Vaccination  $vaccination
     * @return void
     */
    public function updated(Vaccination $vaccination)
    {
        // $this->Days($vaccination);
    }

    /**
     * Handle the Vaccination "deleted" event.
     *
     * @param  \App\Models\Vaccination  $vaccination
     * @return void
     */
    public function deleted(Vaccination $vaccination)
    {
        //
    }

    /**
     * Handle the Vaccination "restored" event.
     *
     * @param  \App\Models\Vaccination  $vaccination
     * @return void
     */
    public function restored(Vaccination $vaccination)
    {
        //
    }

    /**
     * Handle the Vaccination "force deleted" event.
     *
     * @param  \App\Models\Vaccination  $vaccination
     * @return void
     */
    public function forceDeleted(Vaccination $vaccination)
    {
        //
    }
}
