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
        foreach ($users as $user) {
            $payloadAccess = [
                '_key' => $aMemberKey,
                'login' => $user->amember_id
            ];
            $response = Http::get($url, $payloadAccess);
            $fullUser = $response->json();
            echo($fullUser);
            // $user['email'] = $fullUser['email'];
            // $user['fname'] = $fullUser['name_f'];
            // $user['lname'] = $fullUser['name_l'];
        }
        dd();
        return view('admin.users.index',compact('users'));
    }
}
