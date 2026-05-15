<?php

namespace App\Livewire\Message;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Pesan - CampusHub')]
#[Layout('components.layouts.app')]
class Inbox extends Component
{
    // State untuk filter tab (All, Buying, Selling)
    public $filter = 'all';

    public function render()
    {
        return view('livewire.message.inbox');
    }
}