<?php

namespace App\Livewire\Lk;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Profile extends Component
{

    use WithFileUploads;

    public $name;
    public $email;
    public $avatar;
    public $avatarPreview;
    public $phone_number;
    public $telegram_id;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone_number = $user->phone_number;
        $this->telegram_id = $user->telegram_id;
        $this->email = $user->email;
        $this->avatarPreview = $user->avatar
            ? asset('storage/' . $user->avatar)
            : null;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image|max:1024',
        ]);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
//            'avatar' => 'nullable|image|max:1024',
        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;

//        if ($this->avatar) {
//            $avatarName = Str::random(10).'.'.$this->avatar->getClientOriginalExtension();
//            $this->avatar->storeAs('avatars', $avatarName, 'public');
//            $user->avatar = 'avatars/'.$avatarName;
//        }

        $user->save();
//        $this->avatarPreview = $user->avatar
//            ? asset('storage/' . $user->avatar)
//            : null;

        session()->flash('message', 'Профиль успешно обновлен');
    }

    public function render()
    {
        return view('livewire.lk.profile');
    }
}
