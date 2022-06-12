<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sales_TbAddRequest;
use App\Http\Requests\Sales_TbEditRequest;
use App\Http\Requests\Sales_Tbcheckout_orderRequest;
use App\Models\Sales_Tb;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesTbAdvlistExport;
use Illuminate\Support\Facades\DB;
use Exception;
class Sales_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.sales_tb.list";
		$query = Sales_Tb::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Sales_Tb::search($query, $search); // search table records
		}
		$query->join("order_tb", "sales_tb.order_no", "=", "order_tb.order_no");
		$query->join("products_tb", "sales_tb.product_id", "=", "products_tb.product_id");
		$query->join("users_tb", "sales_tb.user_id", "=", "users_tb.user_id");
		$query->join("vendors_tb", "sales_tb.vendor_id", "=", "vendors_tb.vendor_id");
		$orderby = $request->orderby ?? "sales_tb.sales_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Sales_Tb::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Sales_Tb::query();
		$query->join("products_tb", "sales_tb.product_id", "=", "products_tb.product_id");
		$query->join("users_tb", "sales_tb.user_id", "=", "users_tb.user_id");
		$query->join("vendors_tb", "sales_tb.vendor_id", "=", "vendors_tb.vendor_id");
		$record = $query->findOrFail($rec_id, Sales_Tb::viewFields());
		return $this->renderView("pages.sales_tb.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.sales_tb.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Sales_TbAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//Validate Order_Tb form data
		$orderTbPostData = $request->order_tb;
		$orderTbValidator = validator()->make($orderTbPostData, ["order_no" => "required|numeric|max:50|min:1|unique:order_tb,order_no",
				"user_id" => "required",
				"vendor_id" => "required",
				"product_id" => "required",
				"mat_no" => "nullable|string",
				"rate" => "required|numeric",
				"qty" => "required|numeric|max:50|min:1",
				"total_amount" => "required|numeric",
				"payment_optn" => "nullable|string",
				"date" => "required|date"]);
		if ($orderTbValidator->fails()) {
			return $orderTbValidator->errors();
		}
		$orderTbModeldata = $this->normalizeFormData($orderTbValidator->valid());
		
		//save Sales_Tb record
		$record = Sales_Tb::create($modeldata);
		$rec_id = $record->sales_id;
		
        // set order_tb.order_no to sales_tb.order_id
		$orderTbModeldata['order_no'] = $rec_id;
		//save Order_Tb record
		$orderTbRecord = \App\Models\Order_Tb::create($orderTbModeldata);
		return $this->redirect("sales_tb", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Sales_TbEditRequest $request, $rec_id = null){
		$query = Sales_Tb::query();
		$record = $query->findOrFail($rec_id, Sales_Tb::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$this->beforeEdit($rec_id, $modeldata);
			$record->update($modeldata);
			return $this->redirect("sales_tb", "Record updated successfully");
		}
		return $this->renderView("pages.sales_tb.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
    /**
     * Before update page record
     * @param string $rec_id // record id to be updated
     * @param array $modeldata // validated form data used to update record
     */
    private function beforeEdit($rec_id, $modeldata){
        //enter statement here
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
		$query = Sales_Tb::query();
		$query->whereIn("sales_id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function checkout_order(){
		return $this->renderView("pages.sales_tb.checkout_order");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function checkout_order_store(Sales_Tbcheckout_orderRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['checkout_by'] = auth()->user()->admin_id;
		
		//save Sales_Tb record
		$record = Sales_Tb::create($modeldata);
		$rec_id = $record->sales_id;
		return $this->redirect("sales_tb", "Record added successfully");
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function advlist(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.sales_tb.advlist";
		$query = Sales_Tb::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Sales_Tb::search($query, $search); // search table records
		}
		$query->join("order_tb", "sales_tb.order_no", "=", "order_tb.order_no");
		$query->join("products_tb", "sales_tb.product_id", "=", "products_tb.product_id");
		$query->join("users_tb", "sales_tb.user_id", "=", "users_tb.user_id");
		$query->join("vendors_tb", "sales_tb.vendor_id", "=", "vendors_tb.vendor_id");
		if($request->orderby){
			$orderby = $request->orderby;
			$ordertype = ($request->ordertype ? $request->ordertype : "desc");
			$query->orderBy($orderby, $ordertype);
		}
		else{
			$query->orderBy("sales_tb.sales_id", "DESC");
		}
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->sales_tb_date){
			$vals = explode("-to-",$request->sales_tb_date);
			$fromDate = $vals[0] ?? null;
			$toDate = $vals[1] ?? null;
			if($fromDate && $toDate){
				$query->whereRaw("sales_tb.date BETWEEN ? AND ?", [$fromDate, $toDate]);
			}
			elseif($fromDate){
				$query->whereRaw("sales_tb.date >= ?", [$fromDate]);
			}
			elseif($toDate){
				$query->whereRaw("sales_tb.date <= ?", [$toDate]);
			}
		}
		if($request->sales_tb_vendor_id){
			$val = $request->sales_tb_vendor_id;
			$query->where(DB::raw("sales_tb.vendor_id"), "=", $val);
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportAdvlist($query); // export current query
		}
		$records = $query->paginate($limit, Sales_Tb::advlistFields());
		return $this->renderView($view, compact("records"));
	}
    /**
     * Endpoint action
     * @return \Illuminate\Http\Response
     */
     public function refund(Request $request, $rec_id){
        DB::table('order_tb')->where('order_no', $rec_id)->update(
        ['order_status' => 1 ,
        'sales_status' => 2
        ]);
        DB::table('sales_tb')->where('order_no', '=', $rec_id)->delete();
        return redirect('sales_tb');
    }
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportAdvlist($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "AdvlistSales_TbReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Sales_Tb::exportAdvlistFields());
			return view("reports.sales_tb-advlist", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Sales_Tb::exportAdvlistFields());
			$pdf = PDF::loadView("reports.sales_tb-advlist", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new SalesTbAdvlistExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new SalesTbAdvlistExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
