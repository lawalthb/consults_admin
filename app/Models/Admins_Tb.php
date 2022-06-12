<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class Admins_Tb extends Authenticatable 
{
	use Notifiable;
	use HasRoles;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'admins_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'admin_id';
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ['firstname','username','lastname','email','password','admin_type','status','deleted','photo'];
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"admin_id",
			"firstname",
			"lastname",
			"email",
			"username",
			"admin_type",
			"status",
			"reg_date" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"admin_id",
			"firstname",
			"lastname",
			"email",
			"username",
			"admin_type",
			"status",
			"reg_date" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"admin_id",
			"firstname",
			"lastname",
			"email",
			"username",
			"admin_type",
			"status",
			"reg_date" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"admin_id",
			"firstname",
			"lastname",
			"email",
			"username",
			"admin_type",
			"status",
			"reg_date" 
		];
	}
	

	/**
     * return accountedit page fields of the model.
     * 
     * @return array
     */
	public static function accounteditFields(){
		return [ 
			"admin_id",
			"firstname",
			"lastname",
			"username",
			"admin_type",
			"status",
			"deleted" 
		];
	}
	

	/**
     * return accountview page fields of the model.
     * 
     * @return array
     */
	public static function accountviewFields(){
		return [ 
			"admin_id",
			"firstname",
			"lastname",
			"email",
			"username",
			"admin_type",
			"status",
			"reg_date",
			"deleted" 
		];
	}
	

	/**
     * return exportAccountview page fields of the model.
     * 
     * @return array
     */
	public static function exportAccountviewFields(){
		return [ 
			"admin_id",
			"firstname",
			"lastname",
			"email",
			"username",
			"admin_type",
			"status",
			"reg_date",
			"deleted" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"admin_id",
			"firstname",
			"lastname",
			"email",
			"password",
			"username",
			"admin_type",
			"status",
			"deleted",
			"photo" 
		];
	}
	

	/**
     * Get current user name
     * @return string
     */
	public function UserName(){
		return $this->firstname;
	}
	

	/**
     * Get current user id
     * @return string
     */
	public function UserId(){
		return $this->firstname;
	}
	public function UserEmail(){
		return $this->email;
	}
	public function UserPhoto(){
		return $this->photo;
	}
	public function UserRole(){
		return $this->user_role_id;
	}
	

	/**
     * Send Password reset link to user email 
	 * @param string $token
     * @return string
     */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new \App\Notifications\ResetPassword($token));
	}
	public function canView($path)
	{
		$arrPaths = explode("/", strtolower($path));
		$page = $arrPaths[0] ?? "home";
		$action = $arrPaths[1] ?? "list";
		if($action == "index"){
			$action = "list";
		}
		return $this->can("$page/$action");
	}
}
