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
        Schema::create('general_line_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained()->cascadeOnDelete();
            $table->morphs('lineable');
            $table->foreignId('service_id')->nullable()->constrained()->cascadeOnDelete();  
            $table->foreignId('service_provider_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('request_item_id')->nullable()->constrained()->cascadeOnDelete();
            $table->decimal('price', 22, 2)->default(0);
            $table->string('currency', 10)->default('TZS');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_line_items');
    }
};
