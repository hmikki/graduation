<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('student_id')->unique();
            $table->string('student_name')->nullable();
            $table->string('student_track')->nullable();
            $table->string('section_number')->nullable();
            $table->string('project_title')->nullable();
            $table->string('project_type')->nullable();
            $table->string('problem_description')->nullable();
            $table->string('solution_description')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('device_type')->nullable();
            $table->string('device_token')->nullable();
            $table->string('password');
            $table->string('app_locale')->default('en');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->boolean('active')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
