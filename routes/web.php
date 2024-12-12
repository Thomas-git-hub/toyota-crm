<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\VehicleReservationController;
use App\Http\Controllers\VehicleReleasesController;
use App\Http\Controllers\VehicleInventoryController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\UserManagementController;

//LOGIN
Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name("login.user");
Route::post('/logout', [LoginController::class, 'logout'])->name("logout");

//DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission:view_dashboard');

//LEADS
Route::get('/leads', [LeadController::class, 'index'])->name('leads')->middleware('permission:view_leads');
Route::post('/leads', [LeadController::class, 'store'])->name('leads.store')->middleware('permission:create_lead');
Route::get('/leads/individual/list', [LeadController::class, 'individualList'])->name('leads.individual.list')->middleware('permission:view_individual_leads');
Route::get('/leads/fleet/list', [LeadController::class, 'fleetList'])->name('leads.fleet.list')->middleware('permission:view_fleet_leads');
Route::get('/leads/company/list', [LeadController::class, 'companyList'])->name('leads.company.list')->middleware('permission:view_company_leads');
Route::get('/leads/government/list', [LeadController::class, 'governmentList'])->name('leads.government.list')->middleware('permission:view_government_leads');
Route::post('/leads/processing', [LeadController::class, 'processing'])->name('leads.processing')->middleware('permission:process_leads');
Route::delete('/leads/destroy', [LeadController::class, 'destroy'])->name('leads.destroy')->middleware('permission:delete_leads');
Route::get('/getProvince', [LeadController::class, 'getProvince'])->name('leads.getProvince');
Route::get('/getUnit', [LeadController::class, 'getUnit'])->name('leads.getUnit');
Route::get('/getInquiryType', [LeadController::class, 'getInquiryType'])->name('leads.getInquiryType');
Route::get('/leads/get-variants-and-colors', [LeadController::class, 'getVariantsAndColors']);
Route::get('/leads/get-variants', [LeadController::class, 'getVariants'])->name('leads.getVariants');
Route::get('/leads/get-colors', [LeadController::class, 'getColor'])->name('leads.getColor');
Route::get('leads/edit/{id}', [LeadController::class, 'edit'])->name('leads.edit')->middleware('permission:edit_lead');
Route::post('/leads/update/{id}', [LeadController::class, 'update'])->name('leads.update')->middleware('permission:update_lead');
Route::post('/leads/updateRemarks/', [LeadController::class, 'updateRemarks'])->name('leads.updateRemarks')->middleware('permission:update_remarks');


// APPLICATION
Route::get('/application', [ApplicationController::class, 'index'])->name('application')->middleware('permission:view_application');
Route::get('/list/pending', [ApplicationController::class, 'list_pending'])->name('application.pending')->middleware('permission:list_pending_applications');
Route::get('/list/approved', [ApplicationController::class, 'list_approved'])->name('application.approved')->middleware('permission:list_approved_applications');
Route::get('/list/cancel', [ApplicationController::class, 'list_cancel'])->name('application.cancel')->middleware('permission:list_cancelled_applications');
Route::get('/list/cash', [ApplicationController::class, 'list_cash'])->name('application.cash')->middleware('permission:list_cash_applications');
Route::post('/application/store', [ApplicationController::class, 'store'])->name('application.store')->middleware('permission:create_application');
Route::get('application/edit/{id}', [ApplicationController::class, 'edit'])->name('application.edit')->middleware('permission:edit_application');
Route::post('/application/update/{id}', [ApplicationController::class, 'update'])->name('application.update')->middleware('permission:update_application');
Route::get('/getBanks', [ApplicationController::class, 'getBanks'])->name('application.getBanks')->middleware('permission:get_banks');
Route::get('/getStatus', [ApplicationController::class, 'getStatus'])->name('application.getStatus');
Route::post('/application/processing', [ApplicationController::class, 'processing'])->name('application.processing')->middleware('permission:process_applications');
Route::post('/application/cancel', [ApplicationController::class, 'cancel'])->name('application.status.cancel')->middleware('permission:cancel_application');
Route::post('/application/store/banks', [ApplicationController::class, 'updateBanks'])->name('application.store.banks')->middleware('permission:update_banks');
Route::get('/application/banks/{id}', [ApplicationController::class, 'getApplicationBanks'])->name('application.banks.get')->middleware('permission:get_application_banks');
Route::post('/application/banks/approval/{id}', [ApplicationController::class, 'updateBankApproval'])->name('application.banks.approval')->middleware('permission:update_bank_approval');
Route::post('/application/terms', [ApplicationController::class, 'updateTerms'])->name('application.terms')->middleware('permission:update_terms');
Route::post('/application/banks/update', [ApplicationController::class, 'updateApplicationBank'])->name('application.banks.update');



