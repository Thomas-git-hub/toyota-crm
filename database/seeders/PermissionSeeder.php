<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $permissions = [
        ['permission_name' => 'view_dashboard', 'permission_description' => 'Allows the user to view the dashboard.'],
        ['permission_name' => 'view_leads', 'permission_description' => 'Allows the user to view leads.'],
        ['permission_name' => 'create_lead', 'permission_description' => 'Allows the user to create a new lead.'],
        // ['permission_name' => 'view_individual_leads', 'permission_description' => 'Allows the user to view individual leads.'],
        // ['permission_name' => 'view_fleet_leads', 'permission_description' => 'Allows the user to view fleet leads.'],
        // ['permission_name' => 'view_company_leads', 'permission_description' => 'Allows the user to view company leads.'],
        // ['permission_name' => 'view_government_leads', 'permission_description' => 'Allows the user to view government leads.'],
        ['permission_name' => 'process_leads', 'permission_description' => 'Allows the user to process leads.'],
        ['permission_name' => 'delete_leads', 'permission_description' => 'Allows the user to delete leads.'],
        ['permission_name' => 'edit_lead', 'permission_description' => 'Allows the user to edit a lead.'],
        ['permission_name' => 'update_lead', 'permission_description' => 'Allows the user to update lead information.'],
        ['permission_name' => 'update_remarks', 'permission_description' => 'Allows the user to update remarks on leads.'],
        
        ['permission_name' => 'view_application', 'permission_description' => 'Allows the user to view applications.'],
        ['permission_name' => 'list_pending_applications', 'permission_description' => 'Allows the user to list pending applications.'],
        ['permission_name' => 'list_approved_applications', 'permission_description' => 'Allows the user to list approved applications.'],
        ['permission_name' => 'list_cancelled_applications', 'permission_description' => 'Allows the user to list cancelled applications.'],
        ['permission_name' => 'list_cash_applications', 'permission_description' => 'Allows the user to list cash applications.'],
        ['permission_name' => 'store_application', 'permission_description' => 'Allows the user to store a new application.'],
        ['permission_name' => 'edit_application', 'permission_description' => 'Allows the user to edit an application.'],
        ['permission_name' => 'update_application', 'permission_description' => 'Allows the user to update application information.'],
        ['permission_name' => 'get_banks', 'permission_description' => 'Allows the user to retrieve bank information.'],
        ['permission_name' => 'process_application', 'permission_description' => 'Allows the user to process applications.'],
        ['permission_name' => 'cancel_application', 'permission_description' => 'Allows the user to cancel an application.'],
        ['permission_name' => 'store_banks', 'permission_description' => 'Allows the user to store bank information.'],
        // ['permission_name' => 'get_application_banks', 'permission_description' => 'Allows the user to retrieve application banks.'],
        ['permission_name' => 'update_bank_approval', 'permission_description' => 'Allows the user to update bank approval status.'],
        ['permission_name' => 'update_terms', 'permission_description' => 'Allows the user to update terms and percentage.'],

        ['permission_name' => 'view_vehicle_reservation', 'permission_description' => 'Allows the user to view vehicle reservations.'],
        ['permission_name' => 'list_available_units', 'permission_description' => 'Allows the user to list available vehicle units.'],
        ['permission_name' => 'list_pending_reservations', 'permission_description' => 'Allows the user to list pending vehicle reservations.'],
        ['permission_name' => 'list_reserved_vehicles', 'permission_description' => 'Allows the user to list reserved vehicles.'],
        ['permission_name' => 'get_reserved_count', 'permission_description' => 'Allows the user to get the count of reserved vehicles.'],
        ['permission_name' => 'reservation_per_team', 'permission_description' => 'Allows the user to view reservations per team.'],
        ['permission_name' => 'process_pending_reservation', 'permission_description' => 'Allows the user to process pending reservations.'],
        ['permission_name' => 'process_reserved_reservation', 'permission_description' => 'Allows the user to process reserved reservations.'],
        ['permission_name' => 'get_cs_number', 'permission_description' => 'Allows the user to retrieve CS numbers for vehicles.'],
        ['permission_name' => 'add_cs_number', 'permission_description' => 'Allows the user to add a CS number to a vehicle reservation.'],
        ['permission_name' => 'cancel_pending_reservation', 'permission_description' => 'Allows the user to cancel a pending vehicle reservation.'],

        ['permission_name' => 'view_vehicle_releases', 'permission_description' => 'Allows the user to view vehicle releases.'],
        ['permission_name' => 'list_pending_releases', 'permission_description' => 'Allows the user to list pending vehicle releases.'],
        ['permission_name' => 'list_released_vehicles', 'permission_description' => 'Allows the user to list released vehicles.'],
        ['permission_name' => 'released_units_list', 'permission_description' => 'Allows the user to view a list of released units.'],
        ['permission_name' => 'released_per_team', 'permission_description' => 'Allows the user to view released vehicles per team.'],
        ['permission_name' => 'get_released_count', 'permission_description' => 'Allows the user to get the count of released vehicles.'],
        ['permission_name' => 'process_vehicle_release', 'permission_description' => 'Allows the user to process vehicle releases.'],
        ['permission_name' => 'cancel_vehicle_release', 'permission_description' => 'Allows the user to cancel a vehicle release.'],

        ['permission_name' => 'view_vehicle_inventory', 'permission_description' => 'Allows the user to view vehicle inventory.'],
        ['permission_name' => 'list_inventory', 'permission_description' => 'Allows the user to list vehicle inventory.'],
        ['permission_name' => 'get_total_inventory', 'permission_description' => 'Allows the user to get the total vehicle inventory.'],
        ['permission_name' => 'store_vehicle', 'permission_description' => 'Allows the user to store a new vehicle.'],
        ['permission_name' => 'store_inventory', 'permission_description' => 'Allows the user to store inventory information.'],

        // Bank Management Permissions
        ['permission_name' => 'view_banks', 'permission_description' => 'Allows the user to view bank information.'],
        ['permission_name' => 'create_bank', 'permission_description' => 'Allows the user to create new bank entries.'],
        ['permission_name' => 'edit_bank', 'permission_description' => 'Allows the user to edit bank information.'],
        ['permission_name' => 'delete_bank', 'permission_description' => 'Allows the user to delete bank entries.'],
        
        // User Management Permissions
        ['permission_name' => 'view_users', 'permission_description' => 'Allows the user to view user information.'],
        ['permission_name' => 'create_user', 'permission_description' => 'Allows the user to create new users.'],
        ['permission_name' => 'edit_user', 'permission_description' => 'Allows the user to edit user information.'],
        ['permission_name' => 'delete_user', 'permission_description' => 'Allows the user to delete users.'],
        ['permission_name' => 'manage_user_roles', 'permission_description' => 'Allows the user to assign and modify user roles.'],
        ['permission_name' => 'manage_user_permissions', 'permission_description' => 'Allows the user to assign and modify user permissions.'],
        ['permission_name' => 'manage_passwords', 'permission_description' => 'Allows the user to changes password for the users.'],

        
    ];

    foreach ($permissions as $permission) {
        DB::table('permissions')->insert($permission);
    }
    }
}
