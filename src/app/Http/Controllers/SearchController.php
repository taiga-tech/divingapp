<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Profile;

class SearchController extends Controller
{
    public function search(Request $request, $search)
    {
        if ($request->query())
        {
            $key = array_keys($request->query())[0];
            $keyword = $request->query($key);
            if ($search == 'post')
            {
                $result = Post::where("$key", 'LIKE', "%$keyword%")
                    ->with('images', 'user', 'profile')
                    ->get();
            }
            elseif ($search == 'profile')
            {
                $result = Profile::where("$key", 'LIKE', "%$keyword%")
                    ->with('user', 'posts')
                    ->get();
            }
            
            return $result;
        }
    }
}
