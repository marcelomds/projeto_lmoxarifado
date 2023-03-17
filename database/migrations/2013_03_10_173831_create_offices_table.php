<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('offices')->insert([
            ['name' => 'Engenheiro Civil', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arquiteto', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Técnico em Edificações', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pedreiro', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Encanador', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Eletricista', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mestre de Obras', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Carpinteiro', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pintor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Azulejista', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gesseiro', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Instalador de Drywall', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offices');
    }
}
