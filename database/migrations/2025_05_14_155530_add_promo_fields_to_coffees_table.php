<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('coffees', function (Blueprint $table) {
            $table->boolean('is_promo')->default(false)->after('availability');
            $table->decimal('promo_price', 8, 2)->nullable()->after('is_promo');
            $table->string('promo_description')->nullable()->after('promo_price');
        });
    }

    public function down()
    {
        Schema::table('coffees', function (Blueprint $table) {
            $table->dropColumn(['is_promo', 'promo_price', 'promo_description']);
        });
    }
};