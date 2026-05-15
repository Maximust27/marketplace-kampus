<?php

namespace App\Livewire\Order;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Pesanan Saya - CampusHub')]
#[Layout('components.layouts.app')]
class MyOrder extends Component
{
    // Logic sementara kosong untuk tampilan saja
    // Kedepannya kita akan memfilter berdasarkan status: Semua, Berlangsung, Selesai, Dibatalkan
    public $status = 'selesai'; 

    public function render()
    {
        return view('livewire.order.my-order');
    }
}