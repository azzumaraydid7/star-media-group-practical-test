<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsentRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('consent_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('guid')->index();
            $table->timestamp('accepted_at')->nullable();
            $table->integer('version')->default(1);
            $table->string('ip', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consent_records');
    }
}