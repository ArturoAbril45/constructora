<?php

namespace App\Livewire\Catalogs;

use App\Models\Category;
use App\Models\Employee;
use App\Models\Machinery;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public string $tab = 'partidas';

    // Categoria (partida)
    public bool $showCategoryModal = false;
    public string $categoryName = '';

    // Subcategoria
    public bool $showSubcategoryModal = false;
    public string $subcategoryName = '';
    public $subcategoryCategoryId = '';

    // Producto
    public bool $showProductModal = false;
    public string $productName = '';
    public string $productUnit = 'pza';
    public string $productSku = '';
    public $productSubcategoryId = '';
    public string $productCost = '0';

    // Maquinaria
    public bool $showMachineryModal = false;
    public string $machineryName = '';
    public string $machineryCost = '0';

    // Empleado
    public bool $showEmployeeModal = false;
    public string $employeeName = '';
    public string $employeePosition = '';
    public string $employeeWage = '0';

    public function saveCategory(): void
    {
        $this->validate(['categoryName' => 'required|string|max:255']);
        Category::create(['name' => $this->categoryName]);
        $this->reset('categoryName', 'showCategoryModal');
    }

    public function saveSubcategory(): void
    {
        $this->validate([
            'subcategoryName' => 'required|string|max:255',
            'subcategoryCategoryId' => 'required|exists:categories,id',
        ]);
        Subcategory::create([
            'name' => $this->subcategoryName,
            'category_id' => $this->subcategoryCategoryId,
        ]);
        $this->reset('subcategoryName', 'subcategoryCategoryId', 'showSubcategoryModal');
    }

    public function saveProduct(): void
    {
        $this->validate([
            'productName' => 'required|string|max:255',
            'productSubcategoryId' => 'required|exists:subcategories,id',
        ]);
        Product::create([
            'name' => $this->productName,
            'unit' => $this->productUnit ?: 'pza',
            'sku' => $this->productSku,
            'subcategory_id' => $this->productSubcategoryId,
            'reference_cost' => $this->productCost ?: 0,
        ]);
        $this->reset('productName', 'productUnit', 'productSku', 'productSubcategoryId', 'productCost', 'showProductModal');
        $this->productUnit = 'pza';
    }

    public function saveMachinery(): void
    {
        $this->validate(['machineryName' => 'required|string|max:255']);
        Machinery::create(['name' => $this->machineryName, 'daily_cost' => $this->machineryCost ?: 0]);
        $this->reset('machineryName', 'machineryCost', 'showMachineryModal');
    }

    public function saveEmployee(): void
    {
        $this->validate(['employeeName' => 'required|string|max:255']);
        Employee::create([
            'name' => $this->employeeName,
            'position' => $this->employeePosition,
            'daily_wage' => $this->employeeWage ?: 0,
        ]);
        $this->reset('employeeName', 'employeePosition', 'employeeWage', 'showEmployeeModal');
    }

    public function deleteCategory(Category $category): void
    {
        $category->delete();
    }

    public function deleteSubcategory(Subcategory $subcategory): void
    {
        $subcategory->delete();
    }

    public function deleteProduct(Product $product): void
    {
        $product->delete();
    }

    public function deleteMachinery(Machinery $machinery): void
    {
        $machinery->delete();
    }

    public function deleteEmployee(Employee $employee): void
    {
        $employee->delete();
    }

    public function render()
    {
        return view('livewire.catalogs.index', [
            'categories' => Category::withCount('subcategories')->orderBy('name')->get(),
            'subcategories' => Subcategory::with('category')->orderBy('name')->get(),
            'products' => Product::with('subcategory')->orderBy('name')->get(),
            'machinery' => Machinery::orderBy('name')->get(),
            'employees' => Employee::orderBy('name')->get(),
        ]);
    }
}
