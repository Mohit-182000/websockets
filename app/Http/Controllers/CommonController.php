<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\CompanyType;
use App\Model\Experience;
use App\Model\Industries;
use App\Model\JobType;
use App\Model\KnownLanguages;
use App\Model\Locality;
use App\Model\MaritalStatus;
use App\Model\Qualification;
use App\Model\Shifts;
use App\Model\Skills;
use App\Model\State;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
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
    
    public function changeStatus(Request $request, $id)
    {
        $table = $request->table;
        //dd($request);
        $is_active  = $request->status == 'true' ? 'Yes' : 'No';
        $tableRes = DB::table($table)->where('id', $request->id)->update(['is_active' => $is_active]);
        if ($tableRes) {
            $statuscode = 200;
        }
        $message = $request->status == 'true' ? __('common.active') : __('common.deactivate');

        return response()->json([
            'success' => true,
            'message' => $message
        ], $statuscode);
    }

    public function getState(Request $request)
    {
        //dd($request);

        $search = $request->get('search');

        $data = State::where('name', 'like', '%' . $search . '%')
                ->where('is_active', 'Yes')
                ->orderBy('name', 'asc')
                ->get();

        return response()->json($data->toArray());
    }

    public function getCategory(Request $request)
    {
        //dd($request);

        $search = $request->get('search');

        $data = Category::where('name', 'like', '%' . $search . '%')
                ->where('is_active', 'Yes')
                ->orderBy('name', 'asc')
                ->get();

        return response()->json($data->toArray());
    }

    public function getCompanyType(Request $request)
    {
        //dd($request);

        $search = $request->get('search');

        $data = CompanyType::where('company_type', 'like', '%' . $search . '%')
                ->where('is_active', 'Yes')
                ->orderBy('company_type', 'asc')
                ->get();

        return response()->json($data->toArray());
    }

    public function getJobType(Request $request)
    {
        //dd($request);

        $search = $request->get('search');

        $data = JobType::where('name', 'like', '%' . $search . '%')
                ->where('is_active', 'Yes')
                ->orderBy('name', 'asc')
                ->get();

        return response()->json($data->toArray());
    }

    public function getIndustries(Request $request)
    {
        //dd($request);

        $search = $request->get('search');

        $data = Industries::where('name', 'like', '%' . $search . '%')
                ->where('is_active', 'Yes')
                ->orderBy('name', 'asc')
                ->get();

        return response()->json($data->toArray());
    }

    public function getMaritalStatus(Request $request)
    {
        //dd($request);

        $search = $request->get('search');

        $data = MaritalStatus::where('name', 'like', '%' . $search . '%')
                ->where('is_active', 'Yes')
                ->orderBy('name', 'asc')
                ->get();

        return response()->json($data->toArray());
    }

    public function getExperience(Request $request)
    {
        //dd($request);

        $search = $request->get('search');

        $data = Experience::where('name', 'like', '%' . $search . '%')
                ->where('is_active', 'Yes')
                ->orderBy('name', 'asc')
                ->get();

        return response()->json($data->toArray());
    }

    public function getSkill(Request $request)
    {
        
        $search = $request->get('search');

        $data = Skills::where('name', 'like', '%' . $search . '%')
                ->where('is_active', 'Yes')
                ->orderBy('name', 'asc')
                ->get();

        return response()->json($data->toArray());
    }

    public function getQualification(Request $request)
    {
        
        $search = $request->get('search');

        $data = Qualification::where('name', 'like', '%' . $search . '%')
                ->where('is_active', 'Yes')
                ->orderBy('name', 'asc')
                ->get();

        return response()->json($data->toArray());
    }

    public function getKnownLanguages(Request $request)
    {
        
        $search = $request->get('search');

        $data = KnownLanguages::where('name', 'like', '%' . $search . '%')
                ->where('is_active', 'Yes')
                ->orderBy('name', 'asc')
                ->get();

        return response()->json($data->toArray());
    }

    public function getShift(Request $request)
    {
        
        $search = $request->get('search');

        $data = Shifts::where('name', 'like', '%' . $search . '%')
                ->where('is_active', 'Yes')
                ->orderBy('name', 'asc')
                ->get();

        return response()->json($data->toArray());
    }
}
