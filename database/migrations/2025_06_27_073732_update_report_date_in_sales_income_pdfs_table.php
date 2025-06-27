<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('sales_income_pdfs', function (Blueprint $table) {
        // Cambiar el tipo de columna a date si no lo estaba
        $table->date('report_date')->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales_income_pdfs', function (Blueprint $table) {
            //
        });
    }
};
