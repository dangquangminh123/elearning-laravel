<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       if (!Schema::hasTable('products')) {

            Schema::create('products', function (Blueprint

            $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('price');
                $table->mediumText('content');
                $table->boolean('active');
                $table->timestamps();
            });

        }
        if (Schema::hasColumn('products', 'warranty_info')) {
            //
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
