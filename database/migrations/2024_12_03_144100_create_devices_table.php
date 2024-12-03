<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('device_id')->unique();
            $table->string('device_name')->nullable(); // Optional: to store device name/type
            $table->string('platform')->nullable(); // iOS, Android, etc.
            $table->boolean('is_biometric_enabled')->default(false);
            $table->timestamp('last_login_at')->nullable();
            $table->string('ip_address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
