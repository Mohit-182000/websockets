<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamUpdatesFormRequest;
use App\Traits\DatatablTrait;
use Illuminate\Http\Request;
use App\Model\ExamUpdates;
use Illuminate\Support\Facades\Storage;

class ExamUpdatesController extends Controller
{
    use DatatablTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.exam_updates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.exam_updates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamUpdatesFormRequest $request)
    {
        //dd($request);
        $add = new ExamUpdates();
        $add->title = $request->title;
        $add->no_of_post = $request->no_of_post;
        $add->fees = $request->fees;
        $add->age_limit = $request->age_limit;
        // $add->exam_date = date('Y-m-d', strtotime($request->exam_date));
        $add->last_date_of_exam = date('Y-m-d', strtotime($request->last_date_of_exam));
        $add->link = $request->link;
        $add->description = $request->description;
        $add->added_by = NULL;
        $add->updated_by = NULL;

        $add->save();

        return redirect()->route('admin.exam-updates.index')->with('success', __('exam_updates.store_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
        $this->data['exam_updates'] = ExamUpdates::findorfail($id);
        return view('admin.exam_updates.view', $this->data);
    }

    public function dataList(Request $request)
    {
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'no_of_post',
            3 => 'last_date_of_exam',
            4 => 'is_active',
            5 => 'action',
        );

        $totalData = ExamUpdates::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = ExamUpdates::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%");
        });

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($customcollections as $key => $item) {
            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;

            $row['title'] =  '<div style="white-space:normal;">'.$item->title.'</div>';
            $row['no_of_post'] =  $item->no_of_post;
            $row['last_date_of_exam'] = date('d-m-Y', strtotime($item->last_date_of_exam));

            $row['is_active'] = $this->status($item->is_active, $item->id, route('change-status', ['id' => $item->id]), 'exam_updates');
            //dd($row['is_active']);
            $row['action'] = $this->action([
                 collect([
                    'text' => __('common.view'),
                    'id' => $item->id,
                    'action' => route('admin.exam-updates.show', $item->id),
                    'icon' => 'fas fa-eye text-orange-red',
                ]),
                collect([
                    'text' => __('common.edit'),
                    'id' => $item->id,
                    'action' => route('admin.exam-updates.edit', $item->id),
                    'icon' => 'fas fa-cogs text-dark-pastel-green',
                ]),
                collect([
                    'text' => __('common.delete'),
                    'id' => $item->id,
                    'action' => route('admin.exam-updates.destroy', $item->id),
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
        $this->data['exam_updates'] = ExamUpdates::findorfail($id);
        return view('admin.exam_updates.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamUpdatesFormRequest $request, $id)
    {

        //dd($request);
        $update = ExamUpdates::findorfail($id);
        $update->title = $request->title;
        $update->no_of_post = $request->no_of_post;
        $update->fees = $request->fees;
        $update->age_limit = $request->age_limit;
        // $update->exam_date = date('Y-m-d', strtotime($request->exam_date));
        $update->last_date_of_exam = date('Y-m-d', strtotime($request->last_date_of_exam));
        $update->link = $request->link;
        $update->description = $request->description;

        $update->save();

        return redirect()->route('admin.exam-updates.index')->with('success', __('exam_updates.update_success'));
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
        $delete = ExamUpdates::find($id);
        $delete->delete();
        return response()->json([
            'success' => true,
            'message' => __('exam_updates.delete_success'),
        ], 200);
    }
}
