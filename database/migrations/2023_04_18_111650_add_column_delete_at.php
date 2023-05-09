<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDeleteAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->softDeletes();
        });
        Schema::table('categories', function ($table) {
            $table->softDeletes();
        });
        Schema::table('blogs', function ($table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropColumns("users", [
            'deleted_at'
        ]);

        Schema::dropColumns("categories", [
            'deleted_at'
        ]);

        Schema::dropColumns("blogs", [
            'deleted_at'
        ]);
    }
}
