<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Machinery;
use App\Models\Product;
use App\Models\Project;
use App\Models\Provider;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $branch1 = Branch::firstOrCreate(['name' => 'Sucursal 1']);
        $branch2 = Branch::firstOrCreate(['name' => 'Sucursal 2']);

        User::updateOrCreate(['email' => 'admin@constructori.com'], [
            'branch_id' => $branch1->id,
            'name' => 'Administrador',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'active' => true,
            'email_verified_at' => now(),
        ]);

        User::updateOrCreate(['email' => 'admin2@constructori.com'], [
            'branch_id' => $branch2->id,
            'name' => 'Administrador Sucursal 2',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'active' => true,
            'email_verified_at' => now(),
        ]);

        $client = Client::firstOrCreate(['name' => 'Grupo Residencial del Valle', 'branch_id' => $branch1->id], [
            'email' => 'contacto@grupovalle.com',
            'phone' => '55 1234 5678',
            'address' => 'Av. Reforma 123, CDMX',
        ]);

        $category = Category::firstOrCreate(['name' => 'Obra civil', 'branch_id' => $branch1->id]);
        $subcategory = Subcategory::firstOrCreate(['category_id' => $category->id, 'name' => 'Concreto y acero', 'branch_id' => $branch1->id]);

        $cement = Product::firstOrCreate(['name' => 'Cemento gris 50kg', 'branch_id' => $branch1->id], [
            'subcategory_id' => $subcategory->id, 'unit' => 'saco', 'sku' => 'CEM-001', 'reference_cost' => 210,
        ]);
        Product::firstOrCreate(['name' => 'Varilla 3/8"', 'branch_id' => $branch1->id], [
            'subcategory_id' => $subcategory->id, 'unit' => 'pza', 'sku' => 'VAR-038', 'reference_cost' => 145,
        ]);
        Product::firstOrCreate(['name' => 'Arena de río m3', 'branch_id' => $branch1->id], [
            'subcategory_id' => $subcategory->id, 'unit' => 'm3', 'sku' => 'ARE-001', 'reference_cost' => 480,
        ]);

        Provider::firstOrCreate(['name' => 'Materiales del Norte SA de CV', 'branch_id' => $branch1->id], [
            'type' => 'provider', 'phone' => '55 8765 4321', 'email' => 'ventas@matnorte.com',
        ]);
        Provider::firstOrCreate(['name' => 'Instalaciones Eléctricas García', 'branch_id' => $branch1->id], [
            'type' => 'subcontractor', 'phone' => '55 2468 1357', 'commission_percent' => 5,
        ]);

        Machinery::firstOrCreate(['name' => 'Retroexcavadora CAT 420', 'branch_id' => $branch1->id], ['daily_cost' => 3500]);
        Machinery::firstOrCreate(['name' => 'Revolvedora de concreto', 'branch_id' => $branch1->id], ['daily_cost' => 450]);

        Employee::firstOrCreate(['name' => 'Juan Pérez López', 'branch_id' => $branch1->id], ['position' => 'Albañil', 'daily_wage' => 450]);
        Employee::firstOrCreate(['name' => 'Miguel Hernández', 'branch_id' => $branch1->id], ['position' => 'Maestro de obra', 'daily_wage' => 650]);

        if (! Project::where('name', 'Residencial Casa Jimena')->exists()) {
            $project = Project::create([
                'branch_id' => $branch1->id,
                'name' => 'Residencial Casa Jimena',
                'type' => 'Vivienda residencial',
                'client_id' => $client->id,
                'resident_name' => 'Ing. Carlos Ramírez',
                'address' => 'Calle Los Pinos 45, Querétaro',
                'start_date' => now()->subMonths(2),
                'end_date' => now()->addMonths(4),
                'budget_total' => 10000000,
                'budget_control' => true,
                'status' => 'generated',
            ]);

            Warehouse::create(['branch_id' => $branch1->id, 'project_id' => $project->id, 'name' => $project->name.' - Almacén de obra', 'is_general' => false]);

            $project->budgetItems()->create([
                'product_id' => $cement->id, 'category_id' => $category->id, 'subcategory_id' => $subcategory->id,
                'qty_budgeted' => 500, 'unit_price' => 210,
            ]);

            $project->activities()->create([
                'category_id' => $category->id, 'subcategory_id' => $subcategory->id,
                'description' => 'Colado de losa de entrepiso', 'unit' => 'm2',
                'qty_budgeted' => 320, 'unit_price' => 380,
                'start_date' => now()->subMonth(), 'end_date' => now()->addMonth(),
            ]);
        }

        Warehouse::firstOrCreate(['is_general' => true, 'project_id' => null, 'branch_id' => $branch1->id], ['name' => 'Almacén general']);
    }
}
