<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Professional;
use App\Http\Requests\StoreProfessionalRequest;
use App\Http\Requests\UpdateProfessionalRequest;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::id());

        $professional = Professional::where('user_id', Auth::id())->first();

        return view('admin.professionals.index', compact('user', 'professional'));
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
    public function edit(Professional $professional)
    {
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
        $data = $request->validated();
        // dd($data);


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
