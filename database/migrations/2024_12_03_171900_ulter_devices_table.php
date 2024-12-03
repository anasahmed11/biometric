<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up()
    {
        Schema::table('devices', function (Blueprint $table) {
            // Drop the existing unique constraint on device_id if it exists
            $table->dropUnique(['device_id']); // Only if device_id was previously unique

            // Add the composite unique constraint
            $table->unique(['user_id', 'device_id']);
        });
    }

    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {
            // Drop the composite unique constraint
            $table->dropUnique(['user_id', 'device_id']);

            // Optionally, re-add the unique constraint on device_id if needed
            $table->unique('device_id'); // Only if you want to restore the old behavior
        });
    }
};
