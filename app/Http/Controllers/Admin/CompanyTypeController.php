<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\DatatablTrait;
use App\Http\Requests\CompanyTypeRequest;
use App\Model\CompanyType;
use Illuminate\Http\Request;

class CompanyTypeController extends Controller
{
    use DatatablTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.company_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['html' =>  view('admin.company_type.create')->render()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyTypeRequest $request)
    {
        $add = new CompanyType();
        $add->company_type = $request->company_type;
        $add->added_by = NULL;
        $add->updated_by = NULL;
        $add->save();

        return redirect()->route('admin.company-type.index')->with('success', 'Company Type Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\CompanyType  $companyType
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyType $companyType)
    {
        //
    }

    public function dataList(Request $request)
    {
        // Listing colomns to show
        
        $columns = array(
            0 => 'id',
            1 => 'company_type',
            2 => 'is_active',
            3 => 'action',
        );

        $totalData = CompanyType::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = CompanyType::when($search, function ($query, $search){
            return $query->where('company_type', 'LIKE', "%{$search}%")
                         ->orWhere('id', 'LIKE', "%{$search}%");
        });

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($customcollections as $key => $item) {
            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;

            $row['company_type'] =  $item->company_type;

            $row['is_active'] = $this->status($item->is_active, $item->id, route('change-status', ['id' => $item->id]), 'company_types');
            //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => __('common.edit'),
                    'id' => $item->id,
                    'action' => route('admin.company-type.edit', $item->id),
                    'target' => '#editstate',
                    'icon' => 'fas fa-cogs text-dark-pastel-green',
                ]),
                collect([
                    'text' => __('common.delete'),
                    'id' => $item->id,
                    'action' => route('admin.company-type.destroy', $item->id),
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
     * @param  \App\model\CompanyType  $companyType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['company_type'] = CompanyType::findorfail($id);
        $html =  view('admin.company_type.edit', $this->data)->render();
        return response()->json(['html' => $html], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\CompanyType  $companyType
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyTypeRequest $request, $id)
    {
        $update = CompanyType::findorfail($id);
        $update->company_type = $request->company_type;
        $update->save();

        return redirect()->route('admin.company-type.index')->with('success', 'Company Type Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\CompanyType  $companyType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $delete = CompanyType::findOrFail($id);
        // $delete->delete();
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Company Type Successfully Delete',
        // ], 200);

        $countRelation = $delete->secureDelete(['user']); 
        
        if($countRelation){
            return response()->json([
                'success' => true,
                'message' => 'This Company Type Already In Use',
            ], 400);
        }else{
            $delete->delete();
            return response()->json([
                'success' => true,
                'message' => 'Company Type Deleted Successfully',
            ], 200);
        }
    }
}
