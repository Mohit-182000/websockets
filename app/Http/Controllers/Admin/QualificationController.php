<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QualificationFormRequest;
use App\Model\Qualification;
use App\Traits\DatatablTrait;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    use DatatablTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.qualification.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['html' =>  view('admin.qualification.create')->render()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QualificationFormRequest $request)
    {
        //dd($request);
        $add = new Qualification();
        $add->name = $request->name;
        $add->is_show_in_feild_of_study = $request->is_show_in_feild_of_study ?? null;
        $add->added_by = NULL;
        $add->updated_by = NULL;
        
        $add->save();

        return redirect()->route('admin.qualification.index')->with('success', __('qualification.store_success'));
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

        $totalData = Qualification::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Qualification::when($search, function ($query, $search) {
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

            $row['is_active'] = $this->status($item->is_active, $item->id,route('change-status', ['id' => $item->id]),'qualifications');
                //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => __('common.edit'),
                    'id' => $item->id,
                    'action' => route('admin.qualification.edit', $item->id),
                    'target' => '#editqualification',
                    'icon' => 'fas fa-cogs text-dark-pastel-green',
                ]),
                collect([
                    'text' => __('common.delete'),
                    'id' => $item->id,
                    'action' => route('admin.qualification.destroy', $item->id),
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

        $this->data['qualification'] = Qualification::findorfail($id);
        $html =  view('admin.qualification.edit', $this->data)->render();
        return response()->json(['html' => $html], 200);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QualificationFormRequest $request, $id)
    {
        $update = Qualification::findorfail($id);
        $update->name = $request->name;
        $update->is_show_in_feild_of_study = $request->is_show_in_feild_of_study ?? null;
        $update->save();

        return redirect()->route('admin.qualification.index')->with('success', __('qualification.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delete = Qualification::findOrFail($id);
        // $delete->delete();
        // return response()->json([
        //     'success' => true,
        //     'message' => __('qualification.delete_success'),
        // ], 200);

        $countRelation = $delete->secureDelete(['job_post']); 
        
        if($countRelation){
            return response()->json([
                'success' => true,
                'message' => 'This Qualification Already In Use',
            ], 400);
        }else{
            $delete->delete();
            return response()->json([
                'success' => true,
                'message' => __('qualification.delete_success'),
            ], 200);
        }
    }
}
