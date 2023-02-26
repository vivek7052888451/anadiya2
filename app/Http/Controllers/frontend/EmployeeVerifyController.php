<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class EmployeeVerifyController extends Controller
{
    public function veriFyEmployee(Request $request)
    {
    	if($request->verification_code !='' &&  $request->verification_code == '9999')
    	  return response()->json(['status' => 'success']);
    	else
    	  return response()->json(['status' => 'error']);

    }
}
