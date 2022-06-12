<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Product_Departments extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'product_departments';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'product_department_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'product_id','department_id'
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
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"product_departments.product_department_id AS product_department_id",
			"product_departments.product_id AS product_id",
			"products_tb.product_name AS products_tb_product_name",
			"product_departments.department_id AS department_id",
			"departments_tb.name AS departments_tb_name" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"product_departments.product_department_id AS product_department_id",
			"product_departments.product_id AS product_id",
			"products_tb.product_name AS products_tb_product_name",
			"product_departments.department_id AS department_id",
			"departments_tb.name AS departments_tb_name" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"product_department_id",
			"product_id",
			"department_id" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"product_department_id",
			"product_id",
			"department_id" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"product_department_id",
			"product_id",
			"department_id" 
		];
	}
}
