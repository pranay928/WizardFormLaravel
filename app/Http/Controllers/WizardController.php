<?php

namespace App\Http\Controllers;

use App\Models\WizardForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WizardController extends Controller
{

    public function showform()
    {
        return view('form.wizardForm');
    }

    public function submit(Request $request)
    {
        // $validate = Validator::make($request->all(), [
        //     'fname' => ['required', 'string', 'min:3'],
        //     'lname' => ['required', 'string', 'min:3'],
        //     // 'dd' => ['required', 'integer', 'max:2', 'between:1,31'],
        //     // 'mm' => ['required', 'integer', 'max:2', 'between:1,12'],
        //     // 'yyyy' => ['required', 'integer', 'min:4', 'between:1900,2025'],
        //     'email' => ['required', 'email'],
        //     'password' => ['required', 'min:6'],

        // ]);
        // if ($validate->fails()) {
        //     return response()->json(['error' => 'fail to validate']);
        // } else {

            $data = new WizardForm;
            $data->fname = $request->fname;
            $data->lname = $request->lname;
            $data->birth = $request->birth;  
            $data->email = $request->email;
            $data->password = $request->password;
            $data->save();

            return response()->json(['message' => 'data added successfully']);
        
    }
}
