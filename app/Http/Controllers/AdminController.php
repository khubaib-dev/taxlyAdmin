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


class AdminController extends Controller
{
    public function index()
    {
        $aMemberKey = config('services.aMember')['key'];
        $url = 'https://backend.taxly.ai/api/check-access/by-login';
        $users = User::get();
        $array = [];
        foreach ($users as $user) {
            $payloadAccess = [
                '_key' => $aMemberKey,
                'login' => $user->amember_id
            ];
            $response = Http::get($url, $payloadAccess);
            $fullUser = $response->json();
            
            if($fullUser['ok'])
            {
                $user['user_id'] = $fullUser['user_id'];
                $user['email'] = $fullUser['email'];
                $user['fname'] = $fullUser['name_f'];
                $user['lname'] = $fullUser['name_l'];
            }
            else{
                $user['user_id'] = 0;
                $user['email'] = '';
                $user['fname'] = '';
                $user['lname'] = '';
            }
        }
        return view('admin.users.index',compact('users'));
    }

    public function delete($id,$aMemberId)
    {
        $user = User::find($id);
        if($aMemberId != 0)
        {
            $aMemberKey = config('services.aMember')['key'];
            $client = new Client();
            $response = $client->delete('https://backend.taxly.ai/api/users/'.$aMemberId,[
                'query' => [
                    '_key' => $aMemberKey,
                ],
            ]);
        }
        AIChat::where('user_id',$id)->delete();
        Transaction::where('userId',$id)->delete();
        Setting::where('userId',$id)->delete();
        User::where('id',$id)->delete();
        return redirect()->back()->withSuccess('User Deleted');
    }
}
