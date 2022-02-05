<?php

namespace App\Http\Controllers\API;

use App\Models\Visit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class VisitController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        $visits  = Visit::whereDate('date', Carbon::today()->toDateString())
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
           /* 'visit_page' => 'required',
            'utm_source' => 'required',
            'utm_medium' => 'required',
            'utm_campaign' => 'required',
            'utm_content' => 'required',
            'utm_term' => 'required',
            'utm_referer' => 'required',
            'device' => 'required',
            'screen' => 'required',*/
            'ip' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $visit = Visit::create($input);

        return response()->json([
            "success" => true,
            "data" => $visit
        ]);
    }

    public function show(){
       // return response()->json(['error' => 'Not authorized.'],403);
    }
    public function update(){
        //return response()->json(['error' => 'Not authorized.'],403);
    }

    public function destroy(){
        return response()->json(['error' => 'Not authorized.'],403);
    }

    /*
    public function destroy(Visit $visit)
    {
        $visit->delete();
        return response()->json([
            "success" => true,
            "message" => "Product deleted successfully.",
            "data" => $visit
        ]);
    }
    */
}
