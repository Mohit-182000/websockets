<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Traits\DatatablTrait;
use Illuminate\Http\Request;
use App\Model\Category;
class CategoryController extends Controller
{
    use DatatablTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::with('children')->whereNull('parent_id')->get();

        // return view('admin.category.index')->with([
        //     'categories'  => $categories
        // ]);

        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['categories'] = Category::whereNull('parent_id')->get();
        return response()->json(['html' =>  view('admin.category.create',$this->data)->render()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        // dd($request);
        $category = new Category();
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->added_by = NULL;
        $category->updated_by = NULL;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', __('category.create_success'));
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
            2 => 'parent_id',
            3 => 'is_active',
            4 => 'action',
        );

        $totalData = Category::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Category::with('parentCat')->when($search, function ($query, $search) {
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
            $row['parent_id'] =  ($item->parentCat != "") ? $item->parentCat->name :'-';
            $row['is_active'] = $this->status($item->is_active, $item->id, route('change-status', ['id' => $item->id]), 'categories');
            //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => __('common.edit'),
                    'id' => $item->id,
                    'action' => route('admin.category.edit', $item->id),
                    'target' => '#editcategory',
                    'icon' => 'fas fa-cogs text-dark-pastel-green',
                ]),
                collect([
                    'text' => __('common.delete'),
                    'id' => $item->id,
                    'action' => route('admin.category.destroy', $item->id),
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
        $this->data['category'] = Category::findorfail($id);
        $this->data['categories'] = Category::whereNull('parent_id')->get();
        $html =  view('admin.category.edit', $this->data)->render();
        return response()->json(['html' => $html], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, $id)
    {
        $update = Category::findorfail($id);
        $update->name = $request->name;
        $update->parent_id = $request->parent_id;
        $update->save();

        return redirect()->route('admin.category.index')->with('success', __('category.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

    
        $countRelation = $category->secureDelete(['user']); 
        
        if($countRelation){
            return response()->json([
                'success' => true,
                'message' => 'This Category Already In Use',
            ], 400);
        }else{
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category Deleted Successfully',
            ], 200);
        }

        // if($category->skill()->exists()){
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'This Category Already In Use',
        //     ], 500);
        // }else{
        //     $category->delete();
        //     return response()->json([
        //         'success' => true,
        //         'message' => __('state.delete_success'),
        //     ], 200);
        // }
    }
}
