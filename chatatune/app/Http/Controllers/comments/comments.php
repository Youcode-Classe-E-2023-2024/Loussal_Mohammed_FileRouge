<?php

namespace App\Http\Controllers\comments;

use App\Models\Comment;

class comments
{
    public function listComments(Comment $comment) {
        $comments = $comment->withTrashed()->get();
        return view('admin.comments', compact('comments'));
    }

    public function dropComment(Comment $comment) {
        $comment->delete();
        return redirect('/listComments')->with('success', 'comment deleted successfully!');
    }
    public function restoreComment($id) {
        $comment = Comment::withTrashed()->find($id);
        if($comment) {
            $comment->restore();
            return redirect('/listComments')->with('success', 'comment restored successfully!');
        }

    }
}
