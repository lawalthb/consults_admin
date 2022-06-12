<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User_Orders_View;
use Illuminate\Http\Request;
use Exception;
class User_Orders_ViewController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.user_orders_view.list";
		$query = User_Orders_View::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			User_Orders_View::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "user_orders_view.order_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, User_Orders_View::listFields());
		return $this->renderView($view, compact("records"));
	}
}
