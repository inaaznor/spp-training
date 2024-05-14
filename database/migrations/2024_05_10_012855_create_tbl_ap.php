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
        Schema::create('tbl_ap', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('new_file_no');
            $table->string('other_file_no');
            $table->string('nokp');
            $table->string('old_kp');
            $table->integer('position_category_id');
            $table->date('file_date');
            $table->integer('status');
            $table->integer('reg_status');
            $table->string('location');
            $table->string('active');
            $table->date('dob');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ap');
    }
};
