<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Professional;
use App\Models\Sponsorization;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorizationController extends Controller
{
    public function index()
    {
        $current_time = now();
        $resultati = Professional::where('user_id', Auth::id())
            ->with(['sponsorizations' => function ($query) use ($current_time) {
                $query->withPivot('professional_id', 'sponsorization_id', 'date_end_sponsorization')->where('date_end_sponsorization', '>', $current_time)
                    ->orderBy('date_end_sponsorization', 'desc');
            }])
            ->get();

           
        if ($resultati[0]->sponsorizations->isEmpty()) {
            $sponsorization = null;
        } else {
            $sponsorization = $resultati[0]->sponsorizations[0]->getOriginal();
        }
        $sponsorizations = Sponsorization::all();
        return view('admin.sponsorizations.index', compact('sponsorizations', 'sponsorization'));
    }
}
