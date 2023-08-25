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

class UserTypeController extends Controller
{
    public function index()
    {
        $types = UserType::get();
        return view('admin.type.index',compact('types'));
    }

    public function store(Request $request)
    {
        UserType::create([
            'name' => $request->userType
        ]);
        return redirect()->back()->withSuccess('User Type Created');
    }
    
    public function update(Request $request)
    {
        UserType::where('id',$request->userTypeId)->update([
            'name' => $request->userType
        ]);
        return redirect()->back()->withSuccess('User Type Updated');
    }

    public function delete($id)
    {
        UserType::where('id',$id)->delete();
        return redirect()->back()->withSuccess('User Type Deleted');
    }
}
