<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocalityFormRequest;
use Illuminate\Http\Request;
use App\Traits\DatatablTrait;
use App\Model\Locality;

class LocalityController extends Controller
{
    use DatatablTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.locality.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['html' =>  view('admin.locality.create')->render()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocalityFormRequest $request)
    {
        
        // dd($request->name);
        // $name = preg_replace('/\s+/', ' ', $request->name);
        
        $add = new Locality();
        $add->state_id = $request->state_id;
        $add->city_id = $request->city_id;
        $add->name = $request->name;
        $add->added_by = NULL;
        $add->updated_by = NULL;
        $add->save();

        return redirect()->route('admin.locality.index')->with('success', 'Locality Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function dataList(Request $request)
    {
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'state',
            2 => 'city',
            3 => 'locality',
            4 => 'is_active',
            5 => 'action',
        );

        $totalData = Locality::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Locality::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%");
        });

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];
        // dd($customcollections);
        foreach ($customcollections as $key => $item) {
            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;

            $row['state'] =  $item->state->name;
            // $row['category'] =  $item->pivot->name;
            $row['city'] =  $item->city->name;
            
            $row['locality'] =  $item->name;

            $row['is_active'] = $this->status($item->is_active, $item->id, route('change-status', ['id' => $item->id]), 'localities');
            //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => __('common.edit'),
                    'id' => $item->id,
                    'action' => route('admin.locality.edit', $item->id),
                    'target' => '#editlocality',
                    'icon' => 'fas fa-cogs text-dark-pastel-green',
                ]),
                collect([
                    'text' => __('common.delete'),
                    'id' => $item->id,
                    'action' => route('admin.locality.destroy', $item->id),
                    'icon' => 'fas fa-times text-orange-red',
                    'class' => 'delete-confrim',
                ])
            ]);

            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        return response()->json($json_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['locality'] = Locality::findorfail($id);

        $html =  view('admin.locality.edit',$this->data)->render();
        return response()->json(['html' => $html], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalityFormRequest $request, $id)
    {
        $update = Locality::findorfail($id);
        $update->state_id = $request->state_id;
        $update->city_id = $request->city_id;
        $update->name = $request->name;
        $update->save();

        return redirect()->route('admin.locality.index')->with('success', 'Locality Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Locality::findOrFail($id);

        $countRelation = $delete->secureDelete(['job_seeker']);

        if($countRelation){
            return response()->json([
                'success' => true,
                'message' => 'This Locality Already In Use',
            ], 400);
        }else{
            $delete->delete();
            return response()->json([
                'success' => true,
                'message' => __('state.delete_success'),
            ], 200);
        }

        // $delete->delete();
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Locality Delete Successfully',
        // ], 200);
    }
}
