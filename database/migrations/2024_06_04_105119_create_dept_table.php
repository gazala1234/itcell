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
        Schema::create('dept', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sname');
            $table->string('college');
            $table->string('cid');
            $table->string('hod');
            $table->string('mail');
            $table->string('contact');
            $table->string('prt');
            $table->string('academic');
            $table->string('type');
            $table->integer('nba');
            $table->string('status');
            $table->integer('type1');
            $table->integer('academic_type');            
            $table->timestamp('cdate')->useCurrent();
            $table->timestamp('udate')->useCurrent()->useCurrentOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dept');
    }
};
