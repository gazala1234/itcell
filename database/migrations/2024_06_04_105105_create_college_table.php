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
        Schema::create('college', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('iname');
            $table->string('principal');
            $table->string('fcode');
            $table->string('contact');
            $table->string('email');
            $table->string('address');
            $table->string('status');
            $table->integer('prt');
            $table->string('sts');
            $table->integer('cwf_id');
            $table->timestamp('cdate')->useCurrent();
            $table->timestamp('udate')->useCurrent()->useCurrentOnUpdate();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college');
    }
};
