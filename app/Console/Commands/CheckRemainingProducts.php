<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CheckRemainingProducts extends Command
{
    protected $signature = 'products:remaining-check';

    protected $description = 'Check remaining products count every 5 minutes';

   public function handle()
{
    $productsPerUser = Product::join('users', 'products.user_id', '=', 'users.id')
        ->selectRaw('users.name as user_name, COUNT(products.id) as total_products')
        ->groupBy('users.name')
        ->get();

    foreach ($productsPerUser as $data) {
        Log::info(
            "User {$data->user_name} has {$data->total_products} products remaining"
        );
    }

    $this->info('Remaining products checked successfully');
}
}
