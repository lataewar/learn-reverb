<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('users.{id}', function (User $user, $id) {
  return (int) $user->id === (int) $id;
});


Broadcast::channel('chat', function () {

});

// Broadcast::channel('chat.room.{roomId}', function (User $user, $roomId) {
//   if() {
//     return false;
//   }
//   return true;
// });

Broadcast::channel('orders.{orderId}', function (User $user, $orderId) {
  if ($user->id != Order::findOrNew($orderId)->user_id)
    return false;

  return true;
});

Broadcast::channel('room.{roomId}', function (User $user, $roomId) {
  return [
    'id' => $user->id,
    'name' => $user->name,
  ];
});

Broadcast::channel('app', function (User $user) {
  return true;
});
