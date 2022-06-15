<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins_TbAccountEditRequest;
use App\Http\Requests\Admins_TbAddRequest;
use App\Http\Requests\Admins_TbEditRequest;
use App\Models\Admins_Tb;
use Illuminate\Http\Request;
use Exception;
class Admins_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.admins_tb.list";
		$query = Admins_Tb::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Admins_Tb::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "admins_tb.firstname";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("admin_id","<>" , "13");
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Admins_Tb::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Admins_Tb::query();
		$record = $query->findOrFail($rec_id, Admins_Tb::viewFields());
		return $this->renderView("pages.admins_tb.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.admins_tb.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Admins_TbAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['password'] = bcrypt($modeldata['password']);
		
		//save Admins_Tb record
		$record = Admins_Tb::create($modeldata);
		$record->assignRole("director"); //set default role for user
		$rec_id = $record->firstname;
		return $this->redirect("admins_tb", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Admins_TbEditRequest $request, $rec_id = null){
		$query = Admins_Tb::query();
		$record = $query->findOrFail($rec_id, Admins_Tb::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$modeldata['password'] = bcrypt($modeldata['password']);
			$record->update($modeldata);
			return $this->redirect("admins_tb", "Record updated successfully");
		}
		return $this->renderView("pages.admins_tb.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Admins_Tb::query();
		$query->whereIn("firstname", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
