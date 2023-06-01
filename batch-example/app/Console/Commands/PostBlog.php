<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Blog;

class PostBlog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:blog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post a new blog';

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
        Blog::create([  
            'post_time' => Carbon::now(),
            'author' => 'Vinh Phan',
            'blog_title' => 'New blog title created at '.Carbon::now(),
        ]);

        $this->info('New blog has been posted!');
        Log::info('New blog has been posted!');
    }
}
