<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnderecoUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('end_logradouro', 80)->nullable();
            $table->string('end_numero', 15)->nullable();
            $table->string('end_complemento',50)->nullable();
            $table->string('end_bairro', 50)->nullable();
            $table->string('end_cidade', 50)->nullable();
            $table->string('end_uf', 2)->nullable();
            $table->string('end_cep', 8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('end_logradouro');
            $table->dropColumn('end_numero');
            $table->dropColumn('end_bairro');
            $table->dropColumn('end_complemento');
            $table->dropColumn('end_cidade');
            $table->dropColumn('end_uf');
            $table->dropColumn('end_cep');
        });
    }
}
