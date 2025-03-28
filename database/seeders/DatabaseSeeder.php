<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\ClassModel;
use App\Models\Company;
use App\Models\Customer;
use App\Models\CustomerAccess;
use App\Models\CustomerFeedback;
use App\Models\CustomerInteraction;
use App\Models\CustomerSupportTicket;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeSchedule;
use App\Models\Enrollment;
use App\Models\MedicalStudy;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Abel Arana',
            'email' => 'abel.arana@hotmail.com',
            'password' => bcrypt('lobomalo123'),
        ]);

        // Crear compañías y sucursales
        $company = Company::factory()->create(
            [
                'ruc' => '10436493903'
            ]
        );

        // Crear 3 sucursales para la compañía
        $branches = Branch::factory(3)->create([
            'company_id' => $company->id,
        ]);

        // Crear empleados para cada sucursal
        foreach ($branches as $branch) {
            // Crear 5 empleados por sucursal
            $employees = Employee::factory(5)->create([
                'branch_id' => $branch->id,
            ]);

            // Crear 2 instructores específicamente para clases
            $instructors = Employee::factory(2)->instructor()->create([
                'branch_id' => $branch->id,
            ]);

            // Crear horarios para los empleados
            foreach ($employees as $employee) {
                // Crear horarios para días de semana
                EmployeeSchedule::factory(3)->weekday()->create([
                    'employee_id' => $employee->id,
                    'branch_id' => $branch->id,
                ]);

                // Algunos empleados también trabajan en fin de semana
                if (rand(0, 1)) {
                    EmployeeSchedule::factory()->weekend()->create([
                        'employee_id' => $employee->id,
                        'branch_id' => $branch->id,
                    ]);
                }

                // Crear registros de asistencia
                EmployeeAttendance::factory(10)->create([
                    'empleado_id' => $employee->id,
                ]);
            }

            // Crear tipos de suscripción (los mismos para todas las sucursales)
            if ($branch->id === $branches[0]->id) {
                $mensual = SubscriptionType::factory()->create([
                    'name' => 'Mensual Básica',
                    'description' => 'Acceso a instalaciones básicas por un mes',
                    'price' => 500,
                    'duration' => 30,
                ]);

                $trimestral = SubscriptionType::factory()->create([
                    'name' => 'Trimestral',
                    'description' => 'Acceso a todas las instalaciones por tres meses',
                    'price' => 1300,
                    'duration' => 90,
                ]);

                $anual = SubscriptionType::factory()->create([
                    'name' => 'Anual Premium',
                    'description' => 'Acceso completo a instalaciones y clases por un año',
                    'price' => 4500,
                    'duration' => 365,
                ]);
            }

            // Crear clientes para cada sucursal
            $customers = Customer::factory(20)->create([
                'branch_id' => $branch->id,
            ]);

            // Crear clases para cada sucursal
            $classes = ClassModel::factory(8)->create([
                'branch_id' => $branch->id,
                'instructor_id' => $instructors->random()->id,
            ]);

            // Para cada cliente
            foreach ($customers as $customer) {
                // Crear suscripciones (algunas activas, algunas expiradas)
                if (rand(0, 1)) {
                    Subscription::factory()->active()->create([
                        'customer_id' => $customer->id,
                        'subscription_type_id' => rand(0, 2) ? $mensual->id : ($anual->id),
                    ]);
                } else {
                    Subscription::factory()->expired()->create([
                        'customer_id' => $customer->id,
                        'subscription_type_id' => rand(0, 1) ? $mensual->id : $trimestral->id,
                    ]);
                }

                // Crear registros de acceso
                $accessCount = rand(1, 15);
                CustomerAccess::factory($accessCount)->create([
                    'customer_id' => $customer->id,
                ]);

                // Algunos clientes tienen estudio médico
                if (rand(0, 3) > 0) {
                    MedicalStudy::factory()->create([
                        'cliente_id' => $customer->id,
                    ]);
                }

                // Crear pagos
                Payment::factory(rand(1, 3))->create([
                    'customer_id' => $customer->id,
                ]);

                // Algunos clientes dan feedback
                if (rand(0, 3) > 0) {
                    CustomerFeedback::factory()->create([
                        'customer_id' => $customer->id,
                    ]);
                }

                // Crear interacciones con clientes
                CustomerInteraction::factory(rand(0, 3))->create([
                    'customer_id' => $customer->id,
                ]);

                // Algunos clientes tienen tickets de soporte
                if (rand(0, 5) === 0) {
                    CustomerSupportTicket::factory()->create([
                        'customer_id' => $customer->id,
                    ]);
                }

                // Inscripción a clases (entre 0 y 3 clases por cliente)
                $classesToEnroll = $classes->random(rand(0, 3));
                foreach ($classesToEnroll as $class) {
                    Enrollment::factory()->create([
                        'cliente_id' => $customer->id,
                        'clase_id' => $class->id,
                    ]);
                }
            }
        }
    }
}
