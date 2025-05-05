<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminCredTable extends Migration
{
    public function up()
    {
        Schema::create('admin_cred', function (Blueprint $table) {
            $table->id(); 
            $table->string('name'); 
            $table->string('username')->unique(); 
            $table->string('password'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_cred');
    }
}
