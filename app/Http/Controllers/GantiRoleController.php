<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GantiRoleController extends Controller
{
    //Mahasisa ke ketua_tim

    public function keKetua()
    {
         /** @var User $user */
        $user = Auth::user();
        if ($user->role !== 'mahasiswa') {
            abort(403);
        }
        $user->update(['role' => 'ketua_tim']);
        

        return redirect()->route('dashboard.ketua');
    }

    public function keMahasiswa()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->role !== 'ketua_tim') {
            abort(403);
        }
        $user->update(['role' => 'mahasiswa']);
        

        return redirect()->route('dashboard.mahasiswa');
    }
}
