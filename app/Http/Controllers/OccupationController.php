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

class OccupationController extends Controller
{
    public function index()
    {
        $occupations = Occupation::get();
        return view('admin.occupation.index',compact('occupations'));
    }

    public function store(Request $request)
    {
        Occupation::create([
            'name' => $request->occupation
        ]);
        return redirect()->back()->withSuccess('Occupation Created');
    }
    
    public function update(Request $request)
    {
        Occupation::where('id',$request->occupationId)->update([
            'name' => $request->occupation
        ]);
        return redirect()->back()->withSuccess('Occupation Updated');
    }

    public function delete($id)
    {
        Occupation::where('id',$id)->delete();
        return redirect()->back()->withSuccess('Occupation Deleted');
    }
}
