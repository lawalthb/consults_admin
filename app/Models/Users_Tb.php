<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Users_Tb extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'users_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'user_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'matric_no','firstname','lastname','email','phone','department','level','password','status','gender','photo'
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
				users_tb.firstname LIKE ?  OR 
				users_tb.lastname LIKE ?  OR 
				users_tb.email LIKE ?  OR 
				users_tb.matric_no LIKE ?  OR 
				users_tb.phone LIKE ?  OR 
				users_tb.gender LIKE ?  OR 
				users_tb.level LIKE ?  OR 
				users_tb.password LIKE ?  OR 
				users_tb.email_link LIKE ?  OR 
				users_tb.email_token LIKE ? 
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
			"users_tb.user_id AS user_id",
			"users_tb.firstname AS firstname",
			"users_tb.lastname AS lastname",
			"users_tb.email AS email",
			"users_tb.matric_no AS matric_no",
			"users_tb.phone AS phone",
			"users_tb.gender AS gender",
			"users_tb.department AS department",
			"departments_tb.name AS departments_tb_name",
			"users_tb.level AS level",
			"users_tb.status AS status",
			"users_tb.reg_date AS reg_date" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"users_tb.user_id AS user_id",
			"users_tb.firstname AS firstname",
			"users_tb.lastname AS lastname",
			"users_tb.email AS email",
			"users_tb.matric_no AS matric_no",
			"users_tb.phone AS phone",
			"users_tb.gender AS gender",
			"users_tb.department AS department",
			"departments_tb.name AS departments_tb_name",
			"users_tb.level AS level",
			"users_tb.status AS status",
			"users_tb.reg_date AS reg_date" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"user_id",
			"matric_no",
			"firstname",
			"lastname",
			"email",
			"phone",
			"department",
			"level",
			"status",
			"email_link",
			"email_comfirm",
			"email_token",
			"reg_date",
			"gender",
			"deleted",
			"photo",
			"email_verified_at" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"user_id",
			"matric_no",
			"firstname",
			"lastname",
			"email",
			"phone",
			"department",
			"level",
			"status",
			"email_link",
			"email_comfirm",
			"email_token",
			"reg_date",
			"gender",
			"deleted",
			"photo",
			"email_verified_at" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"user_id",
			"matric_no",
			"firstname",
			"lastname",
			"email",
			"phone",
			"department",
			"level",
			"password",
			"status",
			"gender",
			"photo" 
		];
	}
}
