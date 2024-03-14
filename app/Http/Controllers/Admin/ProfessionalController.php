<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Professional;
use App\Http\Requests\StoreProfessionalRequest;
use App\Http\Requests\UpdateProfessionalRequest;
use App\Models\Message;
use App\Models\Review;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // informazioni singolo utente
        $user = User::find(Auth::id());

        $professional = Professional::where('user_id', Auth::id())->first();

        // recupera le informazioni
        $messagesCountByMonth = Message::select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as total'))
        ->where('professional_id', $professional->id)
        ->whereBetween('created_at', [now()->subMonths(12), now()])
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
        ->get();
        $reviewsCountByMonth = Review::select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as total'))
        ->where('professional_id', $professional->id)
        ->whereBetween('created_at', [now()->subMonths(12), now()])
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
        ->get();
        $votesCountByMonth = Vote::select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as total'))
        ->where('professional_id', $professional->id)
        ->whereBetween('created_at', [now()->subMonths(12), now()])
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
        ->get();
        $maxHeight = 0;
        //crea un array che contiene i valori per ogni mese
        $monthlyMessageCounts = array_fill(1, 12, 0);
        foreach ($messagesCountByMonth as $messageCount) {
            if($messageCount->year < date('Y')){
                $monthlyMessageCounts[$messageCount->month - date('m')] = $messageCount->total;
            }else{
                $monthlyMessageCounts[12 - (date('m') - $messageCount->month)] = $messageCount->total;
            }
            if($messageCount->total > $maxHeight)$maxHeight = $messageCount->total;
        }
        $monthlyReviewCounts = array_fill(1, 12, 0);
        foreach ($reviewsCountByMonth as $reviewCount) {
            if($reviewCount->year < date('Y')){
                $monthlyReviewCounts[$reviewCount->month - date('m')] = $reviewCount->total;
            }else{
                $monthlyReviewCounts[12 - (date('m') - $reviewCount->month)] = $reviewCount->total;
            }
            if($reviewCount->total > $maxHeight)$maxHeight = $reviewCount->total;
        }
        $monthlyVoteCounts = array_fill(1, 12, 0);
        foreach ($votesCountByMonth as $voteCount) {
            if($voteCount->year < date('Y')){
                $monthlyVoteCounts[$voteCount->month - date('m')] = $voteCount->total;
            }else{
                $monthlyVoteCounts[12 - (date('m') - $voteCount->month)] = $voteCount->total;
            }
            if($voteCount->total > $maxHeight)$maxHeight = $voteCount->total;
        }
        return view('admin.professionals.index', compact('user', 'professional', 'monthlyMessageCounts', 'monthlyReviewCounts', 'monthlyVoteCounts', 'maxHeight'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfessionalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Professional $professional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($professional)
    {
        // pagina modifica utente
        if(Auth::id() != $professional)return redirect()->route('home');
        $user = User::find(Auth::id());

        $specializations = Specialization::all();
        $professional = Professional::where('user_id', Auth::id())->first();

        return view('admin.professionals.edit', compact('user', 'professional', 'specializations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfessionalRequest $request, $user)
    {
        // modifica utente
        $data = $request->validated();
        
        $new_user =  User::find($user);

        $new_user->update($data);

        $professional = Professional::where('user_id', $user)->first();
        $professional->slug = $new_user->name . '-' . $new_user->surname;
        if ($professional->curriculum and isset($data['curriculum'])) {
            Storage::delete($professional->curriculum);
            $professional->curriculum = Storage::put('uploads', $data['curriculum']);
        } else if (isset($data['curriculum'])) {
            $professional->curriculum = Storage::put('uploads', $data['curriculum']);
        }
        if ($professional->photo and isset($data['photo'])) {
            Storage::delete($professional->photo);
            $professional->photo = Storage::put('uploads', $data['photo']);
        } else if (isset($data['photo'])) {
            $professional->photo = Storage::put('uploads', $data['photo']);
        }

        $professional->phone = $data['phone'];
        $professional->address = $data['address'];
        $professional->performance = $data['performance'];

        $professional->update();

        if ($request->has('specializations')) {
            $professional->specializations()->sync($data['specializations']);
        } else {
            $professional->specializations()->sync([]);
        }



        return redirect()->route('admin.info.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professional $professional)
    {
        //
    }
}
