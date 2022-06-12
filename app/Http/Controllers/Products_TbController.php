<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products_TbAddRequest;
use App\Http\Requests\Products_TbEditRequest;
use App\Models\Products_Tb;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsTbForStockExport;
use Illuminate\Support\Facades\DB;
use Exception;
class Products_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.products_tb.list";
		$query = Products_Tb::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Products_Tb::search($query, $search); // search table records
		}
		$query->join("vendors_tb", "products_tb.vendor_id", "=", "vendors_tb.vendor_id");
		$query->join("departments_tb", "products_tb.department_id", "=", "departments_tb.department_id");
		$orderby = $request->orderby ?? "products_tb.product_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Products_Tb::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Products_Tb::query();
		$query->join("vendors_tb", "products_tb.vendor_id", "=", "vendors_tb.vendor_id");
		$query->join("departments_tb", "products_tb.department_id", "=", "departments_tb.department_id");
		$record = $query->findOrFail($rec_id, Products_Tb::viewFields());
		return $this->renderView("pages.products_tb.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.products_tb.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Products_TbAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//Validate Product_Departments form data
		$productDepartmentsPostData = $request->product_departments;
		$productDepartmentsValidator = validator()->make($productDepartmentsPostData, ["*.product_id" => "nullable",
				"*.department_id" => "required"]);
		if ($productDepartmentsValidator->fails()) {
			return $productDepartmentsValidator->errors();
		}
		$productDepartmentsValidData = $productDepartmentsValidator->valid();
		$productDepartmentsModeldata = array_values($productDepartmentsValidData);
		$modeldata['admin_id'] = auth()->user()->admin_id;
		
		//save Products_Tb record
		$record = Products_Tb::create($modeldata);
		$rec_id = $record->product_id;
		
		// set product_departments.product_id to products_tb $rec_id
		foreach ($productDepartmentsModeldata as &$data) {
			$data['product_id'] = $rec_id;
		}
		
		//Save Product_Departments record
		\App\Models\Product_Departments::insert($productDepartmentsModeldata);
		return $this->redirect("products_tb", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Products_TbEditRequest $request, $rec_id = null){
		$query = Products_Tb::query();
		$record = $query->findOrFail($rec_id, Products_Tb::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("products_tb", "Record updated successfully");
		}
		return $this->renderView("pages.products_tb.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Products_Tb::query();
		$query->whereIn("product_id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function for_stock(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.products_tb.for_stock";
		$query = Products_Tb::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Products_Tb::search($query, $search); // search table records
		}
		$query->join("vendors_tb", "products_tb.vendor_id", "=", "vendors_tb.vendor_id");
		if($request->orderby){
			$orderby = $request->orderby;
			$ordertype = ($request->ordertype ? $request->ordertype : "desc");
			$query->orderBy($orderby, $ordertype);
		}
		else{
			$query->orderBy("products_tb.product_name", "ASC");
		}
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->products_tb_vendor_id){
			$val = $request->products_tb_vendor_id;
			$query->where(DB::raw("products_tb.vendor_id"), "=", $val);
		}
		if($request->products_tb_qty){
			$vals = explode("-", str_replace(" ", "", $request->products_tb_qty));
			$from = $vals[0] ?? null;
			$to = $vals[1] ?? null;
			if(is_numeric($from) && is_numeric($to)){
				$query->whereRaw("products_tb.qty BETWEEN ? AND ?", [$from, $to]);
			}
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportForStock($query); // export current query
		}
		$records = $query->paginate($limit, Products_Tb::forStockFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportForStock($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "ForStockProducts_TbReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Products_Tb::exportForStockFields());
			return view("reports.products_tb-for_stock", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Products_Tb::exportForStockFields());
			$pdf = PDF::loadView("reports.products_tb-for_stock", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new ProductsTbForStockExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new ProductsTbForStockExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
