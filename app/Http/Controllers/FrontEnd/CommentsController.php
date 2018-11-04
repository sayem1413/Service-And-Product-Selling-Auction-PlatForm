<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Division;
use App\User;
use App\UserAddress;
use App\UserInfo;
use App\CardInfo;
use App\Comment;
use DB;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function addComment(Request $request) {
        
        $comment = new Comment();
        $comment->commentBody = $request->commentBody;
        $comment->user_id = $request->user_id;
        $comment->userName = $request->userName;
        $comment->auction_id = $request->auction_id;
        $comment->save();
        
        return response()->json($comment);
    }
    
    public function manageComment($id) {
        //$comments = Comment::where('user_id',$id)->paginate(5);
        $cardInfo = CardInfo::where('user_id',$id)->first();
        $comments = DB::table('user_comments_views')
                    ->select('user_comments_views.*')
                    ->where('user_comments_views.user_id', '=', $id)
                    ->paginate(5);
        $userAddress = UserAddress::where('user_id',$id)->first();
        $userInfo = UserInfo::where('user_id',$id)->first();
        
        return view('frontEnd.comment.manageComment',['cardInfo' => $cardInfo, 'comments' => $comments, 'userAddress' => $userAddress, 'userInfo' => $userInfo]);
    }
    
    public function editComment($id) {
        
        $cardInfo = CardInfo::where('user_id',$id)->first();
        $user_id = Auth::user()->id;
        $comment = Comment::where('id',$id)->first();
        $userAddress = UserAddress::where('user_id',$user_id)->first();
        $userInfo = UserInfo::where('user_id',$user_id)->first();
        
        return view('frontEnd.comment.editComment',['cardInfo' => $cardInfo, 'comment' => $comment, 'userAddress' => $userAddress, 'userInfo' => $userInfo]);
    }
    
    public function updateComment(Request $request) {
        
        $user_id = Auth::user()->id;
        $comment = Comment::where('id',$request->id)->first();
        $comment->commentBody = $request->commentBody;
        $comment->user_id = $request->user_id;
        $comment->userName = $request->userName;
        $comment->auction_id = $request->auction_id;
        $comment->save();
        
        return redirect()->to('/user/activity/'.$user_id)->with('message', 'Your Comment updated successfully!');
    }
    
    public function distroyComment($id) {
        $user_id = Auth::user()->id;
        $comment = Comment::where('id',$id)->first();
        $comment->delete();
        return redirect()->to('/user/activity/'.$user_id)->with('message', 'Comment deleted successfully!');
    }
    
}
