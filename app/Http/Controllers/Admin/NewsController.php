<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\News;
use App\Model\NewsImage;
use App\Model\Category;
use App\Traits\DatatablTrait;
use File;
use Illuminate\Http\Response;
use Storage;
use Auth;
use Image;
use App\Admin;

class NewsController extends Controller
{
    use DatatablTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //
        $this->data['title'] = __('news.index_title');
       // dd($request->all());
        if($request->create){
           // $request->session()->forget('update');
            return redirect()->action('Admin\NewsController@index')->with('success','News created successfully');
            //\Session::flash('success',$request->create);
            //\Session::forget('create');


            
        }else if($request->update){
            //\Session::flash('success',$request->update);
            return redirect()->action('Admin\NewsController@index')->with('success','News updated successfully');
           // \Session::forget('update');
        }else{

        return $this->view('admin.news.index');
        }
    }

    public function repoterIndex()
    {

        $this->data['title'] = 'Repoter News';

        return $this->view('admin.repoter_news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $this->data['title'] = __('news.create_title');
        // $this->data['categoriesFilter'] = Category::where('parent_id', null)
        //     ->with('childrenCategories')
        //     ->get();
        // $this->data['parent_category'] = $this->fetchCategoryTrees();
        $this->data['parent_category'] = $this->fetchCategoryTrees();
        //dd($this->data['parent_category']);
        return $this->view('admin.news.create');
    }

    public function fetchCategoryTrees($parent = null, $spacing = '', $user_tree_array = '')
    {
        if (!is_array($user_tree_array))
            $user_tree_array = array();

        // $category = Category::getCategoryById($parent)->get();
        $category = Category::get();
        foreach ($category as $key => $row) {
            $user_tree_array[] = array("id" => $row->id, "name" => $spacing . $row->category_name);
            // $user_tree_array = $this->fetchCategoryTree($row->id, $spacing .html_entity_decode('&nbsp;&nbsp;&nbsp;'), $user_tree_array);
        }
        return $user_tree_array;
    }

    public function positionImage(Request $request, $package_id)
    {


        //dd($request->all());

        $postion = $request->input('image_id', []);

        if ($postion) {

            $postionIndex = 0; // start index with 0 ;

            foreach ($postion as $key => $value) {

                if ($value == '' || is_null($value)) {
                    continue;
                }

                $image = NewsImage::where('id', $value)->first();

                if ($image) {
                    $image->position = $postionIndex;
                    $image->save();
                    $postionIndex++;
                }

            }
        }

        return response()->json([
            'message' => 'sortable succefully.',
            'success' => true
        ]);

    }

    public function imageStore(Request $request)
    {
        // dd($request->all());
        $userID = \Illuminate\Support\Facades\Auth::guard('admin')->user()->id;

        $originalPath = public_path('storage/news_image/' . $request->id . '/');
        $originalPathThumb = public_path('storage/news_image/' . $request->id . '/thumb/');

        if (!File::isDirectory($originalPath)) {
            File::makeDirectory($originalPath, 0777, true, true);
        }
        if (!File::isDirectory($originalPathThumb)) {
            File::makeDirectory($originalPathThumb, 0777, true, true);
        }
        $originalImage1 = collect($request->file('file'));

        foreach ($originalImage1 as $key => $originalImage) {
            # code...

            $thumbnailImage = Image::make($originalImage);
            $fileName = rand(10, 100) . time() . str_replace(' ', '', $originalImage->getClientOriginalName());
            $filePath = $originalPath . $fileName;

            $fileUlr = 'news_image/' . $request->id . '/' . $fileName;

            $fileUlrThumb = 'news_image/' . $request->id . '/thumb' . $fileName;

            //for water mark in image in original
//            $watermark = Image::make(public_path('storage/default/watermark.png'));
//            $thumbnailImage->insert($watermark, 'bottom-right', round(10), round(10));

            $thumbnailImage->save($filePath, 80);


            $thumbnailImageThumb = Image::make($originalImage);
            $fileNameThumb = time() . $originalImage->getClientOriginalName();
            $filePathThumb = $originalPathThumb . $fileName;

            $fileUlrThumb = 'news_image/' . $request->id . '/thumb/' . $fileName;
            $thumbnailImageThumb->resize(255, 161)->save($filePathThumb);


            $imagepos = NewsImage::where('news_id', $request->id)->max('position');

            $gallery = new NewsImage();
            $gallery->user_id = $userID;
            $gallery->news_id = $request->id;
            $gallery->position = $imagepos === NULL ? 0 : $imagepos + 1;
            $gallery->name = $fileName;
            $gallery->path = $fileUlr;
            $gallery->thumb_path = $fileUlrThumb;

            $user = Auth::guard('admin')->user();
            if(\Session::get('update')!=NULL){
                
                if($gallery->isDirty())
                {
                    //dd('up');
                   // if($imagepos->count() > 0 ){
                          $news = News::find($request->id);
                          $news->updated_user_id   = $user->id;
                          $news->updated_user_date = date('Y-m-d H:i:s');
                          $news->save();
                         //}
                }
             }else if (\Session::get('create')!=NULL) {
                if($gallery->isDirty())
                {
                   //dd('c');
                  $news = News::find($request->id);
                  $news->created_user_id   = $user->id;
                  $news->created_user_date = date('Y-m-d H:i:s');
                  $news->save();
                }
             }


            $gallery->save();
        }
        $html = $this->galleryList($request->id);


        return response()->json(['success' => $originalImage, 'data' => $html]);


    }

    public function galleryList($id)
    {
        $this->data['gallery'] = NewsImage::where('news_id', $id)->orderBy('position', 'asc')->get();
        return view('admin.news.list', $this->data)->render();
    }

    public function galleryDestroy($id)
    {

        $userID = \Illuminate\Support\Facades\Auth::guard('admin')->user()->id;


        $gal = NewsImage::where('id', $id)->firstOrFail();


        $new_id = $gal->news_id;

        $userID = \Illuminate\Support\Facades\Auth::guard('admin')->user()->id;

        // ----------------------  Update : urvisha -------------------

        $user = Auth::guard('admin')->user();

        if($gal->delete()){

                $news = News::find($new_id);
                $news->updated_user_id   = $user->id;
                $news->updated_user_date = date('Y-m-d H:i:s');
                $news->save();
        }

        // ---------------------- End : Update : urvisha -------------------

        $status = 200;


        $this->posImg($new_id);

        Storage::delete('news_image/' . $new_id . '/' . $gal->name);
        Storage::delete('news_image/' . $new_id . '/thumb/' . $gal->name);

        // \Storage::delete('public/package_image/cover/'. $userID.'/' .$gal->name);

        return response()->json([
            'success' => true,
            'message' => 'Image delete successfully'
        ], $status);

    }

    public function posImg($post_id)
    {

        $imagepos = NewsImage::where('news_id', $post_id)->orderBy('position', 'asc')->get();

        if ($imagepos->count() < 1) {
            return true;
        }
        foreach ($imagepos as $key => $value) {
            $value->position = $key;
            $value->save();
        }


    }

    public function viewModel()
    {
        return response()->json(['html' => view('admin.news.status', $this->data)->render()]);
    }

    public function dataList(Request $request)
    {
        //dd($request->all());
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'category_id',
            3 => 'city_id',
           // 4 => 'status',
            4 => 'type',
            5 => 'created_at',
            6 => 'action'

        );


        $totalData = News::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        
        $customcollections = News::select('news.id as id',
            'news.title as title',
            'news.status as status',
            'cat.category_name as category_name',
            'ct.name as name',
            'news.date as date',
            'ad.type as type'
        )->leftjoin('categories as cat', function ($q) {
            return $q->on('news.category_id', '=', 'cat.id');
        })->leftjoin('new_cities as ct', function ($q) {
            return $q->on('news.city_id', '=', 'ct.id');

        })->join('admins as ad', function ($q) {
            return $q->on('ad.id', '=', 'news.user_id');
        })
        // ->where(function ($q) use($request) {

        //         $q->where('ad.type', 'Repoter')
        //         ->where('news.status', 'Approved');
        //         //->where('news.category_id','=',$request->input('category_id'));

        // })
        ->where('news.status', 'Approved')
        ->whereIn('ad.type', ['Super_Admin', 'Admin', 'Data_Entery','Repoter'])

        ->when($request->input('category_id'), function ($query, $iterm) {
           // dd($iterm);
                return $query->where('news.category_id', '=', $iterm);

        })->when($request->input('city_id'), function ($query, $iterm) {
                return $query->where('news.city_id', '=', $iterm);

        })->when($request->input('date_to'), function ($query, $iterm) {
                return $query->whereDate('news.date', '=', date('Y-m-d', strtotime($iterm)));

        });
        //dd($customcollections);

        $totalData = $customcollections->count();
        //dd($totalData);

        $customcollections = $customcollections->when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('news.title', 'LIKE', "%{$search}%")
                    ->Orwhere('cat.category_name', 'LIKE', "%{$search}%")
                    ->Orwhere('ct.name', 'LIKE', "%{$search}%");
            });

        });


        // dd($totalData);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();
        //dd($customcollections);

        $data = [];
        //dd($customcollections);
        foreach ($customcollections as $key => $item) {
            $viewUrl = route('admin.news.show',$item->id);

            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;
            $row['title'] = "<b><a href=' $viewUrl ' target='_blank'>" . $item->title . "</a></b>";
            $row['category_id'] = $item->category_name;
            $row['city_id'] = $item->name ?? '';
            //$row['status'] = $item->status;
                if($item->type == 'Super_Admin'){
                        $type = 'Admin';
                }else if ($item->type=='Repoter') {
                    $type = 'Reporter';
                }else{
                     $type =  str_replace('_', ' ', $item->type);
                }
            $row['type'] = $type;

            
            $row['date'] = date('d-m-Y ' . '(' . 'h:i:s A' . ')', strtotime($item->date));
          

            $row['action'] = $this->action([
                // collect([
                //     'text' => 'Change Status',
                //     'id' => $item->id,
                //     'action' => route('admin.news.approvestatus', $item->id),
                //     'icon' => 'fa fa-eye',
                //     'target' => '#newsstatus',
                //     //'class'  =>'javascript:void(0)',
                //     'permission' => true
                // ]),
                 collect([
                    'text' => "View",
                    'id' => $item->id,
                    'action' => route('admin.news.show', $item->id),
                    'icon' => 'fa fa-eye',
                    'target_blank' => '_balnk',
                    'permission' => true
                ]),
                collect([
                    'text' => __('common.action.edit'),
                    'id' => $item->id,
                    'action' => route('admin.news.edit', $item->id),
                    'icon' => 'fa fa-edit',
                    'permission' => true
                ]),
                collect([
                    'text' => __('common.action.delete'),
                    'id' => $item->id,
                    'action' => route('admin.news.destroy', $item->id),
                    'icon' => 'fa fa-trash',
                    'class' => 'delete-confrim',
                    'permission' => true
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());

        $userId = Auth::guard('admin')->user()->id;

        $news = new News();
        $news->title = $request->title;
        $news->category_id = $request->parent_category;
        $news->description = $request->description;
        $news->status = 'Approved';
        $news->user_id = $userId;
        $news->city_id = $request->news_city_id;

        $news->date = date('Y-m-d H:i:s');

        $news->created_user_id   = $userId;
        $news->created_user_date = date('Y-m-d H:i:s');
        //dd($news->date );
//        $news->slug         =$request->slug;
//        $news->meta_title   =$request->meta_title;
//        $news->meta_keywords=$request->meta_keyword;
//        $news->meta_description=$request->meta_description;
        $news->save();

        //$request->session()->flash('create', 'News created successfully');
         \Session::forget('update');
         \Session::put('create','News created successfully');
        $newsid = $news->id;
        //dd($newsid);
        //dd($request->all());
        return redirect()->route('admin.image.index', [$newsid]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $this->data['news'] = News::where('id', $id)->with(['images', 'category','usercreate','userupdate'])->first();

        $this->data['approve_user'] =Admin::where('id',$this->data['news']->approved_user_id)->first();
        //dd( $this->data['approve']);
        $this->data['gallery'] = NewsImage::where('news_id', $id)->orderBy('position', 'asc')->get();
        return view('admin.news.view', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $this->data['title'] = __('news.edit_title');
        $this->data['news'] = News::with('usercreate','userupdate')->find($id);

        $this->data['parent_category'] = $this->fetchCategoryTrees();

        return $this->view('admin.news.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($request->all());
        $news = News::find($id);

        $news->title = $request->title;
        $news->category_id = $request->parent_category;
        $news->description = $request->description;
        $news->city_id = $request->news_city_id;
//        $news->slug = $request->slug;
//        $news->meta_title = $request->meta_title;
//        $news->meta_keywords = $request->meta_keyword;
//        $news->meta_description = $request->meta_description;
        //dd(2);
         if($news->isDirty())
            {
                 
                  $user = Auth::guard('admin')->user();
                  $news->updated_user_id   = $user->id;
                  $news->updated_user_date = date('Y-m-d H:i:s');
                  $news->save();
            }
        //$news->save();
        \Session::forget('create');
        \Session::put('update','News updated successfully');


        return redirect()->route('admin.image.index', [$news->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $news = News::where('id', $id)->first();

        $newsImage = NewsImage::where('news_id', $news->id)->get();
        $news_id = $news->id;
        if (count($newsImage)) {
            foreach ($newsImage as $gal) {
                Storage::delete('news_image/' . $news_id . '/' . $gal->name);
                Storage::delete('news_image/' . $news_id . '/thumb/' . $gal->name);
            }
        }
        $news->delete();
        $newsImage = NewsImage::where('news_id', $news->id)->delete();


        return response()->json([
            'success' => true,
            'message' => __('news.delete.success'),
        ], 200);
    }

    public function changeStatus(Request $request, $id)
    {
        $slider = News::findOrFail($request->id);
        $slider->is_active = $request->status == 'true' ? 'Yes' : 'No';
        if ($slider->save()) {
            $statuscode = 200;
        }
        $message = $request->status == 'true' ? __('news.active') : __('news.deactivate');
        return response()->json([
            'success' => true,
            'message' => $message
        ], $statuscode);
    }

    public function remarkView($id)
    {
        //
        $this->data['title'] = 'News Status';

        $this->data['news_status'] = News::where('id', $id)->first();
        //dd($this->data['news_status']);

        return response()->json(['html' => view('admin.news.status_remark', $this->data)->render()]);


    }

    public function statusStore(Request $req, $id)
    {
        $news = News::find($id);
        // dd($news);
        $news->status = $req->news_status;
        $news->remark = $req->note;
        $news->save();
        return redirect()->route('admin.news.index')->with('success', 'Satatus changed successfully.');
    }


    public function exists(Request $request)
    {
       // dd($request->all());
        $user = News::where('title', $request->title)->first();
        if ($user) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function changeaStatus(Request $request)
    {

        $news = News::find($request->id);
        //dd($news);
        if ($news->status != "Reject") {
            if (isset($request->is_checked)) {
                $news->status = "Approved";
                $news->save();
            } else {
                $news->status = "Pending";
                $news->save();
            }
        }
        return redirect()->route('admin.news.index')->with('success', 'News Status Changed successfully.');

    }
}
