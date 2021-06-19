<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class PurchasedApp extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchased_apps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id')->nullable(false);
            $table->unsignedBigInteger('app_id')->nullable(false);
            $table->unsignedBigInteger('payment_plan_id')->nullable(false);
            $table->dateTime('purchased_at')->nullable(false);
            $table->dateTime('expired_at')->nullable(true);
            $table->timestamps();

            $table
                ->foreign('tenant_id', 'tenant_purchased_app_fk')
                ->references('id')
                ->on('tenants')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table
                ->foreign('app_id', 'apps_purchased_app_fk')
                ->references('id')
                ->on('apps')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table
                ->foreign('payment_plan_id', 'payment_plan_purchased_app_fk')
                ->references('id')
                ->on('payment_plans')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchased_apps');
    }
}
