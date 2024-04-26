<?php

namespace App\Http\Controllers\posts;

use App\Models\Post;

class posts
{
    public function listPosts(Post $post) {
        $posts = $post->withTrashed()->get();
        return view('admin.posts', compact('posts'));
    }

    public function dropPost(Post $post) {
        $post->delete();
        return redirect('/listPosts')->with('success', 'post deleted successfully!');
    }
    public function restorePost($id) {
        $post = Post::withTrashed()->find($id);
        if($post) {
            $post->restore();
            return redirect('/listPosts')->with('success', 'post restored successfully!');
        }

    }
}
