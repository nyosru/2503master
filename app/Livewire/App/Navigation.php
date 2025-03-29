<?php

namespace App\Livewire\App;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Navigation extends Component
{
    public function logout()
    {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.app.navigation');
    }
}
