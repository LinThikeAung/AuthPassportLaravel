<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Feed;
use App\Comment;

class FeedApi extends Controller
{

    public function feed(){
        $feeds = Feed::orderBy('id','DESC')->paginate(10);
        return response()->json([
            'status'=>200,
            'message'=>'success',
            'data'=>$feeds,
        ]);
    }
    public function create(){  

        $user = Auth::user();     
        $image = request()->image;
        $image_name = uniqid().$image->getClientOriginalName();
        $path ='feed';
        $image->move($path,$image_name);

        $feed = Feed::create([
            'user_id'=>Auth::id(),
            'description'=>request()->description, 
            'image'=> "$path/$image_name"
        ]);
        return response()->json([
            'status'=>200,
            'message'=>'success',
            'data'=>$feed,
        ]);
    }

    public function delete(){

    }

    public function createComment(){

        $validate = Validator::make(request()->all(),[
            'feed_id'=>'required',
            'comment'=>'required',
        ]);

        if($validate->fails()){
            return response()->json([
                'status'=>500,
                'message'=>'failed',
                'data'=>$validate->errors()
            ]);
        }
        $comment = Comment::create([
            'user_id'=>Auth::id(),
            'feed_id' =>request()->feed_id,
            'comment'=>request()->comment 
        ]);
        return response()->json([
            'status'=>200,
            'message'=>'success',
            'data'=>$comment,
        ]);
    }
}
