<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users_TbAddRequest;
use App\Http\Requests\Users_TbEditRequest;
use App\Models\Users_Tb;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersTbListExport;
use Illuminate\Support\Facades\DB;
use Exception;
class Users_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.users_tb.list";
		$query = Users_Tb::query();
		$limit = $request->limit ?? 20;
		$this->beforeList($fieldname, $fieldvalue);
		if($request->search){
			$search = trim($request->search);
			Users_Tb::search($query, $search); // search table records
		}
		$query->join("departments_tb", "users_tb.department", "=", "departments_tb.department_id");
		$orderby = $request->orderby ?? "users_tb.user_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->users_tb_department){
			$val = $request->users_tb_department;
			$query->where(DB::raw("users_tb.department"), "=", $val);
		}
		if($request->users_tb_level){
			$val = $request->users_tb_level;
			$query->where(DB::raw("users_tb.level"), "=", $val);
		}
		if($request->users_tb_gender){
			$val = $request->users_tb_gender;
			$query->where(DB::raw("users_tb.gender"), "=", $val);
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $query->paginate($limit, Users_Tb::listFields());
		return $this->renderView($view, compact("records"));
	}
    /**
     * Before page list record
     * @param string $fieldname //filter records by table field
     * @param string $fieldvalue //filter value
     */
    private function beforeList($fieldname, $fieldvalue){
        //enter statement here
    }
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Users_Tb::query();
		$record = $query->findOrFail($rec_id, Users_Tb::viewFields());
		return $this->renderView("pages.users_tb.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.users_tb.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Users_TbAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['password'] = bcrypt($modeldata['password']);
		
		//save Users_Tb record
		$record = Users_Tb::create($modeldata);
		$rec_id = $record->user_id;
		return $this->redirect("users_tb", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Users_TbEditRequest $request, $rec_id = null){
		$query = Users_Tb::query();
		$record = $query->findOrFail($rec_id, Users_Tb::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$modeldata['password'] = bcrypt($modeldata['password']);
			$record->update($modeldata);
			return $this->redirect("users_tb", "Record updated successfully");
		}
		return $this->renderView("pages.users_tb.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Users_Tb::query();
		$query->whereIn("user_id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportList($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "ListUsers_TbReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Users_Tb::exportListFields());
			return view("reports.users_tb-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Users_Tb::exportListFields());
			$pdf = PDF::loadView("reports.users_tb-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new UsersTbListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new UsersTbListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
