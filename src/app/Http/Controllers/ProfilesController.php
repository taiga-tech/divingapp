<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;

class ProfilesController extends Controller
{
    protected $profiles;

    public function __construct(Profile $profiles)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->profiles = $profiles;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = $this->profiles->all();
        return view('profiles.index', compact('profiles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = $this->profiles->find($id);
        return view('profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = $this->profiles->find($id);
        if (Auth::id() === $profile->user_id) {
            return view('profiles.edit', compact('profile'));
        } else {
            return view('profiles.show', compact('profile'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profile = $this->profiles->find($id);
        $input = $request->all();
        $image = $request->file('image');
        $timeStamp = date('Ymd-His');
        if ( $image ) {
            $ext = $image->guessExtension();
            $filename = "{$timeStamp}_{$request->name}.{$ext}";
            $path = $image->storeAs('profile/'.$id, $filename);
            $input['image'] = $path;
        }
        $profile->update($input);
        return view('profiles.show', compact('profile'));
    }

}
