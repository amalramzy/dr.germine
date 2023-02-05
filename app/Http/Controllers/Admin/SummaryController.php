<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expense;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;


class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = __('messages.Today Summary');
        $now = Carbon::now()->format('d-m-y');
        $datePeriod = Carbon::now()->format('d-m-y');
        $reservationsCount = 0;
        $vaccinationCount = 0;
        $followUpsCount = 0;
        $totalRevenues = 0;
        $totalExpenses = 0;
        $waitingTimeAverage = 0;
        $reservationTimeAverage = 0;
        $from = 0;
        $to = 0;

        if ($request->has('from') && $request->has('to')) {
            $from = $request->from;
            $to = $request->to;
            if ($request->from != null && $request->to != null) {
                $reservationsCount = Reservation::where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->count();
                $vaccinationCount = Reservation::where('type', 'vaccination')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->count();
                $followUpsCount = Reservation::where('is_follow_up', '1')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->count();
                $totalRevenues = Expense::whereDate('date', '>=', $from)->whereDate('date', '<=', $to)->where('type', 'revenues')->sum('price');
                $totalExpenses = Expense::whereDate('date', '>=', $from)->whereDate('date', '<=', $to)->where('type', 'expenses')->sum('price');

                $waitingTimeAverage = Reservation::select(DB::raw('DATE(arrive_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(enter_time, arrive_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
                if ($waitingTimeAverage != null) {
                    $waitingTimeAverage = ($waitingTimeAverage->timediff / 60);
                } else {
                    $waitingTimeAverage = 0;
                }

                $reservationTimeAverage = Reservation::select(DB::raw('DATE(enter_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(finish_time, enter_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
                if ($reservationTimeAverage != null) {
                    $reservationTimeAverage = ($reservationTimeAverage->timediff / 60);
                } else {
                    $reservationTimeAverage = 0;
                }
                $datePeriod = __('messages.From') . " " . $from . " " . __('messages.To')." ". $to;
                $title = __('messages.Summary');
            } else if ($request->from != null || $request->to != null) {
                if ($request->from != null) {
                    $reservationsCount = Reservation::where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->where('status', 'finished')->count();
                    $vaccinationCount = Reservation::where('type', 'vaccination')->whereDate('special_datetime', '>=', $from)->where('status', 'finished')->count();
                    $followUpsCount = Reservation::where('is_follow_up', '1')->whereDate('special_datetime', '>=', $from)->where('status', 'finished')->count();
                    $totalRevenues = Expense::whereDate('date', '>=', $from)->where('type', 'revenues')->sum('price');
                    $totalExpenses = Expense::whereDate('date', '>=', $from)->where('type', 'expenses')->sum('price');

                    $waitingTimeAverage = Reservation::select(DB::raw('DATE(arrive_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(enter_time, arrive_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
                    if ($waitingTimeAverage != null) {
                        $waitingTimeAverage = ($waitingTimeAverage->timediff / 60);
                    } else {
                        $waitingTimeAverage = 0;
                    }

                    $reservationTimeAverage = Reservation::select(DB::raw('DATE(enter_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(finish_time, enter_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
                    if ($reservationTimeAverage != null) {
                        $reservationTimeAverage = ($reservationTimeAverage->timediff / 60);
                    } else {
                        $reservationTimeAverage = 0;
                    }
                    $datePeriod = $from;
                    $title = __('messages.Today Summary');
                }
                if ($request->to != null) {
                    $reservationsCount = Reservation::where('type', 'examanation')->whereDate('special_datetime', $to)->where('status', 'finished')->count();
                    $vaccinationCount = Reservation::where('type', 'vaccination')->whereDate('special_datetime', $to)->where('status', 'finished')->count();
                    $followUpsCount = Reservation::where('is_follow_up', '1')->whereDate('special_datetime', $to)->where('status', 'finished')->count();
                    $totalRevenues = Expense::whereDate('date', $to)->where('type', 'revenues')->sum('price');
                    $totalExpenses = Expense::whereDate('date', $to)->where('type', 'expenses')->sum('price');

                    $waitingTimeAverage = Reservation::select(DB::raw('DATE(arrive_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(enter_time, arrive_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
                    if ($waitingTimeAverage != null) {
                        $waitingTimeAverage = ($waitingTimeAverage->timediff / 60);
                    } else {
                        $waitingTimeAverage = 0;
                    }

                    $reservationTimeAverage = Reservation::select(DB::raw('DATE(enter_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(finish_time, enter_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
                    if ($reservationTimeAverage != null) {
                        $reservationTimeAverage = ($reservationTimeAverage->timediff / 60);
                    } else {
                        $reservationTimeAverage = 0;
                    }
                    $datePeriod = $to;
                    $title = __('messages.Today Summary');
                }
            } else {
                $reservationsCount = Reservation::where('type', 'examanation')->whereDate('special_datetime', $now)->where('status', 'finished')->count();
                $vaccinationCount = Reservation::where('type', 'vaccination')->whereDate('special_datetime', $now)->where('status', 'finished')->count();
                $followUpsCount = Reservation::where('is_follow_up', '1')->whereDate('special_datetime', $now)->where('status', 'finished')->count();
                $totalRevenues = Expense::whereDate('date', $now)->where('type', 'revenues')->sum('price');
                $totalExpenses = Expense::whereDate('date', $now)->where('type', 'expenses')->sum('price');

                $waitingTimeAverage = Reservation::select(DB::raw('DATE(arrive_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(enter_time, arrive_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
                if ($waitingTimeAverage != null) {
                    $waitingTimeAverage = ($waitingTimeAverage->timediff / 60);
                } else {
                    $waitingTimeAverage = 0;
                }

                $reservationTimeAverage = Reservation::select(DB::raw('DATE(enter_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(finish_time, enter_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
                if ($reservationTimeAverage != null) {
                    $reservationTimeAverage = ($reservationTimeAverage->timediff / 60);
                } else {
                    $reservationTimeAverage = 0;
                }
            }
        } else {
            $reservationsCount = Reservation::where('type', 'examanation')->whereDate('special_datetime', $to)->where('status', 'finished')->count();
            $vaccinationCount = Reservation::where('type', 'vaccination')->whereDate('special_datetime', $to)->where('status', 'finished')->count();
            $followUpsCount = Reservation::where('is_follow_up', '1')->whereDate('special_datetime', $to)->where('status', 'finished')->count();
            $totalRevenues = Expense::whereDate('date', $to)->where('type', 'revenues')->sum('price');
            $totalExpenses = Expense::whereDate('date', $to)->where('type', 'expenses')->sum('price');

            $waitingTimeAverage = Reservation::select(DB::raw('DATE(arrive_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(enter_time, arrive_time))) AS timediff'))->whereDate('special_datetime', $now)->where('status', 'finished')->groupBy('start_date')->first();
            if ($waitingTimeAverage != null) {
                $waitingTimeAverage = ($waitingTimeAverage->timediff / 60);
            } else {
                $waitingTimeAverage = 0;
            }

            $reservationTimeAverage = Reservation::select(DB::raw('DATE(enter_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(finish_time, enter_time))) AS timediff'))->whereDate('special_datetime', $now)->where('status', 'finished')->groupBy('start_date')->first();
            if ($reservationTimeAverage != null) {
                $reservationTimeAverage = ($reservationTimeAverage->timediff / 60);
            } else {
                $reservationTimeAverage = 0;
            }
        }
        return view('admin.summary.index', compact('datePeriod', 'title', 'from', 'to', 'reservationsCount', 'vaccinationCount', 'followUpsCount', 'totalRevenues', 'totalExpenses', 'waitingTimeAverage', 'reservationTimeAverage'));














        // $title = __('messages.Today Summary');
        // $now = Carbon::now()->format('d-m-y');
        // $datePeriod = Carbon::now()->format('d-m-y');
        // $reservationsCount = 0;
        // $vaccinationCount = 0;
        // $followUpsCount = 0;
        // $totalRevenues = 0;
        // $totalExpenses = 0;
        // $waitingTimeAverage = 0;
        // $reservationTimeAverage = 0;

        // if ($request->ajax()) {
        //     $from = $request->from;
        //     $to = $request->to;
        //     if ($request->has('from') && $request->has('to')) {
        //         if ($request->from != null && $request->to != null) {
        //             $reservationsCount = Reservation::where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->count();
        //             $vaccinationCount = Reservation::where('type', 'vaccination')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->count();
        //             $followUpsCount = Reservation::where('is_follow_up', '1')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->count();
        //             $totalRevenues = Expense::whereDate('date', '>=', $from)->whereDate('date', '<=', $to)->where('type', 'revenues')->sum('price');
        //             $totalExpenses = Expense::whereDate('date', '>=', $from)->whereDate('date', '<=', $to)->where('type', 'expenses')->sum('price');

        //             $waitingTimeAverage = Reservation::select(DB::raw('DATE(arrive_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(enter_time, arrive_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
        //             if ($waitingTimeAverage != null) {
        //                 $waitingTimeAverage = ($waitingTimeAverage->timediff / 60);
        //             } else {
        //                 $waitingTimeAverage = 0;
        //             }

        //             $reservationTimeAverage = Reservation::select(DB::raw('DATE(enter_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(finish_time, enter_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
        //             if ($reservationTimeAverage != null) {
        //                 $reservationTimeAverage = ($reservationTimeAverage->timediff / 60);
        //             } else {
        //                 $reservationTimeAverage = 0;
        //             }
        //             $datePeriod = __('messages.From')." ".$from." ".__('messages.To').$to;
        //             $title = __('messages.Summary');

        //             // dd([$reservationsCount, $vaccinationCount, $followUpsCount, $totalRevenues, $totalExpenses, $waitingTimeAverage, $reservationTimeAverage]);
        //         } else if ($request->from != null || $request->to != null) {
        //             if ($request->from != null) {
        //                 $reservationsCount = Reservation::where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->where('status', 'finished')->count();
        //                 $vaccinationCount = Reservation::where('type', 'vaccination')->whereDate('special_datetime', '>=', $from)->where('status', 'finished')->count();
        //                 $followUpsCount = Reservation::where('is_follow_up', '1')->whereDate('special_datetime', '>=', $from)->where('status', 'finished')->count();
        //                 $totalRevenues = Expense::whereDate('date', '>=', $from)->where('type', 'revenues')->sum('price');
        //                 $totalExpenses = Expense::whereDate('date', '>=', $from)->where('type', 'expenses')->sum('price');

        //                 $waitingTimeAverage = Reservation::select(DB::raw('DATE(arrive_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(enter_time, arrive_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
        //                 if ($waitingTimeAverage != null) {
        //                     $waitingTimeAverage = ($waitingTimeAverage->timediff / 60);
        //                 } else {
        //                     $waitingTimeAverage = 0;
        //                 }

        //                 $reservationTimeAverage = Reservation::select(DB::raw('DATE(enter_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(finish_time, enter_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
        //                 if ($reservationTimeAverage != null) {
        //                     $reservationTimeAverage = ($reservationTimeAverage->timediff / 60);
        //                 } else {
        //                     $reservationTimeAverage = 0;
        //                 }
        //                 $datePeriod = $from;
        //                 $title = __('messages.Today Summary');

        //             }
        //             if ($request->to != null) {
        //                 $reservationsCount = Reservation::where('type', 'examanation')->whereDate('special_datetime', $to)->where('status', 'finished')->count();
        //                 $vaccinationCount = Reservation::where('type', 'vaccination')->whereDate('special_datetime', $to)->where('status', 'finished')->count();
        //                 $followUpsCount = Reservation::where('is_follow_up', '1')->whereDate('special_datetime', $to)->where('status', 'finished')->count();
        //                 $totalRevenues = Expense::whereDate('date', $to)->where('type', 'revenues')->sum('price');
        //                 $totalExpenses = Expense::whereDate('date', $to)->where('type', 'expenses')->sum('price');

        //                 $waitingTimeAverage = Reservation::select(DB::raw('DATE(arrive_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(enter_time, arrive_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
        //                 if ($waitingTimeAverage != null) {
        //                     $waitingTimeAverage = ($waitingTimeAverage->timediff / 60);
        //                 } else {
        //                     $waitingTimeAverage = 0;
        //                 }

        //                 $reservationTimeAverage = Reservation::select(DB::raw('DATE(enter_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(finish_time, enter_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
        //                 if ($reservationTimeAverage != null) {
        //                     $reservationTimeAverage = ($reservationTimeAverage->timediff / 60);
        //                 } else {
        //                     $reservationTimeAverage = 0;
        //                 }
        //                 $datePeriod = $to;
        //                 $title = __('messages.Today Summary');
        //             }
        //         } else {
        //             $reservationsCount = Reservation::where('type', 'examanation')->whereDate('special_datetime', $now)->where('status', 'finished')->count();
        //             $vaccinationCount = Reservation::where('type', 'vaccination')->whereDate('special_datetime', $now)->where('status', 'finished')->count();
        //             $followUpsCount = Reservation::where('is_follow_up', '1')->whereDate('special_datetime', $now)->where('status', 'finished')->count();
        //             $totalRevenues = Expense::whereDate('date', $now)->where('type', 'revenues')->sum('price');
        //             $totalExpenses = Expense::whereDate('date', $now)->where('type', 'expenses')->sum('price');

        //             $waitingTimeAverage = Reservation::select(DB::raw('DATE(arrive_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(enter_time, arrive_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
        //             if ($waitingTimeAverage != null) {
        //                 $waitingTimeAverage = ($waitingTimeAverage->timediff / 60);
        //             } else {
        //                 $waitingTimeAverage = 0;
        //             }

        //             $reservationTimeAverage = Reservation::select(DB::raw('DATE(enter_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(finish_time, enter_time))) AS timediff'))->where('type', 'examanation')->whereDate('special_datetime', '>=', $from)->whereDate('special_datetime', '<=', $to)->where('status', 'finished')->groupBy('start_date')->first();
        //             if ($reservationTimeAverage != null) {
        //                 $reservationTimeAverage = ($reservationTimeAverage->timediff / 60);
        //             } else {
        //                 $reservationTimeAverage = 0;
        //             }
        //         }
        //     } else {
        //         $reservationsCount = Reservation::where('type', 'examanation')->whereDate('special_datetime', $to)->where('status', 'finished')->count();
        //         $vaccinationCount = Reservation::where('type', 'vaccination')->whereDate('special_datetime', $to)->where('status', 'finished')->count();
        //         $followUpsCount = Reservation::where('is_follow_up', '1')->whereDate('special_datetime', $to)->where('status', 'finished')->count();
        //         $totalRevenues = Expense::whereDate('date', $to)->where('type', 'revenues')->sum('price');
        //         $totalExpenses = Expense::whereDate('date', $to)->where('type', 'expenses')->sum('price');

        //         $waitingTimeAverage = Reservation::select(DB::raw('DATE(arrive_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(enter_time, arrive_time))) AS timediff'))->whereDate('special_datetime', $now)->where('status', 'finished')->groupBy('start_date')->first();
        //         if ($waitingTimeAverage != null) {
        //             $waitingTimeAverage = ($waitingTimeAverage->timediff / 60);
        //         } else {
        //             $waitingTimeAverage = 0;
        //         }

        //         $reservationTimeAverage = Reservation::select(DB::raw('DATE(enter_time) AS start_date, AVG(TIME_TO_SEC(TIMEDIFF(finish_time, enter_time))) AS timediff'))->whereDate('special_datetime', $now)->where('status', 'finished')->groupBy('start_date')->first();
        //         if ($reservationTimeAverage != null) {
        //             $reservationTimeAverage = ($reservationTimeAverage->timediff / 60);
        //         } else {
        //             $reservationTimeAverage = 0;
        //         }
        //     }

        //     $testObject = Expense::where('type', '0')->get();
        //     return Datatables::of($testObject)
        //         ->addColumn('Date', function () use ($datePeriod) {
        //             $data = $datePeriod;
        //             return $data;
        //         })
        //         ->addColumn('NumberOfReservations', function () use ($reservationsCount) {
        //             $data = $reservationsCount;
        //             return $data;
        //         })
        //         ->addColumn('NumberOfVaccination', function () use ($vaccinationCount) {
        //             $data = $vaccinationCount;
        //             return $data;
        //         })
        //         ->addColumn('NumberOfFollowUps', function () use ($followUpsCount) {
        //             $data = $followUpsCount;
        //             return $data;
        //         })
        //         ->addColumn('TotalRevenues', function () use ($totalRevenues) {
        //             $data = $totalRevenues;
        //             return $data;
        //         })
        //         ->addColumn('TotalExpenses', function () use ($totalExpenses) {
        //             $data = $totalExpenses;
        //             return $data;
        //         })
        //         ->addColumn('WaitingTimeAverage', function () use ($waitingTimeAverage) {
        //             $data = $waitingTimeAverage.' Min';
        //             return $data;
        //         })
        //         ->addColumn('ReservationTimeAverage', function () use ($reservationTimeAverage) {
        //             $data = $reservationTimeAverage.' Min';
        //             return $data;
        //         })
        //         ->rawColumns([])
        //         ->make(true);
        // }

        // if ($request->from && $request->to) {
        //     $from = $request->from;
        //     $to = $request->to;
        //     return view('admin.summary.index', compact('datePeriod','title','from','to'));
        // }

        // return view('admin.summary.index',compact('datePeriod','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
