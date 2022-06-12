<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Products_Tb extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'products_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'product_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'product_name','vendor_id','sell_rate','purchase_rate','level','department_id','vendor_email','description','status','admin_id'
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
				vendors_tb.name LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%"
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
			"products_tb.product_id AS product_id",
			"products_tb.product_name AS product_name",
			"vendors_tb.name AS vendors_tb_name",
			"products_tb.sell_rate AS sell_rate",
			"products_tb.purchase_rate AS purchase_rate",
			"departments_tb.name AS departments_tb_name",
			"products_tb.level AS level",
			"products_tb.status AS status",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"departments_tb.department_id AS departments_tb_department_id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"products_tb.product_id AS product_id",
			"products_tb.product_name AS product_name",
			"vendors_tb.name AS vendors_tb_name",
			"products_tb.sell_rate AS sell_rate",
			"products_tb.purchase_rate AS purchase_rate",
			"departments_tb.name AS departments_tb_name",
			"products_tb.level AS level",
			"products_tb.status AS status",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"departments_tb.department_id AS departments_tb_department_id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"products_tb.product_id AS product_id",
			"products_tb.product_name AS product_name",
			"products_tb.description AS description",
			"products_tb.vendor_id AS vendor_id",
			"products_tb.department_id AS department_id",
			"products_tb.level AS level",
			"products_tb.status AS status",
			"products_tb.qty AS qty",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"vendors_tb.name AS vendors_tb_name",
			"vendors_tb.department_id AS vendors_tb_department_id",
			"departments_tb.department_id AS departments_tb_department_id",
			"departments_tb.name AS departments_tb_name" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"products_tb.product_id AS product_id",
			"products_tb.product_name AS product_name",
			"products_tb.description AS description",
			"products_tb.vendor_id AS vendor_id",
			"products_tb.department_id AS department_id",
			"products_tb.level AS level",
			"products_tb.status AS status",
			"products_tb.qty AS qty",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"vendors_tb.name AS vendors_tb_name",
			"vendors_tb.department_id AS vendors_tb_department_id",
			"departments_tb.department_id AS departments_tb_department_id",
			"departments_tb.name AS departments_tb_name" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"product_id",
			"product_name",
			"vendor_id",
			"sell_rate",
			"purchase_rate",
			"level",
			"department_id",
			"vendor_email",
			"description",
			"status",
			"admin_id" 
		];
	}
	

	/**
     * return forStock page fields of the model.
     * 
     * @return array
     */
	public static function forStockFields(){
		return [ 
			"products_tb.product_id AS product_id",
			"products_tb.product_name AS product_name",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"vendors_tb.name AS vendors_tb_name",
			"products_tb.qty AS qty" 
		];
	}
	

	/**
     * return exportForStock page fields of the model.
     * 
     * @return array
     */
	public static function exportForStockFields(){
		return [ 
			"products_tb.product_id AS product_id",
			"products_tb.product_name AS product_name",
			"vendors_tb.vendor_id AS vendors_tb_vendor_id",
			"vendors_tb.name AS vendors_tb_name",
			"products_tb.qty AS qty" 
		];
	}
}
