<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generar un RUC peruano sintético (20XXXXXXXXX para empresas)
        $ruc = '20' . fake()->numerify('########') . fake()->randomDigit();

        // Obtener un nombre de empresa en formato peruano
        $companyName = fake()->company();
        $razonSocial = strtoupper($companyName) . ' ' . fake()->randomElement(['S.A.C.', 'S.A.', 'E.I.R.L.', 'S.R.L.']);

        // Departamentos, provincias y distritos peruanos
        $departamentos = ['LIMA', 'AREQUIPA', 'CUSCO', 'LA LIBERTAD', 'PIURA'];
        $provincias = [
            'LIMA' => ['LIMA', 'CAÑETE', 'HUARAL'],
            'AREQUIPA' => ['AREQUIPA', 'CAYLLOMA', 'ISLAY'],
            'CUSCO' => ['CUSCO', 'URUBAMBA', 'SANTIAGO'],
            'LA LIBERTAD' => ['TRUJILLO', 'PACASMAYO', 'CHEPEN'],
            'PIURA' => ['PIURA', 'SULLANA', 'TALARA'],
        ];
        $distritos = [
            'LIMA' => ['MIRAFLORES', 'SAN ISIDRO', 'SURCO', 'LA MOLINA', 'SAN BORJA'],
            'CAÑETE' => ['SAN VICENTE', 'IMPERIAL', 'MALA'],
            'HUARAL' => ['HUARAL', 'CHANCAY', 'AUCALLAMA'],
            'AREQUIPA' => ['AREQUIPA', 'CAYMA', 'YANAHUARA', 'MIRAFLORES', 'JOSE LUIS BUSTAMANTE Y RIVERO'],
            'CAYLLOMA' => ['CHIVAY', 'CABANACONDE', 'TAPAY'],
            'ISLAY' => ['MOLLENDO', 'ISLAY', 'COCACHACRA'],
            'CUSCO' => ['CUSCO', 'WANCHAQ', 'SANTIAGO', 'SAN SEBASTIAN', 'SAN JERONIMO'],
            'URUBAMBA' => ['URUBAMBA', 'MACHUPICCHU', 'OLLANTAYTAMBO'],
            'TRUJILLO' => ['TRUJILLO', 'LA ESPERANZA', 'EL PORVENIR', 'VICTOR LARCO HERRERA'],
            'PIURA' => ['PIURA', 'CASTILLA', 'CATACAOS', 'TAMBO GRANDE'],
        ];

        // Seleccionar datos de ubicación
        $departamento = fake()->randomElement($departamentos);
        $provincia = fake()->randomElement($provincias[$departamento] ?? ['LIMA']);
        $distrito = fake()->randomElement($distritos[$provincia] ?? ['MIRAFLORES']);

        // Generar un ubigeo ficticio (los ubigeos reales tienen un formato definido)
        $ubigeo = fake()->numerify('######');

        // Dirección completa
        $direccion = 'AV. ' . fake()->streetName() . ' ' . fake()->buildingNumber();

        return [
            // Campos según modelo oficial Greenter\Model\Company\Company
            'ruc' => $ruc,
            'razon_social' => $razonSocial,
            'nombre_comercial' => $companyName,
            'email' => fake()->unique()->companyEmail(),
            'telephone' => fake()->phoneNumber(),

            // Dirección
            'ubigeo' => $ubigeo,
            'departamento' => $departamento,
            'provincia' => $provincia,
            'distrito' => $distrito,
            'direccion' => $direccion,
            'cod_local' => '0000',

            // Logo
            'logo' => 'company/logo/' . strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $companyName)) . '.png',

            // Campos adicionales necesarios
            'website' => fake()->url(),
            'usuario_sol' => strtolower(fake()->userName()) . $ruc,
            'clave_sol' => fake()->password(8, 12),
            'certificado_path' => 'certificates/' . $ruc . '.pfx',
            'certificado_password' => fake()->password(8, 12),
            'modo' => fake()->randomElement(['desarrollo', 'produccion']),
            'serie_factura' => 'F' . fake()->numerify('###'),
            'serie_boleta' => 'B' . fake()->numerify('###'),
            'serie_nota_credito' => 'FC' . fake()->numerify('##'),
            'serie_nota_debito' => 'FD' . fake()->numerify('##'),
            'serie_guia' => 'T' . fake()->numerify('###'),
        ];
    }

    /**
     * Configurar la empresa con modo de producción
     */
    public function produccion(): static
    {
        return $this->state(fn (array $attributes) => [
            'modo' => 'produccion',
        ]);
    }

    /**
     * Configurar la empresa con modo de desarrollo
     */
    public function desarrollo(): static
    {
        return $this->state(fn (array $attributes) => [
            'modo' => 'desarrollo',
        ]);
    }
}
