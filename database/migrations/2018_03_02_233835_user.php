<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->collation = 'utf8_general_ci';

            $table->increments('id');
            $table->integer('is_admin')->default(0);
            $table->integer('role')->default(0);
            $table->boolean('enable')->default(0);

            $table->string('gender', 1);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('picture')->nullable();
            $table->string('email')->unique();
            $table->string('password');

            $table->string('phone', 10)->unique();
            $table->string('birth_date', 11);

            $table->boolean('green_mod')->default(0);

            //  --> Partie livreur.
            $table->string('id_card_recto')->nullable();
            $table->string('id_card_verso')->nullable();
            $table->string('transport')->nullable();
            // <-- Partie livreur.

            $table->boolean('cgu');
            $table->datetime('cgu_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
