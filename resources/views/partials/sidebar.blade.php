@php
 $isActive = fn (string $pattern) => request()->routeIs($pattern) ? true : false;
 $groupOpen = fn (array $patterns) => collect($patterns)->contains(fn ($p) => request()->routeIs($p));
@endphp
<aside class="w-64 shrink-0 h-[calc(100vh-2rem)] sticky top-4 my-4 ml-4 bg-white border border-slate-200 shadow-lg flex flex-col" x-data="{ open: 'auto' }">
 <nav class="flex-1 overflow-y-auto py-6 px-3 text-sm">
 <p class="px-3 text-xs font-semibold tracking-wider text-slate-400 mb-2">MENÚ</p>

 <a href="{{ route('dashboard') }}" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 {{ $isActive('dashboard') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100' }}">
 <x-nav-icon name="chart" /> Tablero
 </a>

 <x-nav-group label="Módulo comercial" :open="$groupOpen(['leads.*', 'quotes.*'])">
 <a href="{{ route('leads.index') }}" wire:navigate class="x-sublink {{ $isActive('leads.*') ? 'x-sublink-active' : '' }}">Prospectos</a>
 </x-nav-group>

 <a href="{{ route('projects.index') }}" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 {{ $isActive('projects.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100' }}">
 <x-nav-icon name="layers" /> Proyectos
 </a>

 <a href="{{ route('clients.index') }}" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 {{ $isActive('clients.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100' }}">
 <x-nav-icon name="user" /> Clientes
 </a>

 <a href="{{ route('providers.index') }}" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 {{ $isActive('providers.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100' }}">
 <x-nav-icon name="truck" /> Proveedores/Subcontratos
 </a>

 <a href="{{ route('warehouses.index') }}" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 {{ $isActive('warehouses.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100' }}">
 <x-nav-icon name="box" /> Almacenes
 </a>

 <a href="{{ route('tools.index') }}" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 {{ $isActive('tools.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100' }}">
 <x-nav-icon name="tool" /> Inventario herramientas
 </a>

 <a href="{{ route('expenses.index') }}" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 {{ $isActive('expenses.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100' }}">
 <x-nav-icon name="list" /> Gastos generales
 </a>

 <x-nav-group label="Cuentas por cobrar" :open="$groupOpen(['receivables.*'])">
 <a href="{{ route('receivables.index', 'administracion') }}" wire:navigate class="x-sublink">Por administración</a>
 <a href="{{ route('receivables.index', 'contrato') }}" wire:navigate class="x-sublink">Por contrato</a>
 <a href="{{ route('receivables.index', 'estimacion') }}" wire:navigate class="x-sublink">Estimación</a>
 </x-nav-group>

 <x-nav-group label="Cuentas por pagar" :open="$groupOpen(['payables.*', 'purchase-orders.*'])">
 <a href="{{ route('purchase-orders.index') }}" wire:navigate class="x-sublink">Órdenes</a>
 <a href="{{ route('payables.index', 'compras') }}" wire:navigate class="x-sublink">Compras sin orden</a>
 <a href="{{ route('payables.index', 'subcontratos') }}" wire:navigate class="x-sublink">Pagos subcontratos</a>
 <a href="{{ route('payables.index', 'mano_obra') }}" wire:navigate class="x-sublink">Mano de obra</a>
 <a href="{{ route('payables.index', 'destajos') }}" wire:navigate class="x-sublink">Destajos</a>
 <a href="{{ route('procedures.index') }}" wire:navigate class="x-sublink">Trámites</a>
 <a href="{{ route('tests.index') }}" wire:navigate class="x-sublink">Pruebas</a>
 <a href="{{ route('payables.index', 'indirectos') }}" wire:navigate class="x-sublink">Gastos indirectos</a>
 <a href="{{ route('rentals.index') }}" wire:navigate class="x-sublink">Rentas</a>
 </x-nav-group>

 <x-nav-group label="Reportes administrativos" :open="$groupOpen(['reports.admin.*'])">
 <a href="{{ route('reports.admin', 'proyectos-cxp') }}" wire:navigate class="x-sublink">Proyectos cuentas por pagar</a>
 <a href="{{ route('reports.admin', 'consolidado-cxp') }}" wire:navigate class="x-sublink">Consolidado cuentas por pagar</a>
 <a href="{{ route('reports.admin', 'balance-proveedores') }}" wire:navigate class="x-sublink">Balance de proveedores</a>
 <a href="{{ route('reports.admin', 'pagado-cobrado') }}" wire:navigate class="x-sublink">Reporte pagado y cobrado</a>
 <a href="{{ route('reports.admin', 'estado-resultados') }}" wire:navigate class="x-sublink">Estado de resultados</a>
 </x-nav-group>

 <x-nav-group label="Reportes operativos" :open="$groupOpen(['reports.operational.*'])">
 <a href="{{ route('reports.operational', 'insumos-consumidos') }}" wire:navigate class="x-sublink">Insumos consumidos por proyecto</a>
 </x-nav-group>

 <a href="{{ route('catalogs.index') }}" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 {{ $isActive('catalogs.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100' }}">
 <x-nav-icon name="grid" /> Catálogos
 </a>

 <a href="{{ route('settings.index') }}" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 {{ $isActive('settings.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100' }}">
 <x-nav-icon name="settings" /> Configuraciones
 </a>
 </nav>
</aside>
