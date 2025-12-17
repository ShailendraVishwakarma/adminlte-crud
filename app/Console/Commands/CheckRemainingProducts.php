<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

use App\Models\User;

use App\Notifications\RemainingProductsNotification;

class CheckRemainingProducts extends Command
{
    protected $signature = 'products:remaining-check';

    protected $description = 'Check remaining products count every 5 minutes';

   public function handle()
{
    $productsPerUser = Product::join('users', 'products.user_id', '=', 'users.id')
        ->selectRaw('users.id as user_id, users.name as user_name, COUNT(products.id) as total_products')
        ->groupBy('users.id', 'users.name')
        ->get();

    foreach ($productsPerUser as $data) {

        // Log
        Log::info(
            "User {$data->user_name} has {$data->total_products} products remaining"
        );

        // Notification
        $user = User::find($data->user_id);
        if ($user) {
            $user->notify(
                new RemainingProductsNotification($data->total_products)
            );
        }
    }

    $this->info('Remaining products checked and notifications sent successfully');
}
}
