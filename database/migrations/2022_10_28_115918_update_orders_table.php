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
        Schema::table('orders', function (Blueprint $table) {
            $table->double('price', 10, 2)->after('id');
            $table->double('tax', 10, 2)->nullable()->after('price');
            $table->double('total', 10, 2)->after('tax');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->double('price', 10, 2)->after('description');
            $table->double('tax', 10, 2)->nullable()->after('price');
            $table->double('total', 10, 2)->after('tax');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
