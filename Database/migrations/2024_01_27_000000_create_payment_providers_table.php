<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('billable.table.prefix').'payment_providers', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');

            $table->string('tax_type');
            $table->double('tax_amount');

            $table->longText('options')->nullable();

            $table->boolean('active')->default(true);
        });

        DB::table(config('billable.table.prefix').'payment_providers')->insert([
            'id' => 'mercadopago',
            'name' => 'MercadoPago',
            'tax_type' => 'percent',
            'tax_amount' => 6.0
        ]);
    }
};
