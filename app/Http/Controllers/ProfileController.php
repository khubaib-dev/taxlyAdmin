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

class ProfileController extends Controller
{
    public function index(){
        $user = auth()->guard('admin')->user();
        return view('admin.profile',compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => ['required','unique:admins,email,'.auth()->guard('admin')->user()->id],
        ]);

        if(isset($request->password))
        {
            Admin::where('id',auth()->guard('admin')->user()->id)->update([
                    'password' => bcrypt($request->password)
                ]);
        }


        Admin::where('id',auth()->guard('admin')->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->back()->withSuccess('Your Profile Updated');
    }
}
