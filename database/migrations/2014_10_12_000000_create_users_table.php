<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('office_id')->nullable();
            $table->timestamps();

            $table->foreign('office_id')->references('id')->on('offices');
        });

        DB::table('users')->insert([
            [
                'name' => 'Marcelo Moreira',
                'email' => 'marcelo@email.com',
                'password' => bcrypt('123456789'),
                'office_id' => null,
                'created_at' => now(),
            ],
            [
                'name' => 'João da Silva',
                'email' => 'joao@email.com',
                'password' => bcrypt('123456789'),
                'office_id' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Pedro da Silva',
                'email' => 'pedro@email.com',
                'password' => bcrypt('123456789'),
                'office_id' => 2,
                'created_at' => now(),
            ],
            [
                'name' => 'Carlos da Silva',
                'email' => 'carlos@email.com',
                'password' => bcrypt('123456789'),
                'office_id' => 3,
                'created_at' => now(),
            ],
            [
                'name' => 'Fernando da Silva',
                'email' => 'fernando@email.com',
                'password' => bcrypt('123456789'),
                'office_id' => 4,
                'created_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
