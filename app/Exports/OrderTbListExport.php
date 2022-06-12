<?php 

namespace App\Exports;
use App\Models\Order_Tb;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class OrderTbListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Order_Tb::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Order No',
			'Item Name',
			'Rate',
			'Qty',
			'Total Amount',
			'Vendors Name',
			'Firstname',
			' Lastname',
			'Mat No',
			'Date',
			'Order Status',
			'Sales Status'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->order_no,
			$record->products_tb_product_name,
			$record->rate,
			$record->qty,
			$record->total_amount,
			$record->vendors_tb_name,
			$record->users_tb_firstname,
			$record->users_tb_lastname,
			$record->mat_no,
			$record->date,
			$record->order_status,
			$record->sales_status
        ];
    }
}
