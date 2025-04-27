<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ouis', function (Blueprint $table) {
            $table->id();
            $table->string('assignment',6)->index()->unique();
            $table->string('registry');
            $table->string('organization_name');
            $table->string('organization_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ouis');
    }
};
