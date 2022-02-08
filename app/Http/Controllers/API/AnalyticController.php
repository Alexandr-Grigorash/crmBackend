<?php

namespace App\Http\Controllers\API;
//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
use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Visit;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Redis;

class AnalyticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    public function analytic(Request $request){
        $startingDate = ($request->startingDate != 0) ? $request->startingDate : date("Y-m-01");
        $finalDate = ($request->finalDate != 0) ? $request->finalDate : date("Y-m-d");

        $visits = DB::table('visits')
            ->select(DB::raw('DATE(date) as label, count(*) as data'))
            ->whereBetween('date', array(new DateTime($startingDate), new DateTime($finalDate)))
            ->groupBy('label')
            ->orderByDesc('label')
            ->get();

        $device = DB::table('visits')
            ->select(DB::raw('count(*) as data, device as label'))
            ->whereBetween('date', array(new DateTime($startingDate), new DateTime($finalDate)))
            ->groupBy('device')
            ->orderByDesc('data')
            ->get();

        $department = DB::table('leads')
            ->select(DB::raw('count(*) as data, department as label'))
            ->whereBetween('date', array(new DateTime($startingDate), new DateTime($finalDate)))
            ->groupBy('department')
            ->orderByDesc('data')
            ->get();

        $stage = DB::table('leads')
            ->select(DB::raw('count(*) as data, stage as label'))
            ->whereBetween('date', array(new DateTime($startingDate), new DateTime($finalDate)))
            ->groupBy('stage')
            ->orderByDesc('data')
            ->get();

        $screen = DB::table('visits')
            ->select(DB::raw('count(*) as data, screen as label'))
            ->whereBetween('date', array(new DateTime($startingDate), new DateTime($finalDate)))
            ->groupBy('screen')
            ->orderByDesc('data')
            //->take(5)
            ->get();

        //Redis::set('name', 'Taylor');
        error_log(Redis::get('Visit:*'));

        return response()->json([
            "success" => true,
            "visits" => $visits,
            "device" => $device,
            "department" => $department,
            "stage" => $stage,
            "screen" => $screen,
        ]);
    }
}
