<?php

namespace App\Http\Controllers;

use App\Models\WizardForm;
use Illuminate\Http\Request;

class WizardController extends Controller
{

    public function showform(){
        return view('form.wizardForm');
    }

    public function submit(Request $request){
        


        
        $data = new WizardForm;
        $data->fname = $request->fname;
        $data->lname = $request->lname;
        $data->dd = $request->dd;
        $data->mm = $request->mm;
        $data->yyyy = $request->yyyy;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->save();

        return response()->json(['message'=>'data added successfully']);
    }

}


