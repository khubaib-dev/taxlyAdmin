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
        $array = [];
        $lastId = $id;
        if($id != 0)
        {
            while($lastId > 0)
            {
                $parent = ChartOfAccount::find($lastId);
        
                if (!$parent) {
                    break;
                }
                
                $lastId = $parent->parent_id;
                $array[] = ['cat' => $parent->category,'id' => $parent->id];
            }
            $array = array_reverse($array);
        }
        $counter = count($array);
        return view('admin.coa.index',compact('counter','coas','id','array'));
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
