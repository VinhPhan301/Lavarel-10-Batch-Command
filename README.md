# Lavarel-10-Batch-Command

# Tự tạo câu lệnh Artisan 

- Sử dụng câu lệnh "php artisan make:command CreateNewProduct" để tạo ra một command class trong app/Console/Commands.
- Mở file CreateNewProduct.php
- Thay đổi $signature = 'create:product' (tham số $signature cho phép bạn định nghĩa tên câu lệnh)
- Thay đổi $description = 'Create a new product' (tham số $description cho phép bạn định nghĩa, miêu tả hành động của câu lệnh)
- Viết logic xử lý trong function handle:

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

- Để sử dụng được câu lệnh này chúng ta cần đăng ký nó trong app\Console\Kernel.php trong thuộc tính commands:

        protected $commands = [
            'App\Console\Commands\CreateNewProduct',
        ];

- Mở comand line lên và chạy lệnh php artisan create:product

# Tạo task scheduling trong laravel

- Sử dụng câu lệnh "php artisan make:command PostBlog" để tạo ra một command class trong app/Console/Commands.
- Mở file PostBlog.php
- Thay đổi $signature = 'post:blog' (tham số $signature cho phép bạn định nghĩa tên câu lệnh)
- Thay đổi $description = 'Post a new blog' (tham số $description cho phép bạn định nghĩa, miêu tả hành động của câu lệnh)
- Viết logic xử lý trong function handle:

        public function handle()
        {
            Blog::create([  
                'post_time' => Carbon::now(),
                'author' => 'Vinh Phan',
                'blog_title' => 'New blog title created at '.Carbon::now(),
            ]);

            $this->info('New blog has been posted!');
            Log::info('New blog has been posted!');
        }
- Để sử dụng được câu lệnh này chúng ta cần đăng ký nó trong app\Console\Kernel.php trong thuộc tính commands:

        protected $commands = [
            'App\Console\Commands\PostBlog',
        ];

- Định nghĩa Schedules trong function schedule(Schedule $schedule) ở App\Console\Kernel:

        protected function schedule(Schedule $schedule)
        {
            $schedule->command('post:blog')->everyMinute();  // Chạy command mỗi phút 1 lần
        }

- Mở comand line lên và chạy lệnh php artisan schedule:work