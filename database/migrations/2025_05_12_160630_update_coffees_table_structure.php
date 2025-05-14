<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('coffees', function (Blueprint $table) {
            // First drop the existing availability column
            $table->dropColumn('availability');
            
            // Change price to decimal
            $table->decimal('price', 8, 2)->change();
        });

        Schema::table('coffees', function (Blueprint $table) {
            // Re-add the availability column after image
            $table->boolean('availability')->default(true)->after('image');
        });
    }

    public function down()
    {
        Schema::table('coffees', function (Blueprint $table) {
            // Revert price to string
            $table->string('price')->change();
            
            // Remove and re-add availability at its original position
            $table->dropColumn('availability');
            $table->boolean('availability')->default(true);
        });
    }
};