<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Professional;
use App\Http\Requests\StoreProfessionalRequest;
use App\Http\Requests\UpdateProfessionalRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $user= User::find(Auth::id());
       
        $professional= Professional::where('user_id', Auth::id())->first();
         
        return view('admin.professionals.index',compact('user','professional'));

        
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
    {   $user= User::find(Auth::id());
      
        $professional= Professional::where('user_id', Auth::id())->first();
         
        return view('admin.professionals.edit',compact('user','professional'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfessionalRequest $request, User $user)
    {
        $data = $request->validated();
        // $project->slug = Str::of($data['title'])->slug('-');

        
        $user -> update($data);
        

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
