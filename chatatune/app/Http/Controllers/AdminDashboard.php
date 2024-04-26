<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboard extends Controller
{
    public function getNombreJours()
    {
        $nombreEnregistrements = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = User::whereDate('created_at', $date)->count();
            $nombreEnregistrements[] = $count;
        }

        return response()->json(['statsUser' => $nombreEnregistrements]);
    }
}
