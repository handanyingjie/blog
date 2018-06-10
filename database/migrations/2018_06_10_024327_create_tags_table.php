<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->unique();
            $table->string('slug',50)->unique();
//            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('tags')->insert([
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'Lumen', 'slug' => 'lumen'],
            ['name' => 'PHP', 'slug' => 'php'],
            ['name' => 'Javascript', 'slug' => 'javascript'],
            ['name' => 'Python', 'slug' => 'python'],
            ['name' => 'Linux', 'slug' => 'linux'],
            ['name' => 'Java', 'slug' => 'java'],
            ['name' => 'Swoole', 'slug' => 'swoole'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
