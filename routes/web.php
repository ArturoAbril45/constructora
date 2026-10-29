<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Catalogs\Index as CatalogsIndex;
use App\Livewire\Clients\Index as ClientsIndex;
use App\Livewire\Dashboard;
use App\Livewire\Expenses\Index as ExpensesIndex;
use App\Livewire\Leads\Index as LeadsIndex;
use App\Livewire\Payables\Index as PayablesIndex;
use App\Livewire\Procedures\Index as ProceduresIndex;
use App\Livewire\Projects\Show as ProjectsShow;
use App\Livewire\Projects\Index as ProjectsIndex;
use App\Livewire\Providers\Index as ProvidersIndex;
use App\Livewire\PurchaseOrders\Index as PurchaseOrdersIndex;
use App\Livewire\Receivables\Index as ReceivablesIndex;
use App\Livewire\Rentals\Index as RentalsIndex;
use App\Livewire\Reports\Admin as ReportsAdmin;
use App\Livewire\Reports\Operational as ReportsOperational;
use App\Livewire\Settings\Index as SettingsIndex;
use App\Livewire\Tests\Index as TestsIndex;
use App\Livewire\Tools\Index as ToolsIndex;
use App\Livewire\Warehouses\Index as WarehousesIndex;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

Route::post('/logout', LogoutController::class)->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/leads', LeadsIndex::class)->name('leads.index');

    Route::get('/projects', ProjectsIndex::class)->name('projects.index');
    Route::get('/projects/{project}', ProjectsShow::class)->name('projects.show');

    Route::get('/clients', ClientsIndex::class)->name('clients.index');
    Route::get('/providers', ProvidersIndex::class)->name('providers.index');
    Route::get('/warehouses', WarehousesIndex::class)->name('warehouses.index');
    Route::get('/tools', ToolsIndex::class)->name('tools.index');
    Route::get('/expenses', ExpensesIndex::class)->name('expenses.index');

    Route::get('/receivables/{type?}', ReceivablesIndex::class)->name('receivables.index');

    Route::get('/purchase-orders', PurchaseOrdersIndex::class)->name('purchase-orders.index');
    Route::get('/payables/{type?}', PayablesIndex::class)->name('payables.index');
    Route::get('/procedures', ProceduresIndex::class)->name('procedures.index');
    Route::get('/tests', TestsIndex::class)->name('tests.index');
    Route::get('/rentals', RentalsIndex::class)->name('rentals.index');

    Route::get('/reports/admin/{report?}', ReportsAdmin::class)->name('reports.admin');
    Route::get('/reports/operational/{report?}', ReportsOperational::class)->name('reports.operational');

    Route::get('/catalogs', CatalogsIndex::class)->name('catalogs.index');
    Route::get('/settings', SettingsIndex::class)->name('settings.index');
});
