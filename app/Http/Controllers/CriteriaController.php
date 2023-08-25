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
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class CriteriaController extends Controller
{
    public function index()
    {
        $criterias = Criterion::get();
        $occupations = Occupation::get();
        return view('admin.criteria.index',compact('occupations', 'criterias'));
    }

    

    public function delete($id)
    {
        Criterion::whereId($id)->delete();
        return redirect()->back()->withSuccess('Criteria Deleted');
    }

    public function addCriteria(Request $request)
    {
        Criterion::create([
            'name' => $request->criteriaName,
            'occupation' => $request->occupation,
            'user_type' => $request->user_type,
            'values' => '['.$request->criteriaCode.']'
        ]);
        return redirect()->back()->withSuccess('Criteria Added');
    }
    
    public function updateCriteria(Request $request)
    {
        Criterion::whereId($request->criteriaId)->update([
            'name' => $request->criteriaName,
            'occupation' => $request->occupation,
            'user_type' => $request->user_type,
            'values' => '['.$request->criteriaCode.']'
        ]);
        return redirect()->back()->withSuccess('Criteria Updated');
    }
    
}
