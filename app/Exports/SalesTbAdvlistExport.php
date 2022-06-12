<?php 

namespace App\Exports;
use App\Models\Sales_Tb;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class SalesTbAdvlistExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Sales_Tb::exportAdvlistFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Order No',
			'Products Tb Product Name',
			'Qty',
			'Rate',
			'Vendors Tb Name',
			'Total Amount',
			'Users Tb Firstname',
			'Users Tb Lastname',
			'Users Tb Matric No',
			'Date',
			'Sales Status'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->order_no,
			$record->products_tb_product_name,
			$record->qty,
			$record->rate,
			$record->vendors_tb_name,
			$record->total_amount,
			$record->users_tb_firstname,
			$record->users_tb_lastname,
			$record->users_tb_matric_no,
			$record->date,
			$record->sales_status
        ];
    }
}
