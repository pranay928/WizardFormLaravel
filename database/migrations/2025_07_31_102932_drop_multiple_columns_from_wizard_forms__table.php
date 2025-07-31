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
        Schema::table('wizard_forms', function (Blueprint $table) {
             $table->dropColumn(['dd', 'mm', 'yyyy']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wizard_forms_', function (Blueprint $table) {
            //
        });
    }
};
