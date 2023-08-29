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
use App\Models\OnBoarding;
use App\Models\OnBoardingQuestion;

class OnBoardingController extends Controller
{
    public function index()
    {
        $onboadings = OnBoarding::get();
        $occupations = Occupation::get();
        $criterias = Criterion::get();
        return view('admin.onboarding.index',compact('criterias','occupations','onboadings'));
    }

    public function store(Request $request)
    {
        $onBoarding = OnBoarding::create([
            'occupation_id' => $request->occupation,
            'criteria_id' => $request->criteria,
            'icon' => $request->criteria,
            'heading' => $request->heading,
            'sub_heading' => $request->sub_heading,
            'type' => $request->type,
        ]);

        $questions = [];

        for($i = 1; $i <= $request->total_questions; $i++) {
            $questions[] = [
                'on_boarding_id' => $onBoarding->id,
                'label' => $request['question_'.$i]
            ];
        }

        OnBoardingQuestion::insert($questions);
        return redirect()->back()->withSuccess('OnBoarding Created');
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
        OnBoarding::where('id',$id)->delete();
        return redirect()->back()->withSuccess('OnBoarding Deleted');
    }
}
