<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class UserUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function ($table) {
            $table->string('profile_image')->nullable()->after('phone');
            $table->integer('wallet')->after('profile_image')->default(10);
        });

        Artisan::call('create:admin');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns("users", [
            'profile_image', 'wallet'
        ]);
    }
}
