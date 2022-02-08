<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Lead;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        $leads = Lead::all();
        /*$leads  = Lead::whereDate('date', Carbon::today()->toDateString())
            ->orderByDesc('date')
            ->take(100)
            ->get();
        */
        return response()->json([
            "success" => true,
            "data" => $leads,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_id' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $lead = Lead::create($input);
        return response()->json([
            "success" => true,
            "message" => "Product created successfully.",
            "data" => $lead
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $lead = Lead::find($id);
        if (is_null($lead)) {
            return $this->sendError('Product not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Product retrieved successfully.",
            "data" => $lead
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Lead $lead)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'type' => 'required',
            'date' => 'required',
            'stage' => 'required',
            'price' => 'required',
            'department' => 'required',
            'fio' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'pay' => 'required',
            'device' => 'required',
            'info' => 'required',
            'order_number' => 'required',
            'utm_source' => 'required',
            'utm_medium' => 'required',
            'utm_campaign' => 'required',
            'utm_content' => 'required',
            'utm_term' => 'required',
            'referer_page' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $lead->user_id = $input['user_id'];
        $lead->type = $input['type'];
        $lead->date = $input['date'];
        $lead->stage = $input['stage'];
        $lead->price = $input['price'];
        $lead->department = $input['department'];
        $lead->fio = $input['fio'];
        $lead->phone = $input['phone'];
        $lead->email = $input['email'];
        $lead->pay = $input['pay'];
        $lead->device = $input['device'];
        $lead->info = $input['info'];
        $lead->order_number = $input['order_number'];
        $lead->utm_source = $input['utm_source'];
        $lead->utm_medium = $input['utm_medium'];
        $lead->utm_campaign = $input['utm_campaign'];
        $lead->utm_content = $input['utm_content'];
        $lead->utm_term = $input['utm_term'];
        $lead->referer_page = $input['referer_page'];
        $lead->save();
        return response()->json([
            "success" => true,
            "message" => "Product updated successfully.",
            "data" => $lead
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return response()->json([
            "success" => true,
            "message" => "Product deleted successfully.",
            "data" => $lead
        ]);
    }
}
