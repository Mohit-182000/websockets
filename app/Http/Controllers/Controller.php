<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\City;
use App\Model\Country;
use App\Model\Locality;
use App\Model\Role;
use App\Model\State;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [] ;

    public function view($view , $data =  []) {
        return view($view , $this->data ,$data);
    }


    public function getCountry(Request $request)
    {

        $search = $request->get('search');
        $id = $request->get('id');

        $data = Country::when($id, function ($query, $id) {
            $query->where('id', $id);
        })
        ->where('name', 'like', '%' . $search . '%')
        ->where('is_active','Yes')
        ->orderBy('name' ,'asc')
        ->get();

        return response()->json($data->toArray());

    }


    public function getState(Request $request)
    {

        $search = $request->get('search');
        $id = $request->get('id');

        $data = State::when($id, function ($query, $id) {
            $query->where('country_id', $id);
        })
        ->where('name', 'like', '%' . $search . '%')
        ->where('is_active','Yes')
        ->orderBy('name' ,'asc')
        ->get();

        return response()->json($data->toArray());
    }


    public function getCity(Request $request)
    {
        $search = $request->get('search');
        $id = $request->get('id');

        $data = City::when($id, function ($query, $id) {

            $query->where('state_id', $id);
        })
        ->where('name', 'like', '%' . $search . '%')
        ->where('is_active','Yes')
        ->orderBy('name' ,'asc')
        ->get();

        return response()->json($data->toArray());

    }

    public function getLocality(Request $request)
    {
        $search = $request->get('search');
        $id = $request->get('id');

        $data = Locality::when($id, function ($query, $id) {

            $query->where('city_id', $id);
        })
        ->where('name', 'like', '%' . $search . '%')
        ->where('is_active','Yes')
        ->orderBy('name' ,'asc')
        ->get();

        return response()->json($data->toArray());

    }

    public function getCityFromState(Request $request)
    {
        $data = City::where('state_id', $request->state_id)
        ->where('is_active','Yes')
        ->orderBy('name' ,'asc')
        ->get();

        return response()->json($data);

    }

    public function getRole(Request $request) {

        $search = $request->get('search');

        $id = $request->get('id');

        $data = Role::where('name', 'like', '%' . $search . '%')->where('is_active' ,'Yes')->get();

        return response()->json($data->toArray());

    }

    public function getCategory(Request $request) {
        //dd($request->all());
        $search = $request->get('search');
        $id = $request->get('id');
        $data = Category::when($id, function ($query, $id) {
            $query->where('id', $id);
        })
        ->where('category_name', 'like', '%' . $search . '%')
        ->where('is_active','Yes')
        ->orderBy('category_name' ,'asc')
        ->get();

        return response()->json($data->toArray());
       // $tree = $request->get('tree');
        //$defaultLanguage = Language::defaltLanguage()->first();

        // if ($tree) {
        //     $data = $this->fetchCategoryTree($parent = null, $spacing = '', $user_tree_array = []);
        // }else{
        //     $data = Category::select('categories.id','categories.id','category_name')

        //     ->where('categories.is_active' ,'Yes')->get()->toArray();
        // }

        //return response()->json($data);
    }
    public function getNewsCity(Request $request){
        $search = $request->get('search');
        $id = $request->get('id');
        $data = NewCity::when($id, function ($query, $id) {
            $query->where('id', $id);
        })
        ->where('name', 'like', '%' . $search . '%')
        ->where('is_active','Yes')
        ->orderBy('name' ,'asc')
        ->get();

        return response()->json($data->toArray());

    }

    function fetchCategoryTree($parent = null, $spacing = '', $user_tree_array = '')
    {
        if (!is_array($user_tree_array))
            $user_tree_array = array();

        $category = Category::select('categories.id','categories.parent_id','category_name')->where('categories.is_active' ,'Yes')
        ->getCategoryById($parent)->get();

        foreach ($category as $key => $row) {
            $user_tree_array[] = array("id" => $row->id, "name" => $spacing . $row->category_name);
            $user_tree_array = $this->fetchCategoryTree($row->id, $spacing.'---- ', $user_tree_array);
        }

        return $user_tree_array;
    }

    public function getUnit(Request $request)
    {

        $search = $request->get('search');
        $id = $request->get('id');
        $data = Unit::where('name', 'like', '%' . $search . '%')
                ->where('is_active' ,'Yes')
                ->get();

        return response()->json($data->toArray());
    }

    public function getHsnCode(Request $request)
    {

        $search = $request->get('search');
        $id = $request->get('id');
        $data = Tax::where('name', 'like', '%' . $search . '%')
                ->where('is_active' ,'Yes')
                ->get();

        return response()->json($data->toArray());
    }

    public function getDeliveryChallan(Request $request) {

        $search = $request->get('search');
        $id = $request->get('id');

        $data = Transaction::select('id' , 't_no as name')
        ->where('t_type' , 'SH')
        ->when(Session::has('branch_id') , function ($q){
            $q->where('contact_id' , Session::get('branch_id') );
        })
        ->where('t_type' , 'SH')
        ->where('t_no', 'like', '%' . $search . '%')->get();

        return response()->json($data->toArray());

    }

    public function getItemPackage(Request $request) {

        $search = $request->get('search');
        $id = $request->get('id');

        $data = ItemPackage::with('package')
        ->where('item_id' , $id)
        ->get()
        ->map(function($item) {
            return [
                'id' => $item->id ,
                'name' => $item->package->name
            ];
        });

        return response()->json($data->toArray());

    }

    public function checkExist(Request $request)
    {
        $table = $request->table;
        $column = $request->column;
        $value = $request->value;
        $id = $request->id;
        $rel_col = $request->rel_col;
        $sec_rel_col = $request->sec_rel_col;

        $countRec = DB::table($table)
            ->when($id != null, function ($query) use ($request) {
                return $query->where('id', '!=', $request->id);
            })
            ->when($rel_col != null, function ($query) use ($request) {
                return $query->where($request->rel_col, '=', $request->rel_val);
            })
            ->when($sec_rel_col != null, function ($query) use ($request) {
                return $query->where($request->sec_rel_col, '=', $request->sec_rel_val);
            })
            ->where($column, $value)
            ->count();

        if ($countRec > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

    // public function getPrivacyPolicy(){
    //     $this->data['privacy_policy'] = PrivacyPolicy::first();
        
    //     if($this->data['privacy_policy']){
    //         return view('admin.privacy_policy.index',$this->data);
    //     }

    //     return view('admin.privacy_policy.index');

    // }

}
