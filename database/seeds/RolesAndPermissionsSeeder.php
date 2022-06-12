<?php
use App\Models\Admins_Tb;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder
{
	private $permissionsByRole = [
			
		'director' => [
			'home/list', 'admins_tb/list', 'admins_tb/view', 'admins_tb/add', 'admins_tb/store', 'admins_tb/edit', 'admins_tb/delete', 'admins_tb/importdata', 'departments_tb/list', 'departments_tb/view', 'departments_tb/add', 'departments_tb/store', 'departments_tb/edit', 'departments_tb/delete', 'departments_tb/importdata', 'level/list', 'level/view', 'level/add', 'level/store', 'level/edit', 'level/delete', 'level/importdata', 'order_tb/list', 'order_tb/view', 'order_tb/add', 'order_tb/store', 'order_tb/edit', 'order_tb/delete', 'order_tb/importdata', 'payment_tb/list', 'payment_tb/view', 'payment_tb/add', 'payment_tb/store', 'payment_tb/edit', 'payment_tb/delete', 'payment_tb/importdata', 'products_tb/list', 'products_tb/view', 'products_tb/add', 'products_tb/store', 'products_tb/edit', 'products_tb/delete', 'products_tb/importdata', 'sales_tb/list', 'sales_tb/view', 'sales_tb/add', 'sales_tb/store', 'sales_tb/edit', 'sales_tb/delete', 'sales_tb/importdata', 'stock_tb/list', 'stock_tb/view', 'stock_tb/add', 'stock_tb/store', 'stock_tb/edit', 'stock_tb/delete', 'stock_tb/importdata', 'user_orders_view/list', 'user_orders_view/view', 'users_tb/list', 'users_tb/view', 'users_tb/add', 'users_tb/store', 'users_tb/edit', 'users_tb/delete', 'users_tb/importdata', 'vendors_tb/list', 'vendors_tb/view', 'vendors_tb/add', 'vendors_tb/store', 'vendors_tb/edit', 'vendors_tb/delete', 'vendors_tb/importdata', 'account/list', 'account/edit', 'permissions/list', 'permissions/view', 'permissions/add', 'permissions/store', 'permissions/edit', 'permissions/delete', 'roles/list', 'roles/view', 'roles/add', 'roles/store', 'roles/edit', 'roles/delete', 'model_has_roles/list', 'model_has_roles/view', 'model_has_roles/add', 'model_has_roles/store', 'model_has_roles/edit', 'model_has_roles/delete', 'model_has_permissions/list', 'model_has_permissions/view', 'model_has_permissions/add', 'model_has_permissions/store', 'model_has_permissions/edit', 'model_has_permissions/delete', 'role_has_permissions/list', 'role_has_permissions/view', 'role_has_permissions/add', 'role_has_permissions/store', 'role_has_permissions/edit', 'role_has_permissions/delete', 'order_tb/checkout', 'sales_tb/checkout_order', 'sales_tb/checkout_order_store', 'order_tb/rejc', 'sales_tb/advlist', 'sales_tb/refund', 'product_departments/list', 'product_departments/view', 'product_departments/add', 'product_departments/store', 'product_departments/edit', 'product_departments/delete', 'products_tb/for_stock', 'stock_tb/vendor_stock', 'stock_tb/get_total_in', 'stock_tb/vendor_qty'
		], 
		'sales_rep' => [
			'home/list', 'admins_tb/list', 'admins_tb/view', 'admins_tb/add', 'admins_tb/store', 'admins_tb/edit', 'admins_tb/delete', 'admins_tb/importdata', 'departments_tb/list', 'departments_tb/view', 'departments_tb/add', 'departments_tb/store', 'departments_tb/edit', 'departments_tb/delete', 'departments_tb/importdata', 'level/list', 'level/view', 'level/add', 'level/store', 'level/edit', 'level/delete', 'level/importdata', 'order_tb/list', 'order_tb/view', 'order_tb/add', 'order_tb/store', 'order_tb/edit', 'order_tb/delete', 'order_tb/importdata', 'payment_tb/list', 'payment_tb/view', 'payment_tb/add', 'payment_tb/store', 'payment_tb/edit', 'payment_tb/delete', 'payment_tb/importdata', 'products_tb/list', 'products_tb/view', 'products_tb/add', 'products_tb/store', 'products_tb/edit', 'products_tb/delete', 'products_tb/importdata', 'sales_tb/list', 'sales_tb/view', 'sales_tb/add', 'sales_tb/store', 'sales_tb/edit', 'sales_tb/delete', 'sales_tb/importdata', 'stock_tb/list', 'stock_tb/view', 'stock_tb/add', 'stock_tb/store', 'stock_tb/edit', 'stock_tb/delete', 'stock_tb/importdata', 'user_orders_view/list', 'user_orders_view/view', 'users_tb/list', 'users_tb/view', 'users_tb/add', 'users_tb/store', 'users_tb/edit', 'users_tb/delete', 'users_tb/importdata', 'vendors_tb/list', 'vendors_tb/view', 'vendors_tb/add', 'vendors_tb/store', 'vendors_tb/edit', 'vendors_tb/delete', 'vendors_tb/importdata', 'account/list', 'account/edit', 'permissions/list', 'permissions/view', 'permissions/add', 'permissions/store', 'permissions/edit', 'permissions/delete', 'roles/list', 'roles/view', 'roles/add', 'roles/store', 'roles/edit', 'roles/delete', 'model_has_roles/list', 'model_has_roles/view', 'model_has_roles/add', 'model_has_roles/store', 'model_has_roles/edit', 'model_has_roles/delete', 'model_has_permissions/list', 'model_has_permissions/view', 'model_has_permissions/add', 'model_has_permissions/store', 'model_has_permissions/edit', 'model_has_permissions/delete', 'role_has_permissions/list', 'role_has_permissions/view', 'role_has_permissions/add', 'role_has_permissions/store', 'role_has_permissions/edit', 'role_has_permissions/delete', 'order_tb/checkout', 'sales_tb/checkout_order', 'sales_tb/checkout_order_store', 'order_tb/rejc', 'sales_tb/advlist', 'sales_tb/refund', 'product_departments/list', 'product_departments/view', 'product_departments/add', 'product_departments/store', 'product_departments/edit', 'product_departments/delete', 'products_tb/for_stock', 'stock_tb/vendor_stock', 'stock_tb/get_total_in', 'stock_tb/vendor_qty'
		]
	];
    public function run()
    {
        $tableNames = config('permission.table_names');

		Schema::disableForeignKeyConstraints();
		
		DB::table($tableNames['role_has_permissions'])->truncate();
		DB::table($tableNames['permissions'])->truncate();
        DB::table($tableNames['roles'])->truncate();
        
		Schema::enableForeignKeyConstraints();
		
		app()['cache']->forget('spatie.permission.cache');
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

		$this->syncPermissions();
		$this->syncRoles();
		$this->syncUsersRole('director');
    }
	function syncRoles(){
		foreach ($this->permissionsByRole as $rolename => $permissions) {
			$role = Role::create(['name' => $rolename]);
			$role->givePermissionTo($permissions);
		}
	}

	function syncPermissions(){
		$permissions = [];

		foreach ($this->permissionsByRole as $rolename => $rolePermissions) {
			$permissions = array_merge($permissions, $rolePermissions);
		}

		$insertData = [];
		foreach($permissions as $name){
			$insertData[] = ['name'=>$name, 'guard_name' => 'web'];
		}
		Permission::insert($insertData);
	}

	function syncUsersRole($role){
		$users = Admins_Tb::all();
		foreach($users as $user){
			$user->syncRoles($role);
		}
	}
}
