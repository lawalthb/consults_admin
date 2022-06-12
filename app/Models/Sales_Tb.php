<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Sales_Tb extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'sales_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'sales_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'order_no','product_id','vendor_id','user_id','rate','qty','total_amount','payment_optn','date','sales_status','remark','checkout_by'
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
				sales_tb.order_no LIKE ?  OR 
				products_tb.product_name LIKE ?  OR 
				vendors_tb.name LIKE ?  OR 
				users_tb.firstname LIKE ?  OR 
				users_tb.lastname LIKE ?  OR 
				users_tb.matric_no LIKE ?  OR 
				sales_tb.payment_optn LIKE ?  OR 
				sales_tb.remark LIKE ?  OR 
				products_tb.unit LIKE ?  OR 
				products_tb.description LIKE ?  OR 
				products_tb.level LIKE ?  OR 
				products_tb.available_for LIKE ?  OR 
				products_tb.vendor_email LIKE ?  OR 
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
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"sales_tb.sales_id AS sales_id",
			"sales_tb.order_no AS order_no",
			"order_tb.order_no AS order_tb_order_no",
			"products_tb.product_name AS products_tb_product_name",
			"sales_tb.qty AS qty",
			"sales_tb.rate AS rate",
			"vendors_tb.name AS vendors_tb_name",
			"sales_tb.total_amount AS total_amount",
			"users_tb.firstname AS users_tb_firstname",
			"users_tb.lastname AS users_tb_lastname",
			"users_tb.matric_no AS users_tb_matric_no",
			"sales_tb.date AS date",
			"sales_tb.sales_status AS sales_status",
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
			"sales_tb.sales_id AS sales_id",
			"sales_tb.order_no AS order_no",
			"order_tb.order_no AS order_tb_order_no",
			"products_tb.product_name AS products_tb_product_name",
			"sales_tb.qty AS qty",
			"sales_tb.rate AS rate",
			"vendors_tb.name AS vendors_tb_name",
			"sales_tb.total_amount AS total_amount",
			"users_tb.firstname AS users_tb_firstname",
			"users_tb.lastname AS users_tb_lastname",
			"users_tb.matric_no AS users_tb_matric_no",
			"sales_tb.date AS date",
			"sales_tb.sales_status AS sales_status",
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
			"sales_tb.sales_id AS sales_id",
			"sales_tb.order_no AS order_no",
			"sales_tb.product_id AS product_id",
			"sales_tb.vendor_id AS vendor_id",
			"sales_tb.user_id AS user_id",
			"sales_tb.rate AS rate",
			"sales_tb.qty AS qty",
			"sales_tb.total_amount AS total_amount",
			"sales_tb.payment_optn AS payment_optn",
			"sales_tb.date AS date",
			"sales_tb.dare_reg AS dare_reg",
			"sales_tb.sales_status AS sales_status",
			"sales_tb.remark AS remark",
			"sales_tb.checkout_by AS checkout_by",
			"products_tb.product_id AS products_tb_product_id",
			"products_tb.product_name AS products_tb_product_name",
			"products_tb.unit AS products_tb_unit",
			"products_tb.description AS products_tb_description",
			"products_tb.image AS products_tb_image",
			"products_tb.vendor_id AS products_tb_vendor_id",
			"products_tb.department_id AS products_tb_department_id",
			"products_tb.level AS products_tb_level",
			"products_tb.sell_rate AS products_tb_sell_rate",
			"products_tb.purchase_rate AS products_tb_purchase_rate",
			"products_tb.status AS products_tb_status",
			"products_tb.reg_date AS products_tb_reg_date",
			"products_tb.available_for AS products_tb_available_for",
			"products_tb.admin_id AS products_tb_admin_id",
			"products_tb.vendor_email AS products_tb_vendor_email",
			"products_tb.qty AS products_tb_qty",
			"users_tb.user_id AS users_tb_user_id",
			"users_tb.matric_no AS users_tb_matric_no",
			"users_tb.firstname AS users_tb_firstname",
			"users_tb.lastname AS users_tb_lastname",
			"users_tb.email AS users_tb_email",
			"users_tb.phone AS users_tb_phone",
			"users_tb.department AS users_tb_department",
			"users_tb.level AS users_tb_level",
			"users_tb.status AS users_tb_status",
			"users_tb.email_link AS users_tb_email_link",
			"users_tb.email_comfirm AS users_tb_email_comfirm",
			"users_tb.email_token AS users_tb_email_token",
			"users_tb.reg_date AS users_tb_reg_date",
			"users_tb.gender AS users_tb_gender",
			"users_tb.deleted AS users_tb_deleted",
			"users_tb.photo AS users_tb_photo",
			"users_tb.email_verified_at AS users_tb_email_verified_at",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"vendors_tb.title AS vendors_tb_title",
			"vendors_tb.name AS vendors_tb_name",
			"vendors_tb.email AS vendors_tb_email",
			"vendors_tb.department_id AS vendors_tb_department_id",
			"vendors_tb.status AS vendors_tb_status",
			"vendors_tb.reg_date AS vendors_tb_reg_date" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"sales_tb.sales_id AS sales_id",
			"sales_tb.order_no AS order_no",
			"sales_tb.product_id AS product_id",
			"sales_tb.vendor_id AS vendor_id",
			"sales_tb.user_id AS user_id",
			"sales_tb.rate AS rate",
			"sales_tb.qty AS qty",
			"sales_tb.total_amount AS total_amount",
			"sales_tb.payment_optn AS payment_optn",
			"sales_tb.date AS date",
			"sales_tb.dare_reg AS dare_reg",
			"sales_tb.sales_status AS sales_status",
			"sales_tb.remark AS remark",
			"sales_tb.checkout_by AS checkout_by",
			"products_tb.product_id AS products_tb_product_id",
			"products_tb.product_name AS products_tb_product_name",
			"products_tb.unit AS products_tb_unit",
			"products_tb.description AS products_tb_description",
			"products_tb.image AS products_tb_image",
			"products_tb.vendor_id AS products_tb_vendor_id",
			"products_tb.department_id AS products_tb_department_id",
			"products_tb.level AS products_tb_level",
			"products_tb.sell_rate AS products_tb_sell_rate",
			"products_tb.purchase_rate AS products_tb_purchase_rate",
			"products_tb.status AS products_tb_status",
			"products_tb.reg_date AS products_tb_reg_date",
			"products_tb.available_for AS products_tb_available_for",
			"products_tb.admin_id AS products_tb_admin_id",
			"products_tb.vendor_email AS products_tb_vendor_email",
			"products_tb.qty AS products_tb_qty",
			"users_tb.user_id AS users_tb_user_id",
			"users_tb.matric_no AS users_tb_matric_no",
			"users_tb.firstname AS users_tb_firstname",
			"users_tb.lastname AS users_tb_lastname",
			"users_tb.email AS users_tb_email",
			"users_tb.phone AS users_tb_phone",
			"users_tb.department AS users_tb_department",
			"users_tb.level AS users_tb_level",
			"users_tb.status AS users_tb_status",
			"users_tb.email_link AS users_tb_email_link",
			"users_tb.email_comfirm AS users_tb_email_comfirm",
			"users_tb.email_token AS users_tb_email_token",
			"users_tb.reg_date AS users_tb_reg_date",
			"users_tb.gender AS users_tb_gender",
			"users_tb.deleted AS users_tb_deleted",
			"users_tb.photo AS users_tb_photo",
			"users_tb.email_verified_at AS users_tb_email_verified_at",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"vendors_tb.title AS vendors_tb_title",
			"vendors_tb.name AS vendors_tb_name",
			"vendors_tb.email AS vendors_tb_email",
			"vendors_tb.department_id AS vendors_tb_department_id",
			"vendors_tb.status AS vendors_tb_status",
			"vendors_tb.reg_date AS vendors_tb_reg_date" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"sales_id",
			"order_no",
			"product_id",
			"vendor_id",
			"user_id",
			"rate",
			"qty",
			"total_amount",
			"payment_optn",
			"date",
			"sales_status",
			"remark",
			"checkout_by" 
		];
	}
	

	/**
     * return advlist page fields of the model.
     * 
     * @return array
     */
	public static function advlistFields(){
		return [ 
			"sales_tb.sales_id AS sales_id",
			"sales_tb.order_no AS order_no",
			"order_tb.order_no AS order_tb_order_no",
			"products_tb.product_name AS products_tb_product_name",
			"sales_tb.qty AS qty",
			"sales_tb.rate AS rate",
			"sales_tb.total_amount AS total_amount",
			"vendors_tb.name AS vendors_tb_name",
			"users_tb.firstname AS users_tb_firstname",
			"users_tb.lastname AS users_tb_lastname",
			"users_tb.matric_no AS users_tb_matric_no",
			"sales_tb.date AS date",
			"sales_tb.sales_status AS sales_status",
			"products_tb.product_id AS products_tb_product_id",
			"users_tb.user_id AS users_tb_user_id",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id" 
		];
	}
	

	/**
     * return exportAdvlist page fields of the model.
     * 
     * @return array
     */
	public static function exportAdvlistFields(){
		return [ 
			"sales_tb.sales_id AS sales_id",
			"sales_tb.order_no AS order_no",
			"order_tb.order_no AS order_tb_order_no",
			"products_tb.product_name AS products_tb_product_name",
			"sales_tb.qty AS qty",
			"sales_tb.rate AS rate",
			"sales_tb.total_amount AS total_amount",
			"vendors_tb.name AS vendors_tb_name",
			"users_tb.firstname AS users_tb_firstname",
			"users_tb.lastname AS users_tb_lastname",
			"users_tb.matric_no AS users_tb_matric_no",
			"sales_tb.date AS date",
			"sales_tb.sales_status AS sales_status",
			"products_tb.product_id AS products_tb_product_id",
			"users_tb.user_id AS users_tb_user_id",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id" 
		];
	}
}
