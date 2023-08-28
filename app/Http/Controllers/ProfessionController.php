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
use App\Models\Profession;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ProfessionController extends Controller
{
    public function index()
    {
        $professions = Profession::get();
        $occupations = Occupation::get();
        return view('admin.profession.index',compact('occupations', 'professions'));
    }

    public function store(Request $request)
    {
        Profession::create([
            'occupation_id' => $request->occupation,
            'name' => $request->profession
        ]);
        return redirect()->back()->withSuccess('Profession Created');
    }
    
    public function update(Request $request)
    {
        Profession::where('id',$request->professionId)->update([
            'occupation_id' => $request->occupation,
            'name' => $request->profession
        ]);
        return redirect()->back()->withSuccess('Profession Updated');
    }

    public function delete($id)
    {
        Profession::where('id',$id)->delete();
        return redirect()->back()->withSuccess('Profession Deleted');
    }
}
