<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Individual;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Individual::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document', 14)->unique();
            $table->string('phone', 11);
            $table->string('mail')->unique();
            $table->string('address', 50);
            $table->string('number', 10);
            $table->string('complement', 20)->nullable();
            $table->string('district', 60);
            $table->string('city', 60);
            $table->string('cep', 9);
            $table->string('state', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Individual::TABLE);
    }
};
