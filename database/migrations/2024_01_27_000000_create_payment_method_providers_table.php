<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('billable.table.prefix').'payment_method_providers', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');

            $table->string('tax_type');
            $table->double('tax_amount');

            $table->string('currency_support');

            $table->string('client_id')->nullable();
            $table->string('client_secret')->nullable();

//            $table->string('url_success');
//            $table->string('url_failure');

            $table->longText('options')->nullable();

            $table->boolean('active')->default(false);
        });

        foreach ( config('billable.providers', []) as $name => $provider)
        {
            DB::table(config('billable.table.prefix').'payment_method_providers')->insert([
                'id' => $name,
                'name' => $provider["name"],
                'tax_type' => $provider["tax"]["type"],
                'tax_amount' => $provider["tax"]["amount"],
                'currency_support' => implode(":", $provider["currencies"])
            ]);
        }
    }
};