// VEHICLE RESERVATION
Route::get('vehicle-reservation', [VehicleReservationController::class, 'index'])->name('vehicle.reservation')->middleware('permission:view_vehicle_reservation');
Route::get('vehicle-reservation/units/list', [VehicleReservationController::class, 'availableUnitsList'])->name('vehicle.reservation.units.list')->middleware('permission:list_available_units');
Route::get('vehicle-reservation/pending/list', [VehicleReservationController::class, 'list_pending'])->name('vehicle.reservation.pending.list')->middleware('permission:list_pending_reservations');
Route::get('vehicle-reservation/list', [VehicleReservationController::class, 'list_reserved'])->name('vehicle.reservation.list')->middleware('permission:list_reserved_vehicles');
Route::get('vehicle-reservation/getReservedCount', [VehicleReservationController::class, 'getReservedCount'])->name('vehicle.reservation.getReservedCount')->middleware('permission:get_reserved_count');
Route::get('vehicle-reservation/reservationPerTeam', [VehicleReservationController::class, 'reservationPerTeam'])->name('vehicle.reservation.reservationPerTeam')->middleware('permission:reservation_per_team');
Route::post('vehicle-reservation/processing_pending', [VehicleReservationController::class, 'processing_pending'])->name('vehicle.reservation.processing_pending')->middleware('permission:process_pending_reservation');
Route::post('vehicle-reservation/processing_reserved', [VehicleReservationController::class, 'processing_reserved'])->name('vehicle.reservation.processing_reserved')->middleware('permission:process_reserved_reservation');
Route::get('get-cs-number/{id}', [VehicleReservationController::class, 'getCSNumberByVehicleId'])->name('get-cs-number')->middleware('permission:get_cs_number');
Route::post('vehicle/reservation/addCSNumber', [VehicleReservationController::class, 'addCSNumber'])->name('vehicle.reservation.addCSNumber')->middleware('permission:add_cs_number');
Route::post('vehicle/reservation/cancel/pending', [VehicleReservationController::class, 'cancel_pending'])->name('vehicle.reservation.cancel.pending')->middleware('permission:cancel_pending_reservation');


