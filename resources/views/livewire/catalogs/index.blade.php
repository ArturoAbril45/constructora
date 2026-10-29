<div x-data="{
 showCategoryModal: @entangle('showCategoryModal'),
 showSubcategoryModal: @entangle('showSubcategoryModal'),
 showProductModal: @entangle('showProductModal'),
 showMachineryModal: @entangle('showMachineryModal'),
 showEmployeeModal: @entangle('showEmployeeModal'),
 }">
 <x-page-header title="Catálogos" subtitle="Partidas, subcategorías, insumos, maquinaria y empleados." />

 <div class="flex gap-2 mb-4 flex-wrap">
 <button wire:click="$set('tab','partidas')" class="px-4 py-2 text-sm {{ $tab==='partidas'?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600' }}">Partidas</button>
 <button wire:click="$set('tab','subcategorias')" class="px-4 py-2 text-sm {{ $tab==='subcategorias'?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600' }}">Subcategorías</button>
 <button wire:click="$set('tab','productos')" class="px-4 py-2 text-sm {{ $tab==='productos'?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600' }}">Insumos</button>
 <button wire:click="$set('tab','maquinaria')" class="px-4 py-2 text-sm {{ $tab==='maquinaria'?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600' }}">Maquinaria</button>
 <button wire:click="$set('tab','empleados')" class="px-4 py-2 text-sm {{ $tab==='empleados'?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600' }}">Empleados</button>
 </div>

 @if($tab === 'partidas')
 <div class="flex justify-end mb-3"><button wire:click="$set('showCategoryModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Partida</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm"><thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Nombre</th><th class="py-2.5 px-4 font-medium">Subcategorías</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
 <tbody>
 @forelse($categories as $category)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $category->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $category->subcategories_count }}</td>
 <td class="py-2.5 px-4 text-right"><button wire:click="deleteCategory({{ $category->id }})" wire:confirm="¿Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
 </tr>
 @empty
 <tr><td colspan="3" class="py-8 text-center text-slate-400">Sin partidas.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @elseif($tab === 'subcategorias')
 <div class="flex justify-end mb-3"><button wire:click="$set('showSubcategoryModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Subcategoría</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm"><thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Nombre</th><th class="py-2.5 px-4 font-medium">Partida</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
 <tbody>
 @forelse($subcategories as $sub)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $sub->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $sub->category?->name }}</td>
 <td class="py-2.5 px-4 text-right"><button wire:click="deleteSubcategory({{ $sub->id }})" wire:confirm="¿Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
 </tr>
 @empty
 <tr><td colspan="3" class="py-8 text-center text-slate-400">Sin subcategorías.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @elseif($tab === 'productos')
 <div class="flex justify-end mb-3"><button wire:click="$set('showProductModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Insumo</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm"><thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">SKU</th><th class="py-2.5 px-4 font-medium">Nombre</th><th class="py-2.5 px-4 font-medium">Unidad</th><th class="py-2.5 px-4 font-medium">Subcategoría</th><th class="py-2.5 px-4 font-medium">Costo ref.</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
 <tbody>
 @forelse($products as $product)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 text-slate-500">{{ $product->sku }}</td>
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $product->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $product->unit }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $product->subcategory?->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($product->reference_cost, 2) }}</td>
 <td class="py-2.5 px-4 text-right"><button wire:click="deleteProduct({{ $product->id }})" wire:confirm="¿Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
 </tr>
 @empty
 <tr><td colspan="6" class="py-8 text-center text-slate-400">Sin insumos.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @elseif($tab === 'maquinaria')
 <div class="flex justify-end mb-3"><button wire:click="$set('showMachineryModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Maquinaria</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm"><thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Nombre</th><th class="py-2.5 px-4 font-medium">Costo/día</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
 <tbody>
 @forelse($machinery as $item)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $item->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($item->daily_cost, 2) }}</td>
 <td class="py-2.5 px-4 text-right"><button wire:click="deleteMachinery({{ $item->id }})" wire:confirm="¿Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
 </tr>
 @empty
 <tr><td colspan="3" class="py-8 text-center text-slate-400">Sin maquinaria.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @elseif($tab === 'empleados')
 <div class="flex justify-end mb-3"><button wire:click="$set('showEmployeeModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Empleado</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm"><thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Nombre</th><th class="py-2.5 px-4 font-medium">Puesto</th><th class="py-2.5 px-4 font-medium">Salario diario</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
 <tbody>
 @forelse($employees as $employee)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $employee->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $employee->position }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($employee->daily_wage, 2) }}</td>
 <td class="py-2.5 px-4 text-right"><button wire:click="deleteEmployee({{ $employee->id }})" wire:confirm="¿Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
 </tr>
 @empty
 <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin empleados.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @endif

 <x-modal title="Nueva partida" show="showCategoryModal" max-width="max-w-sm">
 <form wire:submit="saveCategory" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="categoryName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('categoryName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showCategoryModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Nueva subcategoría" show="showSubcategoryModal" max-width="max-w-sm">
 <form wire:submit="saveSubcategory" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Partida</label>
 <select wire:model="subcategoryCategoryId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach
 </select>
 @error('subcategoryCategoryId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="subcategoryName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('subcategoryName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showSubcategoryModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Nuevo insumo" show="showProductModal" max-width="max-w-md">
 <form wire:submit="saveProduct" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Subcategoría</label>
 <select wire:model="productSubcategoryId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($subcategories as $sub)<option value="{{ $sub->id }}">{{ $sub->category?->name }} › {{ $sub->name }}</option>@endforeach
 </select>
 @error('productSubcategoryId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="productName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('productName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="grid grid-cols-3 gap-4">
 <div><label class="text-sm font-medium text-slate-700">SKU</label>
 <input wire:model="productSku" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Unidad</label>
 <input wire:model="productUnit" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Costo ref.</label>
 <input wire:model="productCost" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showProductModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Nueva maquinaria" show="showMachineryModal" max-width="max-w-sm">
 <form wire:submit="saveMachinery" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="machineryName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('machineryName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Costo por día</label>
 <input wire:model="machineryCost" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showMachineryModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Nuevo empleado" show="showEmployeeModal" max-width="max-w-sm">
 <form wire:submit="saveEmployee" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="employeeName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('employeeName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Puesto</label>
 <input wire:model="employeePosition" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Salario diario</label>
 <input wire:model="employeeWage" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showEmployeeModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>
</div>
