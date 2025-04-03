<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id('salary_id');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('allowance', 10, 2);
            $table->decimal('total_salary', 10, 2);
            $table->integer('grade');
            $table->json('position');
            $table->decimal('tax_rate', 10, 2);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
};
