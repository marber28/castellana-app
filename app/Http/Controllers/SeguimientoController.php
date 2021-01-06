<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\Tracking;
use App\Models\TrackingStatus;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        $trackings = Tracking::whereDoesntHave('statuses', function ($query) {
                    $query->where("status.code", "=", 'finished');
                })->get();

        return view('seguimiento.index', compact('statuses', 'trackings'));
    }

    public function tracking_list(Request $request)
    {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $totalRecords = Tracking::select('count(*) as allcount')
                ->count();

        $totalRecordswithFilter = Tracking::select('count(*) as allcount')
                ->where(function($query) use ($searchValue) {
                    $query->where('number', 'like', '%'.$searchValue.'%')
                        ->orWhere('reference', 'like', '%'.$searchValue.'%');
                })
                ->count();

        $items_array = [];

        $records = Tracking::
                    skip($start)
                    ->take($rowperpage)
                    ->where(function($query) use ($searchValue) {
                        $query->where('number', 'like', '%'.$searchValue.'%')
                            ->orWhere('reference', 'like', '%'.$searchValue.'%');
                    })
                    ->orderBy($columnName, $columnSortOrder)

                    ->get();

        foreach ($records as $key => $item) {
            $created_at = date('d-m-Y', strtotime($item->created_at));

            $items_array[] = array(
              "created_at" => $created_at,
              "number" => $item['number'],
              "reference" => $item['reference'],
              "tools" => $tools
            );
        };

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $items_array
        );

        echo json_encode($response);
        exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'number'       => 'string|required|unique:trackings',
            'reference'      => 'string|required',
            'status'      => 'required|exists:status,id',
        );
        $this->validate($request, $rules);

        $tracking = new Tracking();
        
        $tracking->number = $request->input('number');
        $tracking->reference = $request->input('reference');

        $tracking->save();

        $tracking_status = new TrackingStatus();
        $tracking_status->tracking_id = $tracking->id;
        $tracking_status->status_id = $request->input('status');
        $tracking_status->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $tracking = [];
        return view('seguimiento.search', compact('tracking'));
    }

    public function show(Request $request)
    {
        $number = $request->input('number');

        $tracking = Tracking::where('number', $number)->firstOrFail();
        
        return view('seguimiento.search', compact('tracking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $tracking_id = $request->input('tracking_id');
        $rules = array(
            'number'       => 'string|required|unique:trackings,id,'.$tracking_id,
            'reference'      => 'string|required',
            'status'      => 'required|exists:status,id',
        );
        $this->validate($request, $rules);

        $tracking = Tracking::findOrFail($tracking_id);
        $tracking->number = $request->input('number');
        $tracking->reference = $request->input('reference');
        $tracking->save();

        $tracking_status = new TrackingStatus();
        $tracking_status->tracking_id = $tracking->id;
        $tracking_status->status_id = $request->input('status');
        $tracking_status->save();

        return redirect()->back();
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
