<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class CreateNewProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('what is the product name?');
        $brand = $this->ask('what is the product brand?');
        $color = $this->ask('what is the product color?');
        $price = $this->ask('what is the product price?');
        $store = $this->ask('what is the product store?');

        try {
            Product::create([
                'name' => $name,
                'brand' => $brand,
                'color' => $color,
                'price' => $price,
                'store' => $store
            ]);

            $this->info('New product has been created!');
            Log::info('New product has been created!');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            Log::error($e);
        }
    }
}
