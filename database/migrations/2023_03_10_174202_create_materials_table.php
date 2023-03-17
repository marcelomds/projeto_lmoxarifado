<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('materials')->insert([
            ['name' => 'Tijolo', 'quantity' => 5000, 'created_at' => now()],
            ['name' => 'Cimento', 'quantity' => 200, 'created_at' => now()],
            ['name' => 'Telha', 'quantity' => 1000, 'created_at' => now()],
            ['name' => 'Colher de Pedreiro', 'quantity' => 12, 'created_at' => now()],
            ['name' => 'Carrinho de Mão', 'quantity' => 6, 'created_at' => now()],
            ['name' => 'Tinta 20L', 'quantity' => 15, 'created_at' => now()]
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
