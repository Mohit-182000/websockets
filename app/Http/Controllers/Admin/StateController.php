<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StateFormRequest;
use App\Traits\DatatablTrait;
use Illuminate\Http\Request;
use App\Model\State;

class StateController extends Controller
{
    use DatatablTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.state.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['html' =>  view('admin.state.create')->render()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateFormRequest $request)
    {

        //dd($request);
        $add = new State();
        $add->name = $request->name;
        $add->added_by = NULL;
        $add->updated_by = NULL;

        $add->save();

        return redirect()->route('admin.state.index')->with('success', __('state.store_success'));
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
            1 => 'name',
            2 => 'is_active',
            3 => 'action',
        );

        $totalData = State::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = State::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%");
        });

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($customcollections as $key => $item) {
            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;

            $row['name'] =  $item->name;

            $row['is_active'] = $this->status($item->is_active, $item->id, route('change-status', ['id' => $item->id]), 'states');
            //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => __('common.edit'),
                    'id' => $item->id,
                    'action' => route('admin.state.edit', $item->id),
                    'target' => '#editstate',
                    'icon' => 'fas fa-cogs text-dark-pastel-green',
                ]),
                collect([
                    'text' => __('common.delete'),
                    'id' => $item->id,
                    'action' => route('admin.state.destroy', $item->id),
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
        $this->data['state'] = State::findorfail($id);
        $html =  view('admin.state.edit', $this->data)->render();
        return response()->json(['html' => $html], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StateFormRequest $request, $id)
    {

        $update = State::findorfail($id);
        $update->name = $request->name;
        $update->save();

        return redirect()->route('admin.state.index')->with('success', __('state.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $delete = State::findOrFail($id);

        $countRelation = $delete->secureDelete(['city','job_post']); 
        
        if($countRelation){
            return response()->json([
                'success' => true,
                'message' => 'This State Already In Use',
            ], 400);
        }else{
            $delete->delete();
            return response()->json([
                'success' => true,
                'message' => __('state.delete_success'),
            ], 200);
        }


    }
}
