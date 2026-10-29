<div x-data="{ showModal: @entangle('showModal'), showBranchModal: @entangle('showBranchModal') }">
    <div class="flex items-center justify-between mb-5">
        <x-page-header title="Configuraciones" subtitle="Usuarios, roles y sucursales del sistema." />
        @if($tab === 'usuarios')
            <button wire:click="create" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Agregar usuario</button>
        @else
            <button wire:click="createBranch" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Nueva sucursal</button>
        @endif
    </div>

    <div class="flex gap-2 mb-4">
        <button wire:click="$set('tab', 'usuarios')" class="px-4 py-2 text-sm {{ $tab==='usuarios'?'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200':'bg-white border border-slate-200 text-slate-600' }}">Usuarios</button>
        <button wire:click="$set('tab', 'sucursales')" class="px-4 py-2 text-sm {{ $tab==='sucursales'?'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200':'bg-white border border-slate-200 text-slate-600' }}">Sucursales</button>
    </div>

    @if($tab === 'usuarios')
        <div class="bg-white border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50">
                    <th class="py-2.5 px-4 font-medium">Nombre</th><th class="py-2.5 px-4 font-medium">Correo</th>
                    <th class="py-2.5 px-4 font-medium">Sucursal</th>
                    <th class="py-2.5 px-4 font-medium">Rol</th><th class="py-2.5 px-4 font-medium">Estatus</th>
                    <th class="py-2.5 px-4 font-medium text-right">Opciones</th>
                </tr></thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 font-medium text-slate-700">{{ $user->name }}</td>
                            <td class="py-2.5 px-4 text-slate-500">{{ $user->email }}</td>
                            <td class="py-2.5 px-4 text-slate-500">{{ $user->branch?->name ?? '—' }}</td>
                            <td class="py-2.5 px-4 text-slate-500">{{ $roles[$user->role] ?? $user->role }}</td>
                            <td class="py-2.5 px-4">
                                <button wire:click="toggleActive({{ $user->id }})" class="px-2 py-1 text-xs {{ $user->active?'bg-emerald-100 text-emerald-700':'bg-slate-100 text-slate-500' }}">{{ $user->active?'Activo':'Inactivo' }}</button>
                            </td>
                            <td class="py-2.5 px-4 text-right">
                                <button wire:click="edit({{ $user->id }})" class="text-orange-600 hover:underline text-xs font-medium">Editar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50">
                    <th class="py-2.5 px-4 font-medium">Sucursal</th><th class="py-2.5 px-4 font-medium">Usuarios</th>
                    <th class="py-2.5 px-4 font-medium">Estatus</th>
                </tr></thead>
                <tbody>
                    @forelse($branches as $branch)
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 font-medium text-slate-700">{{ $branch->name }}</td>
                            <td class="py-2.5 px-4 text-slate-500">{{ $branch->users_count }}</td>
                            <td class="py-2.5 px-4">
                                <button wire:click="toggleBranchActive({{ $branch->id }})" class="px-2 py-1 text-xs {{ $branch->active?'bg-emerald-100 text-emerald-700':'bg-slate-100 text-slate-500' }}">{{ $branch->active?'Activa':'Inactiva' }}</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="py-8 text-center text-slate-400">Sin sucursales registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif

    <x-modal title="Usuario" max-width="max-w-md">
        <form wire:submit="save" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">Nombre</label>
                <input wire:model="name" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div><label class="text-sm font-medium text-slate-700">Correo</label>
                <input wire:model="email" type="email" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div><label class="text-sm font-medium text-slate-700">Contraseña {{ $editingId ? '(dejar en blanco para no cambiar)' : '' }}</label>
                <input wire:model="password" type="password" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                @error('password') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Rol</label>
                    <select wire:model="role" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                        @foreach($roles as $val => $label)<option value="{{ $val }}">{{ $label }}</option>@endforeach
                    </select>
                </div>
                <div><label class="text-sm font-medium text-slate-700">Teléfono</label>
                    <input wire:model="phone" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
            </div>
        </form>
    </x-modal>

    <x-modal title="Nueva sucursal" show="showBranchModal" max-width="max-w-md">
        <form wire:submit="saveBranch" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">Nombre de la sucursal</label>
                <input wire:model="branchName" type="text" placeholder="Sucursal 2" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                @error('branchName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <p class="text-xs text-slate-400 border-t border-slate-100 pt-3">Credenciales del administrador de esta sucursal</p>
            <div><label class="text-sm font-medium text-slate-700">Nombre del administrador</label>
                <input wire:model="branchAdminName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                @error('branchAdminName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div><label class="text-sm font-medium text-slate-700">Correo</label>
                <input wire:model="branchAdminEmail" type="email" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                @error('branchAdminEmail') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div><label class="text-sm font-medium text-slate-700">Contraseña</label>
                <input wire:model="branchAdminPassword" type="password" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                @error('branchAdminPassword') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showBranchModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Crear sucursal</button>
            </div>
        </form>
    </x-modal>
</div>
