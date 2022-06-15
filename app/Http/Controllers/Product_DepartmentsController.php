<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product_DepartmentsAddRequest;
use App\Http\Requests\Product_DepartmentsEditRequest;
use App\Models\Product_Departments;
use Illuminate\Http\Request;
use Exception;
class Product_DepartmentsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.product_departments.list";
		$query = Product_Departments::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Product_Departments::search($query, $search); // search table records
		}
		$query->join("products_tb", "product_departments.product_id", "=", "products_tb.product_id");
		$query->join("departments_tb", "product_departments.department_id", "=", "departments_tb.department_id");
		$orderby = $request->orderby ?? "product_departments.product_department_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Product_Departments::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Product_Departments::query();
		$record = $query->findOrFail($rec_id, Product_Departments::viewFields());
		return $this->renderView("pages.product_departments.view", ["data" => $record]);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Product_DepartmentsEditRequest $request, $rec_id = null){
		$query = Product_Departments::query();
		$record = $query->findOrFail($rec_id, Product_Departments::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("product_departments", "Record updated successfully");
		}
		return $this->renderView("pages.product_departments.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Product_Departments::query();
		$query->whereIn("product_department_id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
