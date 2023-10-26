<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a admin for a blog_post_system';

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

        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $this->info(" admin is already created \n $admin->email ");
        } else {
            $user =  User::create([
                'name' => 'admin',
                'email' =>  'admin@mail.com',
                'phone' =>  '651461568',
                'role' => 'admin',
                'password' =>   Hash::make('admin123'),
            ]);

            DB::table('users')->where('id' ,$user->id)->update( ['email_verified_at' => Carbon::now() ]);

            Log::info($user);

            $this->info("\n admin email is admin@mail.com");
            $this->info("\n admin Password is admin123 \n");
        }
    }
}
