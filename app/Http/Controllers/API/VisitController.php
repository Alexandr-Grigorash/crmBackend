<?php

namespace App\Http\Controllers\API;

use App\Models\Visit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;

class VisitController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        $visits = Visit::whereDate('date', Carbon::today()->toDateString())
            ->orderByDesc('date')
            ->take(50)
            ->get();

        return response()->json([
            "success" => true,
            "data" => $visits,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'date' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        Redis::rpush('Vst', json_encode($input));
        Redis::lrange('Vst',0,-1);


        //$visit = Visit::create($input);
        return response()->json([
            "success" => true,
            //"data" => $visit
        ]);
    }

    public function show()
    {
        return response()->json(['error' => 'Not authorized.'], 403);
    }

    public function update()
    {
        return response()->json(['error' => 'Not authorized.'], 403);
    }

    public function destroy()
    {
        return response()->json(['error' => 'Not authorized.'], 403);
    }

}
