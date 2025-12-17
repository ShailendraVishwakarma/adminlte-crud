<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductLog; // DB logs
use App\Notifications\RemainingProductsNotification;
use Illuminate\Support\Facades\Log;

class CheckRemainingProducts extends Command
{
    protected $signature = 'products:remaining-check';
    protected $description = 'Check remaining products count every 5 minutes';

    public function handle()
    {
        // Products per user
        $productsPerUser = Product::join('users', 'products.user_id', '=', 'users.id')
            ->selectRaw('users.id as user_id, users.name as user_name, COUNT(products.id) as total_products')
            ->groupBy('users.id', 'users.name')
            ->get();

        foreach ($productsPerUser as $data) {

            // 1️⃣ Log to laravel.log
            Log::info(
                "User {$data->user_name} has {$data->total_products} products remaining"
            );

            // 2️⃣ Save to DB
            ProductLog::create([
                'user_id' => $data->user_id,
                'user_name' => $data->user_name,
                'total_products' => $data->total_products,
                'status' => 'Checked', // optional field
            ]);

            // 3️⃣ Send Notification to user
            $user = User::find($data->user_id);
            if ($user) {
                $user->notify(
                    new RemainingProductsNotification($data->total_products)
                );
            }
        }

        $this->info('Remaining products checked, logged, and notifications sent successfully');
    }
}
