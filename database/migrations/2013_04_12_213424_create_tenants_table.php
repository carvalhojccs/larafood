<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
            $table->uuid('uuid');
            $table->string('cnpj')->unique()->comment('cnpj da empresa');
            $table->string('name')->unique()->comment('nome da empresa');
            $table->string('url')->unique();
            $table->string('email')->unique()->comment('Email de contato');
            $table->string('logo')->unique()->nullable();
            
            //Status tenant (se inativar 'N' ele perde o acesso ao sistema)
            $table->enum('active',['Y','N'])->default('Y')->comment('Status do Tenant');
            
            //Subscription
            $table->date('subscription')->nullable()->comment('Data da insrcição');
            $table->date('expires_at')->nullable()->comment('Data que expira o acesso ao sistema');
            $table->string('subscription_id',255)->nullable()->comment('Identificação do Gateway de pagamento');
            $table->boolean('subscription_active')->default(false)->comment('Assinatur ativa');
            $table->boolean('subscription_suspended')->default(false)->comment('Assinatura cancelada');
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
        Schema::dropIfExists('tenants');
    }
}
