<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLogController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return response()->json([
                'status' => 'success',
                'data' => true
            ]);
        }else{
            return response()->json([
                'status' => 'success',
                'data' => false
            ]);
        }
    }
}
