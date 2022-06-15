<?php 
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components data Model
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Model
 */
class ComponentsData{
	

	/**
     * Check if value already exist in Admins_Tb table
	 * @param string $value
     * @return bool
     */
	function admins_tb_email_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('admins_tb')->where('email', $value)->value('email');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * Check if value already exist in Departments_Tb table
	 * @param string $value
     * @return bool
     */
	function departments_tb_name_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('departments_tb')->where('name', $value)->value('name');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * permission_id_option_list Model Action
     * @return array
     */
	function permission_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM permissions";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * role_id_option_list Model Action
     * @return array
     */
	function role_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM roles";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * Check if value already exist in Order_Tb table
	 * @param string $value
     * @return bool
     */
	function order_tb_order_no_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('order_tb')->where('order_no', $value)->value('order_no');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * user_id_option_list Model Action
     * @return array
     */
	function user_id_option_list(){
		$sqltext = "SELECT  DISTINCT user_id AS value,email AS label FROM users_tb ORDER BY email ASC" ;
		$query_params = [];
		$query_params['search'] = "%$search%";
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * vendor_id_option_list Model Action
     * @return array
     */
	function vendor_id_option_list(){
		$sqltext = "SELECT  DISTINCT vendor_id AS value,name AS label FROM vendors_tb ORDER BY name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * product_id_option_list Model Action
     * @return array
     */
	function product_id_option_list(){
		$sqltext = "SELECT  DISTINCT product_id AS value,product_name AS label FROM products_tb ORDER BY product_name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * payment_tb_vendor_id_option_list Model Action
     * @return array
     */
	function payment_tb_vendor_id_option_list(){
		$sqltext = "SELECT vendor_id as value, vendor_id as label FROM vendors_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * product_departments_product_id_option_list Model Action
     * @return array
     */
	function product_departments_product_id_option_list(){
		$sqltext = "SELECT product_id as value, product_name as label FROM products_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * department_id_option_list Model Action
     * @return array
     */
	function department_id_option_list(){
		$sqltext = "SELECT  DISTINCT department_id AS value,name AS label FROM departments_tb ORDER BY name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * level_option_list Model Action
     * @return array
     */
	function level_option_list(){
		$sqltext = "SELECT  DISTINCT level_name AS value,level_name AS label FROM level ORDER BY level_name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * vendor_email_option_list Model Action
     * @return array
     */
	function vendor_email_option_list($value = null){
		$lookup_value = request()->lookup ?? $value;
		$sqltext = "SELECT  DISTINCT vendor_id AS value,email AS label FROM vendors_tb WHERE email=:lookup_vendor_id" ;
		$query_params = [];
		$query_params['lookup_vendor_id'] = $lookup_value;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * Check if value already exist in Roles table
	 * @param string $value
     * @return bool
     */
	function roles_name_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('roles')->where('name', $value)->value('name');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * order_no_option_list Model Action
     * @return array
     */
	function order_no_option_list(){
		$sqltext = "SELECT order_no as value, order_no as label FROM order_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * sales_tb_product_id_option_list Model Action
     * @return array
     */
	function sales_tb_product_id_option_list(){
		$sqltext = "SELECT product_id as value, product_id as label FROM products_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * sales_tb_user_id_option_list Model Action
     * @return array
     */
	function sales_tb_user_id_option_list(){
		$sqltext = "SELECT user_id as value, user_id as label FROM users_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * checkout_by_option_list Model Action
     * @return array
     */
	function checkout_by_option_list(){
		$sqltext = "SELECT admin_id as value, admin_id as label FROM admins_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * sales_tb_vendor_id_option_list Model Action
     * @return array
     */
	function sales_tb_vendor_id_option_list(){
		$sqltext = "SELECT vendor_id as value, title as label FROM vendors_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * user_id_option_list_2 Model Action
     * @return array
     */
	function user_id_option_list_2(){
		$sqltext = "SELECT user_id as value, firstname as label FROM users_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * department_option_list Model Action
     * @return array
     */
	function department_option_list(){
		$sqltext = "SELECT department_id as value, name as label FROM departments_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * Check if value already exist in Vendors_Tb table
	 * @param string $value
     * @return bool
     */
	function vendors_tb_email_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('vendors_tb')->where('email', $value)->value('email');   
		if($exist){
			return true;
		}
		return false;
	}
}
