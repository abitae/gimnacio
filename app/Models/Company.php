<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Campos según modelo oficial Greenter\Model\Company\Company
        'ruc',
        'razon_social',
        'nombre_comercial',
        'email',
        'telephone',

        // Campos de dirección
        'ubigeo',
        'departamento',
        'provincia',
        'distrito',
        'direccion',
        'cod_local',

        // Logo
        'logo',

        // Campos adicionales necesarios
        'website',
        'usuario_sol',
        'clave_sol',
        'certificado_path',
        'certificado_password',
        'modo',
        'serie_factura',
        'serie_boleta',
        'serie_nota_credito',
        'serie_nota_debito',
        'serie_guia',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'clave_sol',
        'certificado_password',
    ];

    /**
     * Get the branches for the company.
     */
    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }

    /**
     * Obtiene la configuración para usar con Greenter.
     *
     * @return array
     */
    public function getGreenterConfig(): array
    {
        // Devuelve la estructura según el modelo oficial de Greenter\Company
        return [
            'ruc' => $this->ruc,
            'razonSocial' => $this->razon_social,
            'nombreComercial' => $this->nombre_comercial,
            'address' => [
                'ubigueo' => $this->ubigeo,
                'departamento' => $this->departamento,
                'provincia' => $this->provincia,
                'distrito' => $this->distrito,
                'direccion' => $this->direccion,
                'codLocal' => $this->cod_local,
            ],
            'email' => $this->email,
            'telephone' => $this->telephone,

            // Campos adicionales necesarios para la implementación
            'usuario' => $this->usuario_sol,
            'clave' => $this->clave_sol,
            'certificado' => $this->certificado_path,
            'claveCertificado' => $this->certificado_password,
            'produccion' => $this->modo === 'produccion',
            'logo' => $this->logo,
        ];
    }
}
