<?php 

namespace App\Exports;
use App\Models\Products_Tb;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ProductsTbForStockExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Products_Tb::exportForStockFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Product Name',
			'Vendors Tb Name',
			'Qty'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->product_name,
			$record->vendors_tb_name,
			$record->qty
        ];
    }
}
