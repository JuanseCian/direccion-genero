<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('denuncias', function (Blueprint $table) {
            if (!Schema::hasColumn('denuncias', 'edad')) {
                $table->unsignedTinyInteger('edad')->nullable()->after('dni');
            }

            if (!Schema::hasColumn('denuncias', 'tipo_amenaza')) {
                $table->string('tipo_amenaza', 150)->nullable()->after('tipo_violencia');
            }
        });
    }

    public function down(): void
    {
        Schema::table('denuncias', function (Blueprint $table) {
            if (Schema::hasColumn('denuncias', 'edad')) {
                $table->dropColumn('edad');
            }

            if (Schema::hasColumn('denuncias', 'tipo_amenaza')) {
                $table->dropColumn('tipo_amenaza');
            }
        });
    }
};
