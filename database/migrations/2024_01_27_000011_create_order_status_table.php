<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('billable.table.prefix').'order_status', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_id');
            $table->string('value');

            $table->string('description')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();

            $table->foreign('created_by')->references('id')->on( config('billable.table.users') );
            $table->foreign('order_id')->references('id')->on( config('billable.table.prefix').'orders' );
//            $table->foreign('payment_provider_id')->references('id')->on( config('billable.table.prefix').'payment_providers' );
        });
    }
};
