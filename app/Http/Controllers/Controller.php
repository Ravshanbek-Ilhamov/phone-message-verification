<?php

namespace App\Http\Controllers;

use App\Models\VarificationCode;
use Illuminate\Http\Request;

abstract class Controller
{
    
    public function verify_code(Request $request){

        // dd($request->all());

        if($request->code == VarificationCode::where('user_id',auth()->user()->id)->first()->code){
            return redirect(route('dashboard'));

        }
    }
}
