<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order_TbAddRequest;
use App\Http\Requests\Order_TbEditRequest;
use App\Models\Order_Tb;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderTbListExport;
use App\Exports\OrderTbViewExport;
use Illuminate\Support\Facades\DB;
use Exception;
class Order_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.order_tb.list";
		$query = Order_Tb::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Order_Tb::search($query, $search); // search table records
		}
		$query->join("products_tb", "order_tb.product_id", "=", "products_tb.product_id");
		$query->join("users_tb", "order_tb.user_id", "=", "users_tb.user_id");
		$query->join("vendors_tb", "order_tb.vendor_id", "=", "vendors_tb.vendor_id");
		$orderby = $request->orderby ?? "order_tb.order_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("order_status" , "1");
$query->where("sales_status" , "1");
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $query->paginate($limit, Order_Tb::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Order_Tb::query();
		$query->join("products_tb", "order_tb.product_id", "=", "products_tb.product_id");
		$query->join("users_tb", "order_tb.user_id", "=", "users_tb.user_id");
		$query->join("vendors_tb", "order_tb.vendor_id", "=", "vendors_tb.vendor_id");
		// if request format is for export example:- product/view/344?export=pdf
		if($this->getExportFormat()){
			return $this->ExportView($query, $rec_id);
		}
		$record = $query->findOrFail($rec_id, Order_Tb::viewFields());
		$this->afterView($rec_id, $record);
		return $this->renderView("pages.order_tb.view", ["data" => $record]);
	}
    /**
     * After view page record
     * @param string $rec_id // record id to be selected
     * @param object $record // selected page record
     */
    private function afterView($rec_id, $record){
        //enter statement here
        $modeldata = [
        'order_no' => $record['order_no'],
        'product_id' => $record['product_id'],
        'vendor_id' => $record['vendor_id'],
        'user_id' => $record['user_id'],
        'rate' => $record['rate'],
        'qty' => $record['qty'],
        'total_amount' => $record['total_amount'],
        'payment_optn' => 'cash',
        'date' => date("Y-m-d"),
        'sales_status' => '1',
          'remark' => 'thanks',
          'checkout_by' => auth()->user()->admin_id
        ];
        DB::table('sales_tb')->insert($modeldata);
        DB::table('order_tb')->where('order_id', $rec_id)->update([
        'order_status' => 2,
        'sales_status' => 2
        ]);
        return redirect('order_tb');
    }
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.order_tb.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Order_TbAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Order_Tb record
		$record = Order_Tb::create($modeldata);
		$rec_id = $record->order_id;
		return $this->redirect("order_tb", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Order_TbEditRequest $request, $rec_id = null){
		$query = Order_Tb::query();
		$record = $query->findOrFail($rec_id, Order_Tb::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$this->beforeEdit($rec_id, $modeldata);
			$record->update($modeldata);
			$this->afterEdit($rec_id, $record);
			return $this->redirect("order_tb", "Record updated successfully");
		}
		return $this->renderView("pages.order_tb.edit", ["data" => $record, "rec_id" => $rec_id]);
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
     * After page record updated
     * @param string $rec_id // updated record id
     * @param array $record // updated page record
     */
    private function afterEdit($rec_id, $record){
         DB::table('order_tb')->where('order_id', $rec_id)->update([
        'order_status' => 3,
        'sales_status' => 3
        ]);
        return redirect('order_tb');
        die();
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
		$query = Order_Tb::query();
		$query->whereIn("order_id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function checkout($rec_id = null){
		$query = Order_Tb::query();
		$record = $query->findOrFail($rec_id, Order_Tb::checkoutFields());
		return $this->renderView("pages.order_tb.checkout", ["data" => $record]);
	}
    /**
     * Endpoint action
     * @return \Illuminate\Http\Response
     */
     public function rejc(Request $request, $rec_id){
        DB::table('order_tb')->where('order_id', $rec_id)->update(
        ['order_status' => 3 ,
            'sales_status' => 3
        ]);
        return redirect('order_tb');
    }
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportList($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "ListOrder_TbReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Order_Tb::exportListFields());
			return view("reports.order_tb-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Order_Tb::exportListFields());
			$pdf = PDF::loadView("reports.order_tb-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new OrderTbListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new OrderTbListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
	

	/**
     * Export single record to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $record
	 * @param string $rec_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportView($query, $rec_id){
		ob_end_clean();// clean any output to allow file download
		$filename ="ViewOrder_TbReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$record = $query->findOrFail($rec_id, Order_Tb::exportViewFields());
			return view("reports.order_tb-view", ["record" => $record]);
		}
		elseif($format == "pdf"){
			$record = $query->findOrFail($rec_id, Order_Tb::exportViewFields());
			$pdf = PDF::loadView("reports.order_tb-view", ["record" => $record]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new OrderTbViewExport($query, $rec_id), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new OrderTbViewExport($query, $rec_id), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
