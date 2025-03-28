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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            // Campos según el modelo oficial de Greenter\Model\Company\Company
            $table->string('ruc', 11)->comment('RUC de la empresa - 11 dígitos');
            $table->string('razon_social')->comment('Razón social según SUNAT');
            $table->string('nombre_comercial')->nullable()->comment('Nombre comercial');
            $table->string('email')->nullable()->comment('Correo electrónico de la empresa');
            $table->string('telephone')->nullable()->comment('Teléfono de la empresa');

            // Dirección - Se guardarán como campos separados para Greenter
            $table->string('ubigeo', 6)->nullable()->comment('Código de ubigeo - 6 dígitos');
            $table->string('departamento')->nullable()->comment('Departamento');
            $table->string('provincia')->nullable()->comment('Provincia');
            $table->string('distrito')->nullable()->comment('Distrito');
            $table->string('direccion')->nullable()->comment('Dirección completa');
            $table->string('cod_local', 4)->default('0000')->comment('Código de establecimiento asignado por SUNAT');

            // Logo para los PDFs de facturación
            $table->string('logo')->nullable()->comment('Ruta al logotipo de la empresa para facturas');

            // Campos adicionales necesarios para funcionalidad
            $table->string('website')->nullable()->comment('Sitio web de la empresa');
            $table->string('usuario_sol')->nullable()->comment('Usuario SOL para acceder a SUNAT');
            $table->string('clave_sol')->nullable()->comment('Clave SOL para acceder a SUNAT');
            $table->string('certificado_path')->nullable()->comment('Ruta al certificado digital');
            $table->string('certificado_password')->nullable()->comment('Contraseña del certificado digital');
            $table->enum('modo', ['produccion', 'desarrollo'])->default('desarrollo')->comment('Modo de operación');
            $table->string('serie_factura', 4)->nullable()->comment('Serie de facturas (F001)');
            $table->string('serie_boleta', 4)->nullable()->comment('Serie de boletas (B001)');
            $table->string('serie_nota_credito', 4)->nullable()->comment('Serie de notas de crédito (FC01, BC01)');
            $table->string('serie_nota_debito', 4)->nullable()->comment('Serie de notas de débito (FD01, BD01)');
            $table->string('serie_guia', 4)->nullable()->comment('Serie de guías de remisión (T001)');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
