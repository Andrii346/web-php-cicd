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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->string('period', 7);
            $table->decimal('base_salary', 12, 2);
            $table->unsignedSmallInteger('worked_days');
            $table->decimal('bonus', 12, 2)->default(0.00);
            $table->decimal('tax_amount', 12, 2)->default(0.00);
            $table->decimal('net_salary', 12, 2);
            $table->enum('status', ['draft', 'calculated', 'paid'])->default('calculated');
            // $table->string('attachment_path')->nullable();
            $table->timestamps();
            // $table->softDeletes();

            $table->index(['period', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
