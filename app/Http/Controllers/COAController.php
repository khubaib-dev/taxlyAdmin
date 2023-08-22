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
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class COAController extends Controller
{
    public function COA($id)
    {
        $coas = ChartOfAccount::whereParentId($id)->get();
        return view('admin.coa.index',compact('coas','id'));
    }

    public function delete($id)
    {
        ChartOfAccount::whereId($id)->delete();
        return redirect()->back()->withSuccess('COA Deleted');
    }

    public function addCOA(Request $request)
    {
        ChartOfAccount::create([
            'category' => $request->categoryName,
            'parent_id' => $request->categoryParent,
            'code' => $request->categoryCode
        ]);
        return redirect()->back()->withSuccess('COA Added');
    }
    
    public function updateCOA(Request $request)
    {
        ChartOfAccount::whereId($request->categoryParent)->update([
            'category' => $request->categoryName,
            'code' => $request->categoryCode
        ]);
        return redirect()->back()->withSuccess('COA Updated');
    }
}
