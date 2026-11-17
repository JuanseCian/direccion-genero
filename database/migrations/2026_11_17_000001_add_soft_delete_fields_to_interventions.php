<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
        'direccion_genero_intervenciones',
        'masculinidades_intervenciones',
        'ive_intervenciones',
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (!Schema::hasColumn($tableName, 'deleted_at')) {
                    $table->softDeletes();
                }

                if (!Schema::hasColumn($tableName, 'deleted_by')) {
                    $table->unsignedBigInteger('deleted_by')->nullable();
                }

                if (!Schema::hasColumn($tableName, 'motivo_eliminacion')) {
                    $table->text('motivo_eliminacion')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                $columns = array_filter([
                    Schema::hasColumn($tableName, 'deleted_at') ? 'deleted_at' : null,
                    Schema::hasColumn($tableName, 'deleted_by') ? 'deleted_by' : null,
                    Schema::hasColumn($tableName, 'motivo_eliminacion') ? 'motivo_eliminacion' : null,
                ]);

                if ($columns) {
                    $table->dropColumn($columns);
                }
            });
        }
    }
};
