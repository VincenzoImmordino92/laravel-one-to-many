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
        Schema::table('projects', function (Blueprint $table) {
            //creo la colonna della FK
            $table->unsignedBigInteger('type_id')->nullable()->after('id');
            //assegno la FK alla colonna creazione
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //elimino la FK(metto il nome della colonna in una array)
            $table->dropForeign(['type_id']);
            //elimino la colonna della FK
            $table->dropColumn('type_id');
        });
    }
};
