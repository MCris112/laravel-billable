<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('billable.table.prefix').'orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id');

//            $table->string('payment_provider_id');
//
            $table->string('preference_id')->nullable();
            $table->longText('preference_content')->nullable();
//            $table->string('state')->nullable();
            $table->string('totals_currency_code');
            $table->double('totals_discount')->nullable();
            $table->double('totals_amount');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on( config('billable.table.users') );
//            $table->foreign('payment_provider_id')->references('id')->on( config('billable.table.prefix').'payment_providers' );
        });
    }
};
