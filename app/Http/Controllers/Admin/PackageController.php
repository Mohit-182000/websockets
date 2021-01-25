<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Package;
use Illuminate\Http\Request;
use App\Traits\DatatablTrait;

class PackageController extends Controller
{
    use DatatablTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['employer_package'] = Package::where('package_user_type','EMPLOYER')->first();
        $this->data['jobseeker_package'] = Package::where('package_user_type','JOBSEEKER')->first();

        return view('admin.package.edit',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['html' =>  view('admin.package.create')->render()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Package();
        $add->name = $request->name;
        $add->price = $request->price;
        $add->validity = $request->validity;
        $add->description = $request->description;
        $add->package_user_type = $request->package_user_type;
        $add->save();

        return redirect()->route('admin.package.index')->with('success', 'Package Created Successfully');
    }

    public function dataList(Request $request)
    {
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'price',
            3 => 'validity',
            4 => 'is_active',
            5 => 'action',
        );

        $totalData = Package::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Package::when($search, function ($query, $search) {
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
            $row['price'] =  $item->price;
            $row['validity'] =  $item->validity;

            $row['is_active'] = $this->status($item->is_active, $item->id, route('change-status', ['id' => $item->id]), 'packages');
            
            $row['action'] = $this->action([
                collect([
                    'text' => __('common.edit'),
                    'id' => $item->id,
                    'action' => route('admin.package.edit', $item->id),
                    'target' => '#edit_package',
                    'icon' => 'fas fa-cogs text-dark-pastel-green',
                ]),
                collect([
                    'text' => __('common.delete'),
                    'id' => $item->id,
                    'action' => route('admin.package.destroy', $item->id),
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
        // $this->data['package'] = Package::findorfail($id);
        // $html =  view('admin.package.edit', $this->data)->render();
        // return response()->json(['html' => $html], 200);
        $this->data['package'] = Package::find($id);


        if($this->data['package']){
            return view('admin.package.edit',$this->data);
        }else{
            return view('admin.package.edit');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $update =  Package::findorfail($id);
        // $update->name = $request->name;
        // $update->price = $request->price;
        // $update->validity = $request->validity;
        // $update->save();

        // return redirect(route('admin.package.edit',1));
        // return redirect()->route('admin.package.index')->with('success', 'Package   Updated Successfully');
        // dd($request->all());

        $update =  Package::firstOrNew(['id' => $id]);
        $update->name = $request->name;
        $update->price = $request->price;
        $update->description = $request->description;
        $update->package_user_type = $request->package_user_type;
        $update->validity = $request->validity;
        $update->save();

        return redirect(route('admin.package.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Package::findOrFail($id);
        $delete->delete();

        return response()->json([
            'success' => true,
            'message' => 'Package Deleted Successfully',
        ], 200);

    }
}
