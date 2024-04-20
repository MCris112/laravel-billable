<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('billable.table.prefix').'invoices', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->string('invoiceable_type');
            $table->string('invoiceable_id');
            $table->integer('invoiceable_quantity');

            $table->string('payment_provider_id');


            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('sales_rep_id');

            $table->string('comment')->nullable();

            $table->string('currency_code');
            $table->double('subtotal');
            $table->double('tax_rate');
            $table->double('tax_value');

            $table->double('totals');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on( config('billable.table.users') );
            $table->foreign('payment_provider_id')->references('id')->on( config('billable.table.prefix').'payment_method_providers' );
        });
    }
};
