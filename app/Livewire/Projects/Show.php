<?php

namespace App\Livewire\Projects;

use App\Models\AccountPayable;
use App\Models\AccountReceivable;
use App\Models\Category;
use App\Models\Employee;
use App\Models\InventoryMovement;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectActivity;
use App\Models\ProjectBudgetItem;
use App\Models\ProjectEstimation;
use App\Models\ProjectEstimationItem;
use App\Models\ProjectGalleryImage;
use App\Models\ProjectIndirectExpense;
use App\Models\ProjectLog;
use App\Models\ProjectPieceworkItem;
use App\Models\ProjectPieceworkRequest;
use App\Models\ProjectProcedure;
use App\Models\ProjectRental;
use App\Models\ProjectRequisition;
use App\Models\ProjectRequisitionItem;
use App\Models\ProjectSubcontract;
use App\Models\ProjectSubcontractPayment;
use App\Models\ProjectTest;
use App\Models\Provider;
use App\Models\PurchaseOrder;
use App\Models\Subcategory;
use App\Models\WarehouseStock;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class Show extends Component
{
    use WithFileUploads;

    public Project $project;

    public string $tab = 'resumen';

    // Presupuesto insumos
    public bool $showBudgetModal = false;
    public $budgetProductId = '';
    public $budgetCategoryId = '';
    public $budgetSubcategoryId = '';
    public string $budgetQty = '';
    public string $budgetPrice = '';
    public bool $budgetExtraordinary = false;

    // Actividades
    public bool $showActivityModal = false;
    public string $activityDescription = '';
    public string $activityUnit = 'pza';
    public string $activityQty = '';
    public string $activityPrice = '';
    public $activityCategoryId = '';
    public $activitySubcategoryId = '';
    public string $activityStart = '';
    public string $activityEnd = '';

    // Requisiciones
    public bool $showRequisitionModal = false;
    public string $requisitionComment = '';
    public array $requisitionItems = [];

    // Ordenes (generar desde requisicion)
    public bool $showOrderModal = false;
    public ?int $orderRequisitionId = null;
    public $orderProviderId = '';
    public bool $orderRequiresInvoice = true;
    public array $orderItems = [];

    // Almacen
    public bool $showStockOutModal = false;
    public $stockOutProductId = '';
    public string $stockOutQty = '';

    // Subcontratos
    public bool $showSubcontractModal = false;
    public $subcontractProviderId = '';
    public $subcontractCategoryId = '';
    public $subcontractSubcategoryId = '';
    public string $subcontractDescription = '';
    public string $subcontractStart = '';
    public string $subcontractEnd = '';
    public string $subcontractAmount = '';

    public bool $showSubcontractPayModal = false;
    public ?int $payingSubcontractId = null;
    public string $subcontractPayAmount = '';
    public string $subcontractPayDate = '';
    public string $subcontractPayComment = '';

    // Rentas
    public bool $showRentalModal = false;
    public $rentalMachineryId = '';
    public string $rentalStart = '';

    // Mano de obra
    public bool $showLaborPaymentModal = false;
    public string $laborWeekStart = '';
    public string $laborWeekEnd = '';
    public string $laborAmount = '';

    // Destajos
    public bool $showPieceworkModal = false;
    public string $pieceworkWorkerType = 'employee';
    public $pieceworkEmployeeId = '';
    public $pieceworkProviderId = '';
    public string $pieceworkStart = '';
    public string $pieceworkEnd = '';
    public array $pieceworkItems = [];

    // Estimaciones
    public bool $showEstimationModal = false;
    public string $estimationStart = '';
    public string $estimationEnd = '';
    public string $estimationAmortization = '0';
    public string $estimationGuarantee = '0';
    public array $estimationItems = [];

    // Gastos indirectos
    public bool $showIndirectModal = false;
    public $indirectCategoryId = '';
    public $indirectSubcategoryId = '';
    public string $indirectDescription = '';
    public string $indirectAmount = '';
    public string $indirectDate = '';

    // Tramites
    public bool $showProcedureModal = false;
    public string $procedureControlNumber = '';
    public string $procedureManagerName = '';
    public string $procedureDependency = '';

    // Pruebas
    public bool $showTestModal = false;
    public string $testName = '';
    public string $testLower = '';
    public string $testUpper = '';
    public string $testResult = '';
    public string $testDate = '';

    // Bitacora
    public bool $showLogModal = false;
    public string $logDescription = '';
    public string $logDate = '';

    // Galeria
    public bool $showGalleryModal = false;
    public $galleryImage = null;
    public string $galleryCaption = '';

    public function mount(Project $project): void
    {
        $this->project = $project;
        $today = now()->format('Y-m-d');
        $this->activityStart = $today;
        $this->activityEnd = $today;
        $this->subcontractStart = $today;
        $this->subcontractPayDate = $today;
        $this->rentalStart = $today;
        $this->pieceworkStart = $today;
        $this->pieceworkEnd = $today;
        $this->estimationStart = $today;
        $this->estimationEnd = $today;
        $this->indirectDate = $today;
        $this->testDate = $today;
        $this->logDate = $today;
    }

    public function setTab(string $tab): void
    {
        $this->tab = $tab;
    }

    // ---------- Presupuesto ----------
    public function addBudgetItem(): void
    {
        $this->validate([
            'budgetProductId' => 'required|exists:products,id',
            'budgetQty' => 'required|numeric|min:0.001',
            'budgetPrice' => 'required|numeric|min:0',
        ]);

        ProjectBudgetItem::create([
            'project_id' => $this->project->id,
            'product_id' => $this->budgetProductId,
            'category_id' => $this->budgetCategoryId ?: null,
            'subcategory_id' => $this->budgetSubcategoryId ?: null,
            'qty_budgeted' => $this->budgetQty,
            'unit_price' => $this->budgetPrice,
            'extraordinary' => $this->budgetExtraordinary,
        ]);

        $this->reset(['budgetProductId', 'budgetCategoryId', 'budgetSubcategoryId', 'budgetQty', 'budgetPrice', 'budgetExtraordinary']);
        $this->showBudgetModal = false;
    }

    public function deleteBudgetItem(ProjectBudgetItem $item): void
    {
        $item->delete();
    }

    // ---------- Actividades ----------
    public function addActivity(): void
    {
        $this->validate([
            'activityDescription' => 'required|string|max:255',
            'activityQty' => 'required|numeric|min:0.001',
            'activityPrice' => 'required|numeric|min:0',
        ]);

        ProjectActivity::create([
            'project_id' => $this->project->id,
            'category_id' => $this->activityCategoryId ?: null,
            'subcategory_id' => $this->activitySubcategoryId ?: null,
            'description' => $this->activityDescription,
            'unit' => $this->activityUnit ?: 'pza',
            'qty_budgeted' => $this->activityQty,
            'unit_price' => $this->activityPrice,
            'start_date' => $this->activityStart ?: null,
            'end_date' => $this->activityEnd ?: null,
        ]);

        $this->reset(['activityDescription', 'activityQty', 'activityPrice', 'activityCategoryId', 'activitySubcategoryId']);
        $this->activityUnit = 'pza';
        $this->showActivityModal = false;
    }

    public function updateActivityProgress(ProjectActivity $activity, $percent): void
    {
        $percent = max(0, min(100, (float) $percent));
        $activity->update(['percent_complete' => $percent, 'finished' => $percent >= 100]);
    }

    public function deleteActivity(ProjectActivity $activity): void
    {
        $activity->delete();
    }

    // ---------- Requisiciones ----------
    public function addRequisitionRow(): void
    {
        $this->requisitionItems[] = ['product_id' => '', 'qty' => '', 'receiver_name' => ''];
    }

    public function removeRequisitionRow(int $index): void
    {
        unset($this->requisitionItems[$index]);
        $this->requisitionItems = array_values($this->requisitionItems);
    }

    public function openRequisitionModal(): void
    {
        $this->requisitionItems = [['product_id' => '', 'qty' => '', 'receiver_name' => '']];
        $this->requisitionComment = '';
        $this->showRequisitionModal = true;
    }

    public function saveRequisition(): void
    {
        $this->validate([
            'requisitionItems.*.product_id' => 'required|exists:products,id',
            'requisitionItems.*.qty' => 'required|numeric|min:0.001',
        ]);

        $requisition = ProjectRequisition::create([
            'project_id' => $this->project->id,
            'requested_by' => auth()->id(),
            'comment' => $this->requisitionComment,
            'status' => 'pending',
        ]);

        foreach ($this->requisitionItems as $row) {
            ProjectRequisitionItem::create([
                'requisition_id' => $requisition->id,
                'product_id' => $row['product_id'],
                'qty' => $row['qty'],
                'receiver_name' => $row['receiver_name'] ?? '',
            ]);
        }

        $this->showRequisitionModal = false;
    }

    public function authorizeRequisition(ProjectRequisition $requisition): void
    {
        $requisition->update(['status' => 'authorized']);
    }

    public function cancelRequisition(ProjectRequisition $requisition): void
    {
        $requisition->update(['status' => 'cancelled']);
    }

    // ---------- Ordenes desde requisicion ----------
    public function openOrderModal(ProjectRequisition $requisition): void
    {
        $requisition->load('items.product');

        $this->orderRequisitionId = $requisition->id;
        $this->orderProviderId = '';
        $this->orderRequiresInvoice = true;
        $this->orderItems = $requisition->items->map(fn ($item) => [
            'requisition_item_id' => $item->id,
            'product_id' => $item->product_id,
            'product_name' => $item->product->name,
            'qty' => max(0, $item->qty - $item->qty_ordered),
            'unit_price' => $item->product->reference_cost,
        ])->filter(fn ($row) => $row['qty'] > 0)->values()->all();

        $this->showOrderModal = true;
    }

    public function saveOrder(): void
    {
        $this->validate([
            'orderProviderId' => 'required|exists:providers,id',
            'orderItems.*.qty' => 'required|numeric|min:0',
            'orderItems.*.unit_price' => 'required|numeric|min:0',
        ]);

        $requisition = ProjectRequisition::findOrFail($this->orderRequisitionId);
        $orderNumber = 'P'.$this->project->id.'.R'.$requisition->id.'.'.(PurchaseOrder::where('requisition_id', $requisition->id)->count() + 1);

        $order = PurchaseOrder::create([
            'order_number' => $orderNumber,
            'project_id' => $this->project->id,
            'requisition_id' => $requisition->id,
            'provider_id' => $this->orderProviderId,
            'requires_invoice' => $this->orderRequiresInvoice,
            'date' => now()->format('Y-m-d'),
            'status' => 'pending',
        ]);

        foreach ($this->orderItems as $row) {
            if ((float) $row['qty'] <= 0) {
                continue;
            }

            $order->items()->create([
                'product_id' => $row['product_id'],
                'qty' => $row['qty'],
                'unit_price' => $row['unit_price'],
            ]);

            ProjectRequisitionItem::where('id', $row['requisition_item_id'])->increment('qty_ordered', $row['qty']);
        }

        $this->showOrderModal = false;
    }

    // ---------- Almacen ----------
    public function stockOut(): void
    {
        $warehouse = $this->project->warehouses()->where('is_general', false)->first();

        if (! $warehouse) {
            return;
        }

        $this->validate([
            'stockOutProductId' => 'required|exists:products,id',
            'stockOutQty' => 'required|numeric|min:0.001',
        ]);

        InventoryMovement::create([
            'warehouse_id' => $warehouse->id,
            'product_id' => $this->stockOutProductId,
            'type' => 'out',
            'qty' => $this->stockOutQty,
            'received_by' => auth()->id(),
            'date' => now()->format('Y-m-d'),
        ]);

        WarehouseStock::where('warehouse_id', $warehouse->id)
            ->where('product_id', $this->stockOutProductId)
            ->decrement('qty', $this->stockOutQty);

        $this->reset(['stockOutProductId', 'stockOutQty']);
        $this->showStockOutModal = false;
    }

    // ---------- Subcontratos ----------
    public function saveSubcontract(): void
    {
        $this->validate([
            'subcontractProviderId' => 'required|exists:providers,id',
            'subcontractDescription' => 'required|string|max:255',
            'subcontractAmount' => 'required|numeric|min:0.01',
        ]);

        ProjectSubcontract::create([
            'project_id' => $this->project->id,
            'provider_id' => $this->subcontractProviderId,
            'category_id' => $this->subcontractCategoryId ?: null,
            'subcategory_id' => $this->subcontractSubcategoryId ?: null,
            'description' => $this->subcontractDescription,
            'start_date' => $this->subcontractStart,
            'end_date' => $this->subcontractEnd ?: null,
            'amount' => $this->subcontractAmount,
            'status' => 'generated',
        ]);

        $this->reset(['subcontractProviderId', 'subcontractCategoryId', 'subcontractSubcategoryId', 'subcontractDescription', 'subcontractAmount']);
        $this->showSubcontractModal = false;
    }

    public function authorizeSubcontract(ProjectSubcontract $subcontract): void
    {
        $subcontract->update(['status' => 'authorized', 'authorized_by' => auth()->id()]);
    }

    public function openSubcontractPay(ProjectSubcontract $subcontract): void
    {
        $this->payingSubcontractId = $subcontract->id;
        $this->subcontractPayAmount = (string) $subcontract->amount;
        $this->showSubcontractPayModal = true;
    }

    public function requestSubcontractPayment(): void
    {
        $this->validate(['subcontractPayAmount' => 'required|numeric|min:0.01']);

        $subcontract = ProjectSubcontract::findOrFail($this->payingSubcontractId);

        $payment = ProjectSubcontractPayment::create([
            'subcontract_id' => $subcontract->id,
            'amount' => $this->subcontractPayAmount,
            'pay_date' => $this->subcontractPayDate,
            'comment' => $this->subcontractPayComment,
            'status' => 'pending',
        ]);

        AccountPayable::create([
            'project_id' => $this->project->id,
            'provider_id' => $subcontract->provider_id,
            'payable_type' => 'subcontract_payment',
            'payable_id' => $payment->id,
            'reference' => 'Subcontrato #'.$subcontract->id,
            'total_amount' => $payment->amount,
            'paid_amount' => 0,
            'status' => 'pending',
        ]);

        $subcontract->update(['status' => 'in_process']);

        $this->reset(['payingSubcontractId', 'subcontractPayAmount', 'subcontractPayComment']);
        $this->showSubcontractPayModal = false;
    }

    // ---------- Rentas ----------
    public function saveRental(): void
    {
        $this->validate(['rentalMachineryId' => 'required|exists:machinery,id']);

        $machinery = \App\Models\Machinery::findOrFail($this->rentalMachineryId);

        ProjectRental::create([
            'project_id' => $this->project->id,
            'machinery_id' => $machinery->id,
            'start_date' => $this->rentalStart,
            'daily_cost' => $machinery->daily_cost,
            'total' => 0,
            'status' => 'active',
        ]);

        $this->reset(['rentalMachineryId']);
        $this->showRentalModal = false;
    }

    public function returnRental(ProjectRental $rental): void
    {
        $end = now();
        $days = max(1, $rental->start_date->diffInDays($end) + 1);

        $rental->update([
            'end_date' => $end->format('Y-m-d'),
            'total' => $days * $rental->daily_cost,
            'status' => 'returned',
        ]);
    }

    // ---------- Mano de obra ----------
    public function markAttendance($employeeId, $present = true): void
    {
        $this->project->activities(); // noop to keep static analysis calm

        \App\Models\ProjectLaborAttendance::updateOrCreate([
            'project_id' => $this->project->id,
            'employee_id' => $employeeId,
            'date' => now()->format('Y-m-d'),
        ], ['present' => $present]);
    }

    public function requestLaborPayment(): void
    {
        $this->validate([
            'laborWeekStart' => 'required|date',
            'laborWeekEnd' => 'required|date',
            'laborAmount' => 'required|numeric|min:0.01',
        ]);

        $payment = \App\Models\ProjectLaborPayment::create([
            'project_id' => $this->project->id,
            'week_start' => $this->laborWeekStart,
            'week_end' => $this->laborWeekEnd,
            'amount' => $this->laborAmount,
            'status' => 'pending',
        ]);

        AccountPayable::create([
            'project_id' => $this->project->id,
            'payable_type' => 'labor_payment',
            'payable_id' => $payment->id,
            'reference' => 'Nómina '.$this->laborWeekStart.' - '.$this->laborWeekEnd,
            'total_amount' => $payment->amount,
            'paid_amount' => 0,
            'status' => 'pending',
        ]);

        $this->reset(['laborWeekStart', 'laborWeekEnd', 'laborAmount']);
        $this->showLaborPaymentModal = false;
    }

    // ---------- Destajos ----------
    public function addPieceworkRow(): void
    {
        $this->pieceworkItems[] = ['activity_id' => '', 'qty' => ''];
    }

    public function removePieceworkRow(int $index): void
    {
        unset($this->pieceworkItems[$index]);
        $this->pieceworkItems = array_values($this->pieceworkItems);
    }

    public function openPieceworkModal(): void
    {
        $this->pieceworkItems = [['activity_id' => '', 'qty' => '']];
        $this->showPieceworkModal = true;
    }

    public function savePiecework(): void
    {
        $this->validate([
            'pieceworkItems.*.activity_id' => 'required|exists:project_activities,id',
            'pieceworkItems.*.qty' => 'required|numeric|min:0.001',
        ]);

        $request = ProjectPieceworkRequest::create([
            'project_id' => $this->project->id,
            'worker_type' => $this->pieceworkWorkerType,
            'employee_id' => $this->pieceworkWorkerType === 'employee' ? $this->pieceworkEmployeeId : null,
            'provider_id' => $this->pieceworkWorkerType === 'provider' ? $this->pieceworkProviderId : null,
            'start_date' => $this->pieceworkStart,
            'end_date' => $this->pieceworkEnd,
            'total' => 0,
            'status' => 'requested',
        ]);

        $total = 0;

        foreach ($this->pieceworkItems as $row) {
            $activity = ProjectActivity::find($row['activity_id']);
            $amount = $activity ? $activity->unit_price * $row['qty'] : 0;
            $total += $amount;

            ProjectPieceworkItem::create([
                'piecework_request_id' => $request->id,
                'activity_id' => $row['activity_id'],
                'qty' => $row['qty'],
                'amount' => $amount,
            ]);

            $activity?->increment('qty_consumed', $row['qty']);
        }

        $request->update(['total' => $total]);

        AccountPayable::create([
            'project_id' => $this->project->id,
            'payable_type' => 'piecework_request',
            'payable_id' => $request->id,
            'reference' => 'Destajo #'.$request->id,
            'total_amount' => $total,
            'paid_amount' => 0,
            'status' => 'pending',
        ]);

        $this->showPieceworkModal = false;
    }

    // ---------- Estimaciones ----------
    public function addEstimationRow(): void
    {
        $this->estimationItems[] = ['activity_id' => '', 'qty' => '', 'unit_price' => ''];
    }

    public function removeEstimationRow(int $index): void
    {
        unset($this->estimationItems[$index]);
        $this->estimationItems = array_values($this->estimationItems);
    }

    public function openEstimationModal(): void
    {
        $this->estimationItems = [['activity_id' => '', 'qty' => '', 'unit_price' => '']];
        $this->showEstimationModal = true;
    }

    public function saveEstimation(): void
    {
        $this->validate([
            'estimationItems.*.activity_id' => 'required|exists:project_activities,id',
            'estimationItems.*.qty' => 'required|numeric|min:0.001',
            'estimationItems.*.unit_price' => 'required|numeric|min:0',
        ]);

        $estimation = ProjectEstimation::create([
            'project_id' => $this->project->id,
            'start_date' => $this->estimationStart,
            'end_date' => $this->estimationEnd,
            'amortization_percent' => $this->estimationAmortization ?: 0,
            'guarantee_fund_percent' => $this->estimationGuarantee ?: 0,
            'amount' => 0,
            'status' => 'generated',
        ]);

        $total = 0;

        foreach ($this->estimationItems as $row) {
            $amount = $row['qty'] * $row['unit_price'];
            $total += $amount;

            ProjectEstimationItem::create([
                'estimation_id' => $estimation->id,
                'activity_id' => $row['activity_id'],
                'qty' => $row['qty'],
                'unit_price' => $row['unit_price'],
                'amount' => $amount,
            ]);
        }

        $estimation->update(['amount' => $total]);

        AccountReceivable::create([
            'project_id' => $this->project->id,
            'client_id' => $this->project->client_id,
            'receivable_type' => 'estimacion',
            'receivable_id' => $estimation->id,
            'reference' => 'Estimación #'.$estimation->id,
            'total_amount' => $total,
            'collected_amount' => 0,
            'status' => 'pending',
        ]);

        $this->showEstimationModal = false;
    }

    // ---------- Gastos indirectos ----------
    public function saveIndirectExpense(): void
    {
        $this->validate([
            'indirectDescription' => 'required|string|max:255',
            'indirectAmount' => 'required|numeric|min:0.01',
        ]);

        ProjectIndirectExpense::create([
            'project_id' => $this->project->id,
            'category_id' => $this->indirectCategoryId ?: null,
            'subcategory_id' => $this->indirectSubcategoryId ?: null,
            'description' => $this->indirectDescription,
            'amount' => $this->indirectAmount,
            'date' => $this->indirectDate,
            'status' => 'requested',
        ]);

        $this->reset(['indirectCategoryId', 'indirectSubcategoryId', 'indirectDescription', 'indirectAmount']);
        $this->showIndirectModal = false;
    }

    public function authorizeIndirectExpense(ProjectIndirectExpense $expense): void
    {
        $expense->update(['status' => 'authorized']);

        AccountPayable::create([
            'project_id' => $this->project->id,
            'payable_type' => 'indirect_expense',
            'payable_id' => $expense->id,
            'reference' => $expense->description,
            'total_amount' => $expense->amount,
            'paid_amount' => 0,
            'status' => 'pending',
        ]);
    }

    // ---------- Tramites ----------
    public function saveProcedure(): void
    {
        $this->validate(['procedureControlNumber' => 'required|string|max:255']);

        ProjectProcedure::create([
            'project_id' => $this->project->id,
            'control_number' => $this->procedureControlNumber,
            'manager_name' => $this->procedureManagerName,
            'dependency' => $this->procedureDependency,
            'status' => 'pending',
        ]);

        $this->reset(['procedureControlNumber', 'procedureManagerName', 'procedureDependency']);
        $this->showProcedureModal = false;
    }

    public function setProcedureStatus(ProjectProcedure $procedure, string $status): void
    {
        $procedure->update(['status' => $status]);
    }

    // ---------- Pruebas ----------
    public function saveTest(): void
    {
        $this->validate(['testName' => 'required|string|max:255']);

        $lower = $this->testLower !== '' ? (float) $this->testLower : null;
        $upper = $this->testUpper !== '' ? (float) $this->testUpper : null;
        $result = $this->testResult !== '' ? (float) $this->testResult : null;
        $approved = $result !== null && ($lower === null || $result >= $lower) && ($upper === null || $result <= $upper);

        ProjectTest::create([
            'project_id' => $this->project->id,
            'name' => $this->testName,
            'lower_param' => $lower,
            'upper_param' => $upper,
            'result_value' => $result,
            'approved' => $approved,
            'date' => $this->testDate,
        ]);

        $this->reset(['testName', 'testLower', 'testUpper', 'testResult']);
        $this->showTestModal = false;
    }

    // ---------- Bitacora ----------
    public function saveLog(): void
    {
        $this->validate(['logDescription' => 'required|string']);

        ProjectLog::create([
            'project_id' => $this->project->id,
            'date' => $this->logDate,
            'description' => $this->logDescription,
            'author_id' => auth()->id(),
        ]);

        $this->reset(['logDescription']);
        $this->showLogModal = false;
    }

    // ---------- Galeria ----------
    public function saveGalleryImage(): void
    {
        $this->validate(['galleryImage' => 'required|image|max:5120']);

        $path = $this->galleryImage->store('gallery', 'public');

        ProjectGalleryImage::create([
            'project_id' => $this->project->id,
            'path' => $path,
            'caption' => $this->galleryCaption,
            'uploaded_by' => auth()->id(),
        ]);

        $this->reset(['galleryImage', 'galleryCaption']);
        $this->showGalleryModal = false;
    }

    public function render()
    {
        $project = $this->project;

        return view('livewire.projects.show', [
            'categories' => Category::orderBy('name')->get(),
            'subcategories' => Subcategory::orderBy('name')->get(),
            'products' => Product::orderBy('name')->get(),
            'providers' => Provider::orderBy('name')->get(),
            'employees' => Employee::orderBy('name')->get(),
            'machinery' => \App\Models\Machinery::orderBy('name')->get(),

            'budgetItems' => $project->budgetItems()->with(['product', 'category', 'subcategory'])->get(),
            'activities' => $project->activities()->with(['category', 'subcategory'])->get(),
            'requisitions' => $project->requisitions()->with('items.product')->orderByDesc('id')->get(),
            'orders' => $project->purchaseOrders()->with(['provider', 'items'])->orderByDesc('id')->get(),
            'warehouse' => $project->warehouses()->where('is_general', false)->first(),
            'stocks' => WarehouseStock::whereIn('warehouse_id', $project->warehouses()->pluck('id'))->with('product')->get(),
            'movements' => InventoryMovement::whereIn('warehouse_id', $project->warehouses()->pluck('id'))->with('product')->orderByDesc('id')->take(30)->get(),
            'subcontracts' => $project->subcontracts()->with(['provider', 'payments'])->orderByDesc('id')->get(),
            'rentals' => $project->rentals()->with('machinery')->orderByDesc('id')->get(),
            'attendances' => $project->attendances ?? null,
            'laborPayments' => \App\Models\ProjectLaborPayment::where('project_id', $project->id)->orderByDesc('id')->get(),
            'pieceworkRequests' => $project->pieceworkRequests()->with(['employee', 'provider', 'items.activity'])->orderByDesc('id')->get(),
            'estimations' => $project->estimations()->with('items.activity')->orderByDesc('id')->get(),
            'indirectExpenses' => $project->indirectExpenses()->orderByDesc('id')->get(),
            'procedures' => $project->procedures()->orderByDesc('id')->get(),
            'tests' => $project->tests()->orderByDesc('id')->get(),
            'logs' => $project->logs()->with('author')->orderByDesc('id')->get(),
            'gallery' => $project->galleryImages()->orderByDesc('id')->get(),
            'payables' => $project->accountPayables()->orderByDesc('id')->get(),
            'receivables' => $project->accountReceivables()->orderByDesc('id')->get(),
        ]);
    }
}
