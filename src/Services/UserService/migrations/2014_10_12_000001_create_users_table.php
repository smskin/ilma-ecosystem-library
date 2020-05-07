<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ilma\Ecosystem\Services\UserService\DBContext\DBContextUser;

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
            $table->bigInteger('id')->unsigned()->unique()->primary();
            $table->uuid('uid')->index()->unique();
            $table->string('mobile_phone')->index()->unique();
            $table->enum('role',DBContextUser::ROLES)->default(DBContextUser::ROLE_USER);
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('patronymic')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('email')->nullable();
            $table->string('avatar_x1')->nullable();
            $table->string('avatar_x2')->nullable();
            $table->tinyInteger('test_scenario')->default(0);
            $table->longText('public_key_x509')->nullable();
            $table->dateTime('public_key_valid_from')->nullable();
            $table->dateTime('public_key_valid_to')->nullable();
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
