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
        Schema::table('rooms', function (Blueprint $table) {

            if (!Schema::hasColumn('rooms', 'name')) {
                $table->string('name');
            }

            if (!Schema::hasColumn('rooms', 'price')) {
                $table->decimal('price', 10, 2)->default(0);
            }

            if (!Schema::hasColumn('rooms', 'total_rooms')) {
                $table->integer('total_rooms')->default(0);
            }

            if (!Schema::hasColumn('rooms', 'available_rooms')) {
                $table->integer('available_rooms')->default(0);
            }

            if (!Schema::hasColumn('rooms', 'status')) {
                $table->string('status')->default('available');
            }

            if (!Schema::hasColumn('rooms', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'price',
                'total_rooms',
                'available_rooms',
                'status',
                'description',
            ]);
        });
    }
};
