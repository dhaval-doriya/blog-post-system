<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ClearTempImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:temp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $result =   Storage::disk('public_uploads')->deleteDirectory("temp-blog-images");
        if ($result) {
            $this->info(' "temp-blog-images" This Temporary Folder Is Deleted');
            Log::info(' "temp-blog-images" This Temporary Folder Is Deleted');
        }
    }
}
