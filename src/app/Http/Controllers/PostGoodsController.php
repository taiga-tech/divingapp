<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostGood;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostGoodsController extends Controller
{
    public function __construct(PostGood $goods)
    {
        $this->middleware('auth');
        $this->goods = $goods;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $goods = Auth::user()->goods;
        $input = $request->all();

        if ($goods->count() != 0)
        {
            for ($i=0; $i < $goods->count(); $i++)
            {
                $goodBoolean = ( $input['post_id'] != $goods[$i]->post_id );
            }
        }
        else
        {
            $goodBoolean = true;
        }

        if ($goodBoolean) {
            $input['user_id'] = Auth::id();
            $input['profile_id'] = Auth::user()->profile->id;
            $good = $this->goods->create($input);
        }

        return $good;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $good = $this->goods->find($id);
        if (Auth::user()->profile->id == $good->profile->id) {
            $good->delete();
        }
        return $good;
    }
}
