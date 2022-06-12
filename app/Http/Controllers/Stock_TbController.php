<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stock_TbAddRequest;
use App\Http\Requests\Stock_TbEditRequest;
use App\Models\Stock_Tb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class Stock_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.stock_tb.list";
		$query = Stock_Tb::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Stock_Tb::search($query, $search); // search table records
		}
		$query->join("vendors_tb", "stock_tb.vendor_id", "=", "vendors_tb.vendor_id");
		$query->join("products_tb", "stock_tb.item_id", "=", "products_tb.product_id");
		$orderby = $request->orderby ?? "stock_tb.stock_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Stock_Tb::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Stock_Tb::query();
		$query->join("vendors_tb", "stock_tb.vendor_id", "=", "vendors_tb.vendor_id");
		$query->join("products_tb", "stock_tb.item_id", "=", "products_tb.product_id");
		$record = $query->findOrFail($rec_id, Stock_Tb::viewFields());
		return $this->renderView("pages.stock_tb.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.stock_tb.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Stock_TbAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Stock_Tb record
		$record = Stock_Tb::create($modeldata);
		$rec_id = $record->stock_id;
		return $this->redirect("stock_tb", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Stock_TbEditRequest $request, $rec_id = null){
		$query = Stock_Tb::query();
		$record = $query->findOrFail($rec_id, Stock_Tb::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("stock_tb", "Record updated successfully");
		}
		return $this->renderView("pages.stock_tb.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Stock_Tb::query();
		$query->whereIn("stock_id", $arr_id);
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
	function vendor_stock(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.stock_tb.vendor_stock";
		$query = Stock_Tb::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Stock_Tb::search($query, $search); // search table records
		}
		$query->join("vendors_tb", "stock_tb.vendor_id", "=", "vendors_tb.vendor_id");
		$query->join("products_tb", "stock_tb.item_id", "=", "products_tb.product_id");
		$orderby = $request->orderby ?? "stock_tb.stock_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("product_id" , "55");
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Stock_Tb::vendorStockFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function vendor_qty(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.stock_tb.vendor_qty";
		$query = Stock_Tb::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Stock_Tb::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "stock_tb.stock_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("stock_id" , $rec_id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Stock_Tb::vendorQtyFields());
		return $this->renderView($view, compact("records"));
	}
public static  function get_total_in_out($item_id){
        $params = ['item_id' => $item_id];
        $results = DB::select("select sum(item_in) as totalin, sum(item_out) as totalout  from stock_tb where item_id=:item_id",
        $params);
        return $results;
    }
}
