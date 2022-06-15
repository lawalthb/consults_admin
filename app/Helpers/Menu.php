
<?php
	class Menu{
		
	public static function navbarsideleft(){
		return [
		[
			'path' => 'home',
			'label' => "Dashboard", 
			'icon' => '<i class="material-icons ">network_check</i>'
		],
		
		[
			'path' => 'order_tb',
			'label' => "Customer Orders", 
			'icon' => '<i class="material-icons ">add_shopping_cart</i>'
		],
		
		[
			'path' => 'sales_tb',
			'label' => "Sales", 
			'icon' => '<i class="material-icons ">local_grocery_store</i>'
		],
		
		[
			'path' => 'products_tb',
			'label' => "Products Tb", 
			'icon' => '<i class="material-icons ">grid_on</i>'
		],
		
		[
			'path' => 'products_tb/for_stock',
			'label' => "Stock Level", 
			'icon' => '<i class="material-icons ">line_weight</i>'
		],
		
		[
			'path' => 'departments_tb',
			'label' => "Departments Tb", 
			'icon' => '<i class="material-icons ">school</i>'
		],
		
		[
			'path' => 'level',
			'label' => "Level", 
			'icon' => '<i class="material-icons ">show_chart</i>'
		],
		
		[
			'path' => 'users_tb',
			'label' => "Customers", 
			'icon' => '<i class="material-icons ">group_add</i>'
		],
		
		[
			'path' => 'admins_tb',
			'label' => "Sales Reps", 
			'icon' => '<i class="material-icons ">person</i>'
		],
		
		[
			'path' => 'vendors_tb',
			'label' => "Vendors", 
			'icon' => '<i class="material-icons ">person_pin</i>'
		],
		
		[
			'path' => 'stock_tb/vendor_stock',
			'label' => "Vendor Stock", 
			'icon' => '<i class="material-icons ">graphic_eq</i>'
		],
		
		[
			'path' => 'payment_tb',
			'label' => "Payment Tb", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'roles',
			'label' => "Admin Type/Roles", 
			'icon' => '<i class="material-icons ">security</i>'
		],
		
		[
			'path' => 'role_has_permissions',
			'label' => "Grant Admin  Permissions", 
			'icon' => '<i class="material-icons ">accessibility</i>'
		],
		
		[
			'path' => 'product_departments',
			'label' => "Items & Departments", 
			'icon' => '<i class="material-icons ">wrap_text</i>'
		]
	] ;
	}
	
		
	public static function status(){
		return [
		[
			'value' => '1', 
			'label' => "Active", 
		],
		[
			'value' => '0', 
			'label' => "Deactive", 
		],] ;
	}
	
	public static function gender(){
		return [
		[
			'value' => 'Male', 
			'label' => "Male", 
		],
		[
			'value' => 'Female', 
			'label' => "Female", 
		],] ;
	}
	
	public static function users_tb_gender(){
		return [
		[
			'value' => 'male', 
			'label' => "Male", 
		],
		[
			'value' => 'female', 
			'label' => "Female", 
		],] ;
	}
	
	}
