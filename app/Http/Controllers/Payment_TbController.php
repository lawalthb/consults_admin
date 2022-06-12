<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment_TbAddRequest;
use App\Http\Requests\Payment_TbEditRequest;
use App\Models\Payment_Tb;
use Illuminate\Http\Request;
use Exception;
class Payment_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.payment_tb.list";
		$query = Payment_Tb::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Payment_Tb::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "payment_tb.payment_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Payment_Tb::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Payment_Tb::query();
		$record = $query->findOrFail($rec_id, Payment_Tb::viewFields());
		$this->afterView($rec_id, $record);
		return $this->renderView("pages.payment_tb.view", ["data" => $record]);
	}
    /**
     * After view page record
     * @param string $rec_id // record id to be selected
     * @param object $record // selected page record
     */
    private function afterView($rec_id, $record){
        //enter statement here
    }
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.payment_tb.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Payment_TbAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Payment_Tb record
		$record = Payment_Tb::create($modeldata);
		$rec_id = $record->payment_id;
		return $this->redirect("payment_tb", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Payment_TbEditRequest $request, $rec_id = null){
		$query = Payment_Tb::query();
		$record = $query->findOrFail($rec_id, Payment_Tb::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("payment_tb", "Record updated successfully");
		}
		return $this->renderView("pages.payment_tb.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Payment_Tb::query();
		$query->whereIn("payment_id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
