<?php

namespace App\Http\Controllers\users;

use App\Models\User;

class users
{
    public function listUsers(User $user) {
        $users = $user->withTrashed()->get();
        return view('admin.users', compact('users'));
    }

    public function dropUser(User $user) {
        $user->delete();
        return redirect('/listUsers')->with('success', 'user deleted successfully!');
    }
    public function restoreUser($id) {
        $user = User::withTrashed()->find($id);
        if($user) {
            $user->restore();
            return redirect('/listUsers')->with('success', 'user restored successfully!');
        }

    }
}
