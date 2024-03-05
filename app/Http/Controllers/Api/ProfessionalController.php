<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Professional;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    public function index()
    {
        request()->key = 110;
        request()->validate([
            'key' => ['max:5']
        ]);

        dd(request()->key);
        $values = explode(',', request()->key);

        foreach ($values as $value) {
            request()->validate([
                $value => ['!exists:specializations,id']
            ]);
        }

        $professionals = Professional::whereHas('specializations', function ($query) {
            $query->whereIn('id', [1, 2]);
        })->get();
        // dd($professionals);
        return response()->json([
            'status' => 'success',
            'data' => $professionals
        ]);
    }
}
