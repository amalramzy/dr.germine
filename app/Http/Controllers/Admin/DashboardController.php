<?php

namespace App\Http\Controllers\Admin;

use Akaunting\Apexcharts\Charts;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Child;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function getGenderGraph(){
        $males = Child::where('gender','male')->count();
        $females = Child::where('gender','female')->count();

        $chart = (new Charts())->setType('donut')
            ->setTitle('Children')
            ->setSubtitle('')
            ->setColors(["#2892fd","#4fc6e1","#4a81d4","#00b19d","#f1556c"])
            ->setWidth('100%')
            ->setHeight(400)
            ->setFillType('gradient')
            ->setLabels(['male', 'female'])
            ->setDataset('Children', 'donut', [$males, $females]);
        return $chart;
    }

    public function getReservationsGraph(){
        $today = Carbon::today();
        $labels = [];
        $data =[];
        foreach (range(0,15) as $num){
            $date = $today->addDays($num);
            $labels[] = $date->toDateString();
            $data[] = Reservation::whereDate('special_datetime',$date)->count();
        }
        $chart = (new Charts())->setType('area')
            ->setTitle('Reservations')
            ->setSubtitle('')
            ->setColors(["#f1556c"])
            ->setWidth('100%')
            ->setStrokeColors(['undefined'])
            ->setHeight(300)
            ->setFillType('gradient')
            ->setLabels($labels)
            ->setYaxisShow(false)
            ->setYaxisDecimalsInFloat(false)
            ->setDataset('Children', 'area', $data);
        return $chart;
    }

    public function getAreasGraph(){
        $data =[];
        $labels =[];
        foreach (Area::all() as $area){
            $labels[] =$area->name;
            $data[] = User::where('area_id',$area->id)->count();
        }

        $chart = (new Charts())->setType('donut')
            ->setTitle('Areas')
            ->setSubtitle('')
            ->setColors(["#2892fd","#4fc6e1","#4a81d4","#00b19d","#f1556c"])
            ->setWidth('100%')
            ->setStrokeColors(['undefined'])
            ->setHeight(300)
            ->setFillType('gradient')
            ->setLabels($labels)
            ->setYaxisShow(false)
            ->setYaxisDecimalsInFloat(false)
            ->setDataset('areas', 'donut', $data);
        return $chart;
    }

    public function index(){
        $dayNow = Carbon::now();

        $childChart = $this->getGenderGraph();
        $reservationChart = $this->getReservationsGraph();
        $areasChart = $this->getAreasGraph();
        return view('admin-dashboard.dashboard')->with(['childChart'=>$childChart,'reservationChart'=>$reservationChart,'areasChart'=>$areasChart,'dayNow'=>$dayNow]);
    }
}
