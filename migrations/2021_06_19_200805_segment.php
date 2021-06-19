<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class Segment extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('segments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('segments');
    }
}
