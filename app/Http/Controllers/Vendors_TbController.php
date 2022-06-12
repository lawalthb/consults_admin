<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendors_TbAddRequest;
use App\Http\Requests\Vendors_TbEditRequest;
use App\Models\Vendors_Tb;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VendorsTbListExport;
use Exception;
class Vendors_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.vendors_tb.list";
		$query = Vendors_Tb::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Vendors_Tb::search($query, $search); // search table records
		}
		$query->join("departments_tb", "vendors_tb.department_id", "=", "departments_tb.department_id");
		$orderby = $request->orderby ?? "vendors_tb.vendor_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $query->paginate($limit, Vendors_Tb::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Vendors_Tb::query();
		$query->join("departments_tb", "vendors_tb.department_id", "=", "departments_tb.department_id");
		$record = $query->findOrFail($rec_id, Vendors_Tb::viewFields());
		return $this->renderView("pages.vendors_tb.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.vendors_tb.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Vendors_TbAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Vendors_Tb record
		$record = Vendors_Tb::create($modeldata);
		$rec_id = $record->vendor_id;
		return $this->redirect("vendors_tb", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Vendors_TbEditRequest $request, $rec_id = null){
		$query = Vendors_Tb::query();
		$record = $query->findOrFail($rec_id, Vendors_Tb::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("vendors_tb", "Record updated successfully");
		}
		return $this->renderView("pages.vendors_tb.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Vendors_Tb::query();
		$query->whereIn("vendor_id", $arr_id);
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
		$filename = "ListVendors_TbReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Vendors_Tb::exportListFields());
			return view("reports.vendors_tb-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Vendors_Tb::exportListFields());
			$pdf = PDF::loadView("reports.vendors_tb-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new VendorsTbListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new VendorsTbListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
