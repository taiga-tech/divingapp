<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;
use App\Models\User;
use App\Models\Post;
use App\Http\Requests\ProfileRequest;

class ProfilesController extends Controller
{
    protected $profiles;

    public function __construct(Profile $profiles)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->profiles = $profiles;
    }

    public function store(Request $request)
    {
        $profile = new Profile;
        $input = $request->all();
        $input['user_id'] = Auth::id();

        return $profile->create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::with('user')->find($id);
        $posts = Post::where('profile_id', $id)
            ->with('user', 'profile', 'images', 'comments')
            ->get();

        return [$profile, $posts];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $profile = $this->profiles->find($id);
        $input = $request->all();
        $image = $request->file('image');
        $timeStamp = date('Ymd-His');

        if ( $image )
        {
            $ext = $image->guessExtension();
            $filename = "{$timeStamp}_{$request->name}.{$ext}";
            $uploadImage = Storage::disk('s3')->putFileAs('images/profile/'.Auth::id(), $image, $filename, 'public');
            $path = Storage::disk('s3')->url($uploadImage);
            // $path = $image->storeAs('profile/'.$id, $filename);
            $input['image'] = $path;
        }
        $profile->update($input);

        return $profile;
    }
}
