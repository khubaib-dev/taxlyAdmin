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
use App\Models\Profession;

class OnBoardingController extends Controller
{
    public function index()
    {
        $onboadings = OnBoarding::get();
        $occupations = Occupation::get();
        $criterias = Criterion::get();
        return view('admin.onboarding.index',compact('criterias','occupations','onboadings'));
    }

    public function getProfession(Request $request)
    {
        $professions = Profession::where('occupation_id',$request->id)->get();
        return response()->json([
            'ok' => true,
            'professions' => $professions
        ]);
    }

    public function store(Request $request)
    {
        $path = $request->icon->store('icon');
        $onBoarding = OnBoarding::create([
            'occupation_id' => $request->occupation,
            'profession_id' => $request->profession,
            'criteria_id' => $request->criteria,
            'icon' => $path,
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
        $path = $request->icon->store('icon');
        OnBoarding::where('id',$request->id)->update([
            'occupation_id' => $request->occupation,
            'profession_id' => $request->profession,
            'criteria_id' => $request->criteria,
            'icon' => $path,
            'heading' => $request->heading,
            'sub_heading' => $request->sub_heading,
            'type' => $request->type,
        ]);
        return redirect()->back()->withSuccess('OnBoarding Updated');
    }

    public function delete($id)
    {
        OnBoarding::where('id',$id)->delete();
        return redirect()->back()->withSuccess('OnBoarding Deleted');
    }
}
