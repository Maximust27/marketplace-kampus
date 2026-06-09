<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use App\Enums\OrderStatus;

class OrderPolicy
{
    public function view(User $user, Order $order): bool
    {
        return $user->id === $order->buyer_id || $user->id === $order->seller_id;
    }

    public function confirm(User $user, Order $order): bool
    {
        return $user->id === $order->seller_id && $order->status === OrderStatus::Pending;
    }

    public function complete(User $user, Order $order): bool
    {
        return $user->id === $order->buyer_id && $order->status === OrderStatus::Confirmed;
    }

    public function cancel(User $user, Order $order): bool
    {
        if ($user->id !== $order->buyer_id && $user->id !== $order->seller_id) {
            return false;
        }

        return in_array($order->status, [OrderStatus::Pending, OrderStatus::Confirmed]);
    }
}
