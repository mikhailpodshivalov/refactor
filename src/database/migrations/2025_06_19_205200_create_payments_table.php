<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('settings')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->decimal('amount', 10, 2);
                $table->enum('method', ['card', 'crypto']);
                $table->enum('status', ['success', 'processing', 'failed'])->nullable();
                $table->timestamp('created_at');
            });
        }
    }

    public function down(): void {
        Schema::dropIfExists('payments');
    }
};