// VEHICLE RELEASES
Route::get('vehicle-releases', [VehicleReleasesController::class, 'index'])->name('vehicle.releases')->middleware('permission:view_vehicle_releases');
Route::get('vehicle-releases/pending/list', [VehicleReleasesController::class, 'list_pending_for_release'])->name('vehicle.releases.pending.list')->middleware('permission:list_pending_releases');
Route::get('vehicle-releases/released/list', [VehicleReleasesController::class, 'list_release'])->name('vehicle.releases.list')->middleware('permission:list_released_vehicles');
Route::get('vehicle-releases/releasedUnitsList', [VehicleReleasesController::class, 'releasedUnitsList'])->name('vehicle.releases.units.list')->middleware('permission:list_released_units');
Route::get('vehicle-releases/releasedPerTeam', [VehicleReleasesController::class, 'releasedPerTeam'])->name('vehicle.releases.releasedPerTeam')->middleware('permission:released_per_team');
Route::get('vehicle-releases/getReleasedCount', [VehicleReleasesController::class, 'getReleasedCount'])->name('vehicle.releases.getReleasedCount')->middleware('permission:get_released_count');
Route::post('vehicle-releases/processing', [VehicleReleasesController::class, 'processing'])->name('vehicle.releases.processing')->middleware('permission:process_releases');
Route::post('vehicle-releases/cancel', [VehicleReleasesController::class, 'cancel_release'])->name('vehicle.releases.cancel');
Route::post('vehicle-releases/updateProfit', [VehicleReleasesController::class, 'updateProfit'])->name('vehicle.releases.updateProfit');
Route::post('vehicle-releases/updateLTORemarks', [VehicleReleasesController::class, 'updateLTORemarks'])->name('vehicle.releases.updateLTORemarks');
Route::get('vehicle-releases/getStatus', [VehicleReleasesController::class, 'getStatus'])->name('vehicle.releases.getStatus');
Route::post('vehicle-releases/updateStatus', [VehicleReleasesController::class, 'updateStatus'])->name('vehicle.releases.updateStatus');
Route::get('vehicle-releases/GrandTotalProfit', [VehicleReleasesController::class, 'GrandTotalProfit'])->name('vehicle.releases.GrandTotalProfit');
// VEHICLE INVENTORY
Route::get('vehicle-inventory', [VehicleInventoryController::class, 'index'])->name('vehicle.inventory')->middleware('permission:view_vehicle_inventory');
Route::get('vehicle-inventory/list/incoming', [VehicleInventoryController::class, 'inventoryIncomingList'])->name('vehicle.inventory.incoming.list')->middleware('permission:list_inventory');
Route::get('vehicle-inventory/list', [VehicleInventoryController::class, 'inventoryList'])->name('vehicle.inventory.list')->middleware('permission:list_inventory');
Route::get('vehicle-inventory/getTotalInventory', [VehicleInventoryController::class, 'getTotalInventory'])->name('vehicle.inventory.getTotalInventory')->middleware('permission:get_total_inventory');
Route::post('/vehicle/store', [VehicleInventoryController::class, 'store'])->name('vehicle.store')->middleware('permission:create_vehicle');
Route::post('/inventory/store', [VehicleInventoryController::class, 'inventoryStore'])->name('inventory.store')->middleware('permission:create_inventory');
Route::get('vehicle-inventory/edit', [VehicleInventoryController::class, 'editInventory'])->name('vehicle.inventory.edit');
Route::post('/inventory/update', [VehicleInventoryController::class, 'updateInventory'])->name('inventory.update');
Route::get('inventory/status', [VehicleInventoryController::class, 'getInventoryStatus'])->name('inventory.status');
Route::get('inventory/status/incomng', [VehicleInventoryController::class, 'getIncomingStatus'])->name('inventory.incoming.status');
Route::post('inventory/updateStatus', [VehicleInventoryController::class, 'updateInventoryStatus'])->name('inventory.updateStatus');
Route::get('inventory/getAgent', [VehicleInventoryController::class, 'getAgent'])->name('inventory.getAgent');
Route::post('inventory/updateTags', [VehicleInventoryController::class, 'updateTags'])->name('inventory.updateTags');
Route::get('inventory/incomingUnitsList', [VehicleInventoryController::class, 'incomingUnitsList'])->name('inventory.incomingUnitsList');
Route::get('inventory/tagsPerTeam', [VehicleInventoryController::class, 'tagsPerTeam'])->name('inventory.tagsPerTeam');

// PERMISSIONS
Route::get('permissions', [PermissionController::class, 'index'])->name('permissions');
Route::get('permissions/list', [PermissionController::class, 'list'])->name('permissions.list');
Route::post('permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
Route::post('permissions/update', [PermissionController::class, 'updatePermissions'])->name('permissions.update');
Route::get('permissions/user-types', [PermissionController::class, 'getUserTypes'])->name('permissions.user-types');
Route::get('/permissions/usertype/{usertypeId}', [PermissionController::class, 'getUserTypePermissions'])
    ->name('permissions.usertype.permissions');



// BANKS
Route::get('banks', [BankController::class, 'index'])->name('banks');
Route::post('banks/store', [BankController::class, 'store'])->name('banks.store');
Route::get('banks/edit/{id}', [BankController::class, 'edit'])->name('banks.edit');
Route::match(['post', 'put'], 'banks/update/{id}', [BankController::class, 'update'])->name('banks.update');
Route::delete('banks/destroy/{id}', [BankController::class, 'destroy'])->name('banks.destroy');
Route::get('banks/list', [BankController::class, 'list'])->name('banks.list');


// USER MANAGEMENT
Route::get('user-management', [UserManagementController::class, 'index'])->name('user.management');
Route::get('user-management/list', [UserManagementController::class, 'list'])->name('user.management.list');
Route::get('user-management/usertypes/list', [UserManagementController::class, 'getUserTypes'])->name('usertypes.list');
Route::get('user-management/teams/list', [UserManagementController::class, 'getTeams'])->name('teams.list');
Route::post('user-management/store', [UserManagementController::class, 'store'])->name('user.management.store');
Route::post('user-management/update', [UserManagementController::class, 'update'])->name('user.management.update');
Route::delete('user-management/{id}/destroy', [UserManagementController::class, 'destroy'])->name('user.management.destroy');
Route::get('user-management/{id}/edit', [UserManagementController::class, 'edit'])->name('user.management.edit');
Route::get('user-management/{id}/send-temporary-password', [UserManagementController::class, 'sendTemporaryPassword'])->name('user.management.sendTemporaryPassword');
