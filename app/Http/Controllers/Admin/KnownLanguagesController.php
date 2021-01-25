<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\KnownLanguagesFormRequest;
use App\Model\KnownLanguages;
use App\Traits\DatatablTrait;
use Illuminate\Http\Request;
class KnownLanguagesController extends Controller
{
    use DatatablTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.known_languages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['html' =>  view('admin.known_languages.create')->render()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnownLanguagesFormRequest $request)
    {
        //dd($request);
        $add = new KnownLanguages();
        $add->name = $request->name;
        $add->added_by = NULL;
        $add->updated_by = NULL;

        $add->save();

        return redirect()->route('admin.known-languages.index')->with('success', __('known_languages.store_success'));
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

        $totalData = KnownLanguages::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = KnownLanguages::when($search, function ($query, $search) {
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

            $row['is_active'] = $this->status($item->is_active, $item->id, route('change-status', ['id' => $item->id]), 'known_languages');
            //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => __('common.edit'),
                    'id' => $item->id,
                    'action' => route('admin.known-languages.edit', $item->id),
                    'target' => '#editknown_languages',
                    'icon' => 'fas fa-cogs text-dark-pastel-green',
                ]),
                collect([
                    'text' => __('common.delete'),
                    'id' => $item->id,
                    'action' => route('admin.known-languages.destroy', $item->id),
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
        $this->data['known_languages'] = KnownLanguages::findorfail($id);
        $html =  view('admin.known_languages.edit', $this->data)->render();
        return response()->json(['html' => $html], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KnownLanguagesFormRequest $request, $id)
    {

        $update = KnownLanguages::findorfail($id);
        $update->name = $request->name;
        $update->save();

        return redirect()->route('admin.known-languages.index')->with('success', __('known_languages.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delete = KnownLanguages::findOrFail($id);
        // $delete->delete();
        // return response()->json([
        //     'success' => true,
        //     'message' => __('known_languages.delete_success'),
        // ], 200);

        $countRelation = $delete->secureDelete(['user','job_post']); 
        
        if($countRelation){
            return response()->json([
                'success' => true,
                'message' => 'This Known languages Already In Use',
            ], 400);
        }else{
            $delete->delete();
            return response()->json([
                'success' => true,
                'message' => __('known_languages.delete_success'),
            ], 200);
        }
    }
}
