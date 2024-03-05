<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('billable.table.prefix').'model_prices', function (Blueprint $table) {
            $table->id();

            $table->string('priceable_type');
            $table->string('priceable_id');
            $table->string('currency_code');

            $table->double('value');

            $table->timestamp('discount_start')->nullable();
            $table->timestamp('discount_end')->nullable();
        });
    }
};
