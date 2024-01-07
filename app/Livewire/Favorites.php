<?php

namespace App\Livewire;

use Livewire\Component;

class Favorites extends Component
{
    public function render()
    {
        return view('livewire.favorites')->layout('layouts.app');
    }
}
