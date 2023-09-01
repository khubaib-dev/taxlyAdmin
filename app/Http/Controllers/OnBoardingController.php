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
use Illuminate\Support\Facades\Storage;


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
        
        $selectedIcon = $request->input('selected_icon');
        $iconPath = public_path('icons/' . $selectedIcon . '.svg');
        $iconContent = file_get_contents($iconPath);

        // Create a unique filename for the SVG file
        $filename = 'icon_' . time() . '.svg';

        // Specify the folder where you want to store the SVG files
        $folder = 'icons';

        // Store the SVG content as a file in the specified folder
        Storage::disk('local')->put($folder . '/' . $filename, $iconContent);

        // Get the path of the stored file
        $path = $folder . '/' . $filename;
        
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
            if($request['question_'.$i] != '' &&  $request['question_order_'.$i] != '')
            {
                $questions[] = [
                    'onBoardingIdId' => $onBoarding->id,
                    'label' => $request['question_'.$i],
                    'order' => $request['question_order_'.$i]
                ];
            }
        }

        OnBoardingQuestion::insert($questions);
        return redirect()->back()->withSuccess('OnBoarding Created');
    }
    
    public function update(Request $request)
    {
        $selectedIcon = $request->input('selected_icon');
        if(isset($selectedIcon))
        {
            $iconPath = public_path('icons/' . $selectedIcon . '.svg');
            $iconContent = file_get_contents($iconPath);

            // Create a unique filename for the SVG file
            $filename = 'icon_' . time() . '.svg';

            // Specify the folder where you want to store the SVG files
            $folder = 'icons';

            // Store the SVG content as a file in the specified folder
            Storage::disk('local')->put($folder . '/' . $filename, $iconContent);

            // Get the path of the stored file
            $path = $folder . '/' . $filename;
        }
        else{
            $path = OnBoarding::find($request->id)->getRawOriginal('icon');
        }
        OnBoarding::where('id',$request->id)->update([
            'occupation_id' => $request->occupation,
            'profession_id' => $request->profession,
            'criteria_id' => $request->criteria,
            'icon' => $path,
            'heading' => $request->heading,
            'sub_heading' => $request->sub_heading,
            'type' => $request->type,
        ]);

        OnBoardingQuestion::where('onBoardingIdId',$request->id)->delete();

        $questions = [];

        for($i = 1; $i <= $request->total_questions; $i++) {
            if($request['question_'.$i] != '' &&  $request['question_order_'.$i] != '')
            {
                $questions[] = [
                    'onBoardingIdId' => $request->id,
                    'label' => $request['question_'.$i],
                    'order' => $request['question_order_'.$i]
                ];
            }
        }

        OnBoardingQuestion::insert($questions);
        return redirect()->back()->withSuccess('OnBoarding Updated');
    }

    public function delete($id)
    {
        OnBoarding::where('id',$id)->delete();
        return redirect()->back()->withSuccess('OnBoarding Deleted');
    }
}
