<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Stock_Tb extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'stock_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'stock_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'date','user_id','mat_no','item_id','vendor_id','user_type','item_in','item_out','item_balance','payment_id','status'
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
				products_tb.product_name LIKE ?  OR 
				vendors_tb.name LIKE ?  OR 
				stock_tb.mat_no LIKE ?  OR 
				vendors_tb.title LIKE ?  OR 
				vendors_tb.email LIKE ?  OR 
				products_tb.unit LIKE ?  OR 
				products_tb.description LIKE ?  OR 
				products_tb.level LIKE ?  OR 
				products_tb.available_for LIKE ?  OR 
				products_tb.vendor_email LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"stock_tb.reg_date AS reg_date",
			"products_tb.product_name AS products_tb_product_name",
			"vendors_tb.name AS vendors_tb_name",
			"stock_tb.stock_id AS stock_id",
			"stock_tb.item_in AS item_in",
			"stock_tb.item_out AS item_out",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"products_tb.product_id AS products_tb_product_id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"stock_tb.reg_date AS reg_date",
			"products_tb.product_name AS products_tb_product_name",
			"vendors_tb.name AS vendors_tb_name",
			"stock_tb.stock_id AS stock_id",
			"stock_tb.item_in AS item_in",
			"stock_tb.item_out AS item_out",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"products_tb.product_id AS products_tb_product_id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"stock_tb.stock_id AS stock_id",
			"stock_tb.date AS date",
			"stock_tb.user_id AS user_id",
			"stock_tb.mat_no AS mat_no",
			"stock_tb.item_id AS item_id",
			"stock_tb.vendor_id AS vendor_id",
			"stock_tb.user_type AS user_type",
			"stock_tb.item_in AS item_in",
			"stock_tb.item_out AS item_out",
			"stock_tb.item_balance AS item_balance",
			"stock_tb.payment_id AS payment_id",
			"stock_tb.reg_date AS reg_date",
			"stock_tb.status AS status",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"vendors_tb.title AS vendors_tb_title",
			"vendors_tb.name AS vendors_tb_name",
			"vendors_tb.email AS vendors_tb_email",
			"vendors_tb.department_id AS vendors_tb_department_id",
			"vendors_tb.status AS vendors_tb_status",
			"vendors_tb.reg_date AS vendors_tb_reg_date",
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
			"products_tb.qty AS products_tb_qty" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"stock_tb.stock_id AS stock_id",
			"stock_tb.date AS date",
			"stock_tb.user_id AS user_id",
			"stock_tb.mat_no AS mat_no",
			"stock_tb.item_id AS item_id",
			"stock_tb.vendor_id AS vendor_id",
			"stock_tb.user_type AS user_type",
			"stock_tb.item_in AS item_in",
			"stock_tb.item_out AS item_out",
			"stock_tb.item_balance AS item_balance",
			"stock_tb.payment_id AS payment_id",
			"stock_tb.reg_date AS reg_date",
			"stock_tb.status AS status",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"vendors_tb.title AS vendors_tb_title",
			"vendors_tb.name AS vendors_tb_name",
			"vendors_tb.email AS vendors_tb_email",
			"vendors_tb.department_id AS vendors_tb_department_id",
			"vendors_tb.status AS vendors_tb_status",
			"vendors_tb.reg_date AS vendors_tb_reg_date",
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
			"products_tb.qty AS products_tb_qty" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"stock_id",
			"date",
			"user_id",
			"mat_no",
			"item_id",
			"vendor_id",
			"user_type",
			"item_in",
			"item_out",
			"item_balance",
			"payment_id",
			"status" 
		];
	}
	

	/**
     * return vendorStock page fields of the model.
     * 
     * @return array
     */
	public static function vendorStockFields(){
		return [ 
			"products_tb.product_name AS products_tb_product_name",
			"vendors_tb.name AS vendors_tb_name",
			"stock_tb.stock_id AS stock_id",
			"stock_tb.item_in AS item_in",
			"stock_tb.item_out AS item_out",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"products_tb.product_id AS products_tb_product_id" 
		];
	}
	

	/**
     * return exportVendorStock page fields of the model.
     * 
     * @return array
     */
	public static function exportVendorStockFields(){
		return [ 
			"products_tb.product_name AS products_tb_product_name",
			"vendors_tb.name AS vendors_tb_name",
			"stock_tb.stock_id AS stock_id",
			"stock_tb.item_in AS item_in",
			"stock_tb.item_out AS item_out",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"products_tb.product_id AS products_tb_product_id" 
		];
	}
	

	/**
     * return vendorQty page fields of the model.
     * 
     * @return array
     */
	public static function vendorQtyFields(){
		return [ 
			"stock_id",
			"date",
			"user_id",
			"mat_no",
			"item_id",
			"vendor_id",
			"user_type",
			"item_in",
			"item_out",
			"item_balance",
			"payment_id",
			"reg_date",
			"status" 
		];
	}
	

	/**
     * return exportVendorQty page fields of the model.
     * 
     * @return array
     */
	public static function exportVendorQtyFields(){
		return [ 
			"stock_id",
			"date",
			"user_id",
			"mat_no",
			"item_id",
			"vendor_id",
			"user_type",
			"item_in",
			"item_out",
			"item_balance",
			"payment_id",
			"reg_date",
			"status" 
		];
	}
}
