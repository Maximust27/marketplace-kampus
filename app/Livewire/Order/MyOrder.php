<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Services\OrderService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;
use Exception;

#[Layout('components.layouts.app')]
class MyOrder extends Component
{
    use WithPagination;

    public $status = 'all'; // all, pending, confirmed, completed, cancelled
    public $role = 'buyer'; // buyer, seller

    public $cancelOrderId = null;
    public $cancelReason = '';

    public function setStatus(string $status)
    {
        $this->status = $status;
        $this->resetPage();
    }

    public function setRole(string $role)
    {
        $this->role = $role;
        $this->resetPage();
    }

    public function confirmOrder(int $orderId, OrderService $orderService)
    {
        $order = Order::findOrFail($orderId);

        if (Gate::denies('confirm', $order)) {
            session()->flash('error', 'Anda tidak memiliki hak untuk mengonfirmasi pesanan ini.');
            return;
        }

        try {
            $orderService->confirmOrder($orderId, auth()->id());
            session()->flash('success', 'Pesanan berhasil dikonfirmasi.');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function completeOrder(int $orderId, OrderService $orderService)
    {
        $order = Order::findOrFail($orderId);

        if (Gate::denies('complete', $order)) {
            session()->flash('error', 'Anda tidak memiliki hak untuk menyelesaikan pesanan ini.');
            return;
        }

        try {
            $orderService->completeOrder($orderId, auth()->id());
            session()->flash('success', 'Pesanan telah selesai. Silakan berikan ulasan.');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function initiateCancel(int $orderId)
    {
        $this->cancelOrderId = $orderId;
        $this->cancelReason = '';
    }

    public function cancelOrder(OrderService $orderService)
    {
        if (!$this->cancelOrderId) return;

        $order = Order::findOrFail($this->cancelOrderId);

        if (Gate::denies('cancel', $order)) {
            session()->flash('error', 'Anda tidak memiliki hak untuk membatalkan pesanan ini.');
            $this->cancelOrderId = null;
            return;
        }

        try {
            $orderService->cancelOrder($this->cancelOrderId, auth()->id(), $this->cancelReason);
            session()->flash('success', 'Pesanan berhasil dibatalkan.');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        $this->cancelOrderId = null;
    }

    public function render(OrderService $orderService)
    {
        $orders = $this->role === 'buyer'
            ? $orderService->getUserOrders(auth()->id(), $this->status, 5)
            : $orderService->getSellerOrders(auth()->id(), $this->status, 5);

        return view('livewire.order.my-order', [
            'orders' => $orders,
        ])->title('Pesanan Saya - CampusHub');
    }
}