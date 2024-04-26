<?php

namespace App\Http\Controllers\groups;

use App\Models\Group;

class groups
{
    public function listGroups(Group $group) {
        $groups = $group->withTrashed()->get();
        dd($groups);
        return view('admin.groups', compact('groups'));
    }

    public function dropGroup(Group $group) {
        $group->delete();
        return redirect('/listGroups')->with('success', 'group deleted successfully!');
    }
    public function restoreGroup($id) {
        $group = Group::withTrashed()->find($id);
        if($group) {
            $group->restore();
            return redirect('/listGroups')->with('success', 'group restored successfully!');
        }

    }
}
