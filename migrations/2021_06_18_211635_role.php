<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class Role extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_id');
            $table->string('name');
            $table->timestamps();

            $table
                ->foreign('app_id', 'app_role_fk')
                ->references('id')
                ->on('apps')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['app_id, name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
}
