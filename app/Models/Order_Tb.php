<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Order_Tb extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'order_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'order_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'order_no','user_id','vendor_id','product_id','mat_no','rate','qty','total_amount','payment_optn','date'
	];
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				order_tb.order_no LIKE ?  OR 
				products_tb.product_name LIKE ?  OR 
				vendors_tb.name LIKE ?  OR 
				users_tb.firstname LIKE ?  OR 
				users_tb.lastname LIKE ?  OR 
				order_tb.mat_no LIKE ?  OR 
				order_tb.payment_optn LIKE ?  OR 
				order_tb.remark LIKE ?  OR 
				products_tb.unit LIKE ?  OR 
				products_tb.description LIKE ?  OR 
				products_tb.level LIKE ?  OR 
				products_tb.available_for LIKE ?  OR 
				products_tb.vendor_email LIKE ?  OR 
				users_tb.matric_no LIKE ?  OR 
				users_tb.email LIKE ?  OR 
				users_tb.phone LIKE ?  OR 
				users_tb.level LIKE ?  OR 
				users_tb.password LIKE ?  OR 
				users_tb.email_link LIKE ?  OR 
				users_tb.email_token LIKE ?  OR 
				users_tb.gender LIKE ?  OR 
				vendors_tb.title LIKE ?  OR 
				vendors_tb.email LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"order_tb.order_id AS order_id",
			"order_tb.order_no AS order_no",
			"products_tb.product_name AS products_tb_product_name",
			"order_tb.rate AS rate",
			"order_tb.qty AS qty",
			"order_tb.total_amount AS total_amount",
			"vendors_tb.name AS vendors_tb_name",
			"users_tb.firstname AS users_tb_firstname",
			"users_tb.lastname AS users_tb_lastname",
			"order_tb.mat_no AS mat_no",
			"order_tb.date AS date",
			"order_tb.order_status AS order_status",
			"order_tb.sales_status AS sales_status",
			"products_tb.product_id AS products_tb_product_id",
			"users_tb.user_id AS users_tb_user_id",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"order_tb.order_id AS order_id",
			"order_tb.order_no AS order_no",
			"products_tb.product_name AS products_tb_product_name",
			"order_tb.rate AS rate",
			"order_tb.qty AS qty",
			"order_tb.total_amount AS total_amount",
			"vendors_tb.name AS vendors_tb_name",
			"users_tb.firstname AS users_tb_firstname",
			"users_tb.lastname AS users_tb_lastname",
			"order_tb.mat_no AS mat_no",
			"order_tb.date AS date",
			"order_tb.order_status AS order_status",
			"order_tb.sales_status AS sales_status",
			"products_tb.product_id AS products_tb_product_id",
			"users_tb.user_id AS users_tb_user_id",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"order_tb.order_id AS order_id",
			"order_tb.order_no AS order_no",
			"users_tb.matric_no AS users_tb_matric_no",
			"users_tb.firstname AS users_tb_firstname",
			"users_tb.lastname AS users_tb_lastname",
			"users_tb.email AS users_tb_email",
			"users_tb.level AS users_tb_level",
			"users_tb.department AS users_tb_department",
			"order_tb.rate AS rate",
			"order_tb.qty AS qty",
			"order_tb.total_amount AS total_amount",
			"order_tb.product_id AS product_id",
			"order_tb.vendor_id AS vendor_id",
			"order_tb.user_id AS user_id",
			"order_tb.mat_no AS mat_no",
			"order_tb.date AS date",
			"products_tb.product_id AS products_tb_product_id",
			"products_tb.vendor_id AS products_tb_vendor_id",
			"products_tb.department_id AS products_tb_department_id",
			"users_tb.user_id AS users_tb_user_id",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"vendors_tb.department_id AS vendors_tb_department_id",
			DB::raw("order_tb.total_amount AS tmt") 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"order_tb.order_id AS order_id",
			"order_tb.order_no AS order_no",
			"users_tb.matric_no AS users_tb_matric_no",
			"users_tb.firstname AS users_tb_firstname",
			"users_tb.lastname AS users_tb_lastname",
			"users_tb.email AS users_tb_email",
			"users_tb.level AS users_tb_level",
			"users_tb.department AS users_tb_department",
			"order_tb.rate AS rate",
			"order_tb.qty AS qty",
			"order_tb.total_amount AS total_amount",
			"order_tb.product_id AS product_id",
			"order_tb.vendor_id AS vendor_id",
			"order_tb.user_id AS user_id",
			"order_tb.mat_no AS mat_no",
			"order_tb.date AS date",
			"products_tb.product_id AS products_tb_product_id",
			"products_tb.vendor_id AS products_tb_vendor_id",
			"products_tb.department_id AS products_tb_department_id",
			"users_tb.user_id AS users_tb_user_id",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"vendors_tb.department_id AS vendors_tb_department_id",
			DB::raw("order_tb.total_amount AS tmt") 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"order_id",
			"order_no",
			"user_id",
			"vendor_id",
			"product_id",
			"mat_no",
			"rate",
			"qty",
			"total_amount",
			"payment_optn",
			"date" 
		];
	}
	

	/**
     * return checkout page fields of the model.
     * 
     * @return array
     */
	public static function checkoutFields(){
		return [ 
			"order_id",
			"order_no",
			"product_id",
			"vendor_id",
			"user_id",
			"mat_no",
			"rate",
			"qty",
			"total_amount",
			"payment_optn",
			"date",
			"dare_reg",
			"order_status",
			"sales_status" 
		];
	}
	

	/**
     * return exportCheckout page fields of the model.
     * 
     * @return array
     */
	public static function exportCheckoutFields(){
		return [ 
			"order_id",
			"order_no",
			"product_id",
			"vendor_id",
			"user_id",
			"mat_no",
			"rate",
			"qty",
			"total_amount",
			"payment_optn",
			"date",
			"dare_reg",
			"order_status",
			"sales_status" 
		];
	}
}
