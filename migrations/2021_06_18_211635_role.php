<?php

declare(strict_types=1);

use Carbon\Carbon;
use Hyperf\DbConnection\Db;
use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use App\Constants\User\SuperUserConstant;
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
            $table->unsignedBigInteger('app_id')->nullable(true);
            $table->string('name')->nullable(false);
            $table->timestamps();

            $table
                ->foreign('app_id', 'app_role_fk')
                ->references('id')
                ->on('apps')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['app_id', 'name']);
        });

        DB::table('roles')->insert([
            'id' => SuperUserConstant::getId(),
            'app_id' => null,
            'name' => SuperUserConstant::getName(),
            'created_at' => Carbon::now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
}
