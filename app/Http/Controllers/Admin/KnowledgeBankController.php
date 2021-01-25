<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KnowledgeBankFormRequest;
use App\Traits\DatatablTrait;
use Illuminate\Http\Request;
use App\Model\KnowledgeBank;
use Illuminate\Support\Facades\Storage;


class KnowledgeBankController extends Controller
{
    use DatatablTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.knowledge_bank.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.knowledge_bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnowledgeBankFormRequest $request)
    {
        //dd($request);
        $add = new KnowledgeBank();
        $add->title = $request->title;
        $add->media_type = $request->media_type;
        $add->file = uploadImage('file', 'knowledge');
        $add->link = $request->link;
        $add->description = $request->description;
        $add->added_by = NULL;
        $add->updated_by = NULL;

        $add->save();

        return redirect()->route('admin.knowledge-bank.index')->with('success', __('knowledge_bank.store_success'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $knowledge_bank= KnowledgeBank::findorfail($id);
        return view('admin.knowledge_bank.view', compact('knowledge_bank'));
    }

    public function dataList(Request $request)
    {
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'description',
            3 => 'is_active',
            4 => 'action',
        );

        $totalData = KnowledgeBank::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = KnowledgeBank::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%");
        });

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($customcollections as $key => $item) {
            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;

            $row['title'] =  '<div style="white-space:normal;">'.$item->title.'</div>';
            $row['description'] =  str_limit($item->description, 60);

            $row['is_active'] = $this->status($item->is_active, $item->id, route('change-status', ['id' => $item->id]), 'knowledge_banks');
            //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => __('common.view'),
                    'id' => $item->id,
                    'action' => route('admin.knowledge-bank.show', $item->id),
                    'icon' => 'fas fa-eye text-orange-red',
                ]),
                collect([
                    'text' => __('common.edit'),
                    'id' => $item->id,
                    'action' => route('admin.knowledge-bank.edit', $item->id),
                    'icon' => 'fas fa-cogs text-dark-pastel-green',
                ]),
                collect([
                    'text' => __('common.delete'),
                    'id' => $item->id,
                    'action' => route('admin.knowledge-bank.destroy', $item->id),
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
    public function edit(Request $request,$id)
    {
        $this->data['knowledge_bank'] = KnowledgeBank::findorfail($id);
        return view('admin.knowledge_bank.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KnowledgeBankFormRequest $request, $id)
    {
        
        $link = null;
        $file = null;

        if($request->media_type == 2){
            $link = $request->link;
        }

        $update = KnowledgeBank::findorfail($id);

        if($request->media_type == 1){
            $file = uploadImage('file', 'knowledge', $update->file);
        }

        $update->title = $request->title;
        $update->media_type = $request->media_type;
        $update->file = $file;
        $update->link = $link;
        $update->description = $request->description;
        
        $update->save();

        // dd($request->all());

        return redirect()->route('admin.knowledge-bank.index')->with('success', __('knowledge_bank.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        $delete = KnowledgeBank::find($id);
        Storage::delete('knowledge/' . $delete->file);
        $delete->delete();
        return response()->json([
            'success' => true,
            'message' => __('knowledge_bank.delete_success'),
        ], 200);
    }
    
}
