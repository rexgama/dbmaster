<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dynamic_schemas', function (Blueprint $table) {
            $table->id();
            $table->string('table_name')->unique();
            $table->json('schema_definition');
            $table->json('form_definition')->nullable();
            $table->boolean('api_enabled')->default(true);
            $table->json('api_routes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dynamic_schemas');
    }
};