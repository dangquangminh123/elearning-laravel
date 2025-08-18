<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function(Blueprint $table) {
            $table->unsignedInteger('type_id')->change(); 
            $table->foreign('type_id')->references('id')->on('course_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses',  function (Blueprint $table) {
            $table->dropForeign('courses_type_id_foreign');
        });
    }
};
