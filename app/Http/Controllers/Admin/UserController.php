<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Traits\DatatablTrait;
use Illuminate\Http\Request;
use Hash;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use DatatablTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $password = Hash::make($request->password);

        $add = new User();
        $add->name = $request->name;
        $add->email = $request->email;
        $add->user_type = 'Admin';
        $add->profile_image = uploadImage('file','profile_image');
        $add->password = $password;
        $add->save();

        return redirect()->route('admin.user.index')->with('success', __('user.store_success'));    
    }


    // public function uploadImage($request, $unlink = null)
    // {
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    //         $fileName = time() . '_' . rand(0, 500) . '_' . $file->getClientOriginalName();
    //         $fileName = str_replace(' ', '_', $fileName);
    //         $path = $file->storeAs('user', $fileName, ['disk' => 'public']);
    //         // if ($request->hasFile('file')) {
    //         //     File::delete(public_path() . 'user/', $request->file->name); // Delete old flyer
    //         // }
    //         if ($unlink) {
    //             Storage::delete('storage/',$unlink);
    //             unlink(public_path() . $file);
    //         }
    //         return $path;
    //     }
    //     return  $unlink ? $unlink : NULL;
    // }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = User::findorfail($id);
        return view('admin.user.overview', compact('admin'));
    }


    public function dataList(Request $request)
    {
        $user_id = Auth::user()->id;
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'profile',
            3 => 'is_active',
            4 => 'action',
        );

        $totalData = User::where('user_type','Admin')->whereNotIn('email',['info@mnstechnologies.com'])->count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = User::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%");
        })->where('user_type','Admin')->whereNotIn('email',['info@mnstechnologies.com'])->whereNotIn('id',[$user_id]);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($customcollections as $key => $item) {
            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;

            $row['name'] =  $item->name;
            $row['email'] =  $item->email;

                    if ($item->profile_image != NULL)
                        $img = asset('storage/' . $item->profile_image);
                        //dd($img);
                    else
                        $img = asset('storage/demo/user1.png');

            $row['profile'] = "<span class='mr-4'><img src='{$img}' class='rounded-circle' style='height: 60px !important; width:60px !important;'/></span>";
            // dd($row['profile']);

            $row['is_active'] = $this->status($item->is_active, $item->id, route('change-status', ['id' => $item->id]), 'users');
            //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => __('common.view'),
                    'id' => $item->id,
                    'action' => route('admin.user.show', $item->id),
                    'icon' => 'fas fa-eye text-orange-red',
                ]),
                collect([
                    'text' => __('common.edit'),
                    'id' => $item->id,
                    'action' => route('admin.user.edit', $item->id),
                    'icon' => 'fas fa-cogs text-dark-pastel-green',
                ]),
                collect([
                    'text' => __('common.delete'),
                    'id' => $item->id,
                    'action' => route('admin.user.destroy', $item->id),
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
        // dd($id);
        $this->data['user'] = User::findorfail($id);
        return view('admin.user.edit', $this->data);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {   
        $password = Hash::make($request->password);
        $update = User::findorfail($id);
        $update->name = $request->name;
        $update->email = $request->email;
        $update->password = $request->password;
        $update->user_type = 'Admin';
        //$update->profile = $this->uploadImage($request, $update->file);
        $update->profile_image = uploadImage('file','profile_image', $update->profile);
        $update->save();

        return redirect()->route('admin.user.index')->with('success', __('user.update_success'));
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
        $delete = User::find($id);
        Storage::delete($delete->profile_image);
        $delete->delete();
        
        return response()->json([
            'success' => true,
            'message' => __('user.delete_success'),
        ], 200);
    }
}
