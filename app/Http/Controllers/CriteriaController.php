<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AIChat;
use App\Models\ChartOfAccount;
use App\Models\Criterion;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Occupation;
use App\Models\UserType;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class CriteriaController extends Controller
{
    public function index()
    {
        $criterias = Criterion::get();
        foreach ($criterias as $criteria) {
            $data = null;
            $occupationIds = explode(',', $criteria->occupation);
            $length = count($occupationIds);
            $counter = 0;
            foreach ($occupationIds as $id) {
                $profession = Occupation::find($id);
                if(isset($profession))
                {
                    $data .= $profession->name. (++$counter != $length ? ',' : '');
                }
            }
            $criteria['professions'] = $data;
        }
        $occupations = Occupation::get();
        $types = UserType::get();
        return view('admin.criteria.index',compact('types', 'occupations', 'criterias'));
    }

    

    public function delete($id)
    {
        Criterion::whereId($id)->delete();
        return redirect()->back()->withSuccess('Criteria Deleted');
    }

    public function addCriteria(Request $request)
    {
        $occupations = implode(',', $request->occupation);
        Criterion::create([
            'name' => $request->criteriaName,
            'occupation' => $occupations,
            'user_type' => $request->user_type,
            'values' => '['.$request->criteriaCode.']'
        ]);
        return redirect()->back()->withSuccess('Criteria Added');
    }
    
    public function updateCriteria(Request $request)
    {
        $occupations = implode(',', $request->occupationUpdate);
        Criterion::whereId($request->criteriaId)->update([
            'name' => $request->criteriaName,
            'occupation' => $occupations,
            'user_type' => $request->user_type,
            'values' => '['.$request->criteriaCode.']'
        ]);
        return redirect()->back()->withSuccess('Criteria Updated');
    }
    
}
