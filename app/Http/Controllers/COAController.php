<?php

namespace App\Http\Controllers;

use DataTables;
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
    public function COA(Request $request,$id)
    {
        $coas = ChartOfAccount::where('parent_id',$id)->get();
        if ($request->ajax()) {
            if ($request->has('search') && !empty($request->input('search.value'))) {
                $coas = ChartOfAccount::query();
                $searchValue = $request->input('search.value');
                $coas->where(function ($query) use ($searchValue) {
                    $query->where('category', 'like', "%$searchValue%")
                        ->orWhere('code', 'like', "%$searchValue%");
                });
            }
            return Datatables::of($coas)
                
                ->addColumn('name', function($name){
                    return $name->category;
                })
                ->addColumn('code', function($code){    
                        return $code->code;
                })
                ->addColumn('child',function ($child) {
                    return '<a href="'.route('showCOA',['id' => $child->id]) .'"
                    class="btn btn-primary"><i
                        class="fa fa-arrow-down"></i></a>';
                   })
                ->addColumn('action',function ($action) {
                        $btn = '<div class="btn-group">
                                    <button onclick="editor('.$action->id.','.$action->category.','.$action->code.')" class="btn btn-primary"><i
                                            class="fa fa-pencil"></i></button>
                                    <a onclick="return confirm(Are you sure you want to delete this COA entry?);" href="'.route('deleteCOA',['id' => $action->id]).'"
                                        class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </div>';
        
                        return $btn;
                   })
                ->rawColumns(['child', 'action'])
                ->make(true);     
                return view('admin.coa.index',compact('coas'));
        }
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
