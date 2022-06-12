<?php 

namespace App\Exports;
use App\Models\Vendors_Tb;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class VendorsTbListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Vendors_Tb::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Vendor Id',
			'Title',
			'Name',
			'Email',
			'Department Id',
			'Status',
			'Reg Date'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->vendor_id,
			$record->title,
			$record->name,
			$record->email,
			$record->department_id,
			$record->status,
			$record->reg_date
        ];
    }
}
