<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function addService(Request $request)
    {
        $get_input = false;

        $this->validate($request, array(
            'pregnancy_week'  => 'required | string',
            'age'  => 'required | string',
            'carrying_first_child'  => 'required | string',
            'height'  => 'required | string',
            'weight'  => 'required | string',
            'bmi'  => 'required | string',
            'bp'  => 'required | string',
            'have_proteinuria'  => 'required | string',
            'have_STI'  => 'required | string',
            'have_heart_diseases'  => 'required | string',
            'have_kidney_diseases'  => 'required | string',
            'have_hypothyroidism'  => 'required | string',
            'have_anemia'  => 'required | string',
            'have_previous_miscarriage'  => 'required | string',
            'have_previous_cs'  => 'required | string',
            'is_carrying_twin_or_multiple'  => 'required | string',
            'glucose_before_fasting'  => 'required | string',
            'glucose_after_fasting'  => 'required | string',
        ));

        // previous miscarriage  | previous CS  |  carrying twin or multiple babies
        if (
            $request->have_previous_miscarriage == 'yes' ||
            $request->have_previous_cs == 'yes' ||
            $request->is_carrying_twin_or_multiple == 'yes'
        ) {
            $result = 'You may have a possibility to C-Section';
             return redirect()->route('get-service', ['false']);
        }

        // STI like HIV, like HIV, Syphilis and genital herpes | heart diseases 
        if ($request->have_STI == 'yes' || $request->have_heart_diseases == 'yes') {
            $result = 'You may have a possibility to C-Section';
             return redirect()->route('get-service', ['false']);
        }

        // kidney diseases
        if ($request->have_kidney_diseases == 'yes') {
            $result = 'You regularly requires hemodialysis. Thus you are at high risk of pregnancy complications, including miscarriage, stillbirth, preterm birth, and preeclampsia';
             return redirect()->route('get-service', ['false']);
        }


        // age > 30 | have hypothyroidism | Anemia
        if ($request->age > 30 && $request->have_hypothyroidism == 'yes' && $request->have_anemia == 'yes') {
            $result = 'If you have uncontrolled hypothyroidism, you can get high blood pressure, anemia (low red blood cell count), and muscle pain and weakness. There is also an increased risk of miscarriage, premature birth (before 37 weeks of pregnancy), Past infertility or preterm delivery';
             return redirect()->route('get-service', ['false']);
        }


        // glucose before fasting > 100mg/dl | glucose after fasting > 140mg/dl | overweight (BMI > 25)
        if (
            $request->glucose_before_fasting > 100 ||
            $request->glucose_after_fasting > 140  ||
            $request->bmi > 25
        ) {
            $result = 'Gestational diabetes may also increase your risk of High blood pressure and preeclampsia., Having a surgical delivery (C-section). You may have future C-Section';
             return redirect()->route('get-service', ['false']);
        }


        // height < 150cm
        if ($request->height < 150) {
            $result = "Shorter mothers have shorter pregnancies, smaller babies, and higher risk for a preterm birth. Investigators found that a mother's height directly influences her risk for preterm birth 'at risk' of cephalopelvic disproportion (CPD). You are at risk of failing spontaneous vaginal delivery and should be referred to hospitals where labor could be closely monitored and cesarean section performed if necessary";
            return redirect()->route('get-service', ['false']);
        }




        // eclampsia
        // pregnancy_week 20-40 | age 17-35 | carrying_first_child | BMI 18-25 | Bp > 120/80 | have proteinria
        if (
            ($request->pregnancy_week > 24 && $request->pregnancy_week < 41) &&
            ($request->age > 17 && $request->age < 35) &&
            ($request->bmi < 18  || $request->bmi > 25) &&
            $request->bp == '>120/80'  &&
            $request->carrying_first_child == 'yes'  &&
            $request->have_proteinuria == 'yes'
        ) {
            $result = 'Since you are now 2nd trimester, you have high blood pressure, you have proteinuria so, you have high risk to eclampsia. ';
            return redirect()->route('get-service', ['false']);
        }


        // return redirect()->route('get-service', ['false']);
    }
}