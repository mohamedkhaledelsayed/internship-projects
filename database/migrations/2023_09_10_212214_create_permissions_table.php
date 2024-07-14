<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->string('name');
            $table->string('category')->nullable();
            $table->string('action')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->primary(['role_id', 'permission_id']);
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');


            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('admin_role', function (Blueprint $table) {
            $table->primary(['role_id', 'admin_id']);
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('admin_id');


            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->foreign('admin_id')
                ->references('id')
                ->on('admins')
                ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
