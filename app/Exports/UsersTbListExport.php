<?php 

namespace App\Exports;
use App\Models\Users_Tb;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class UsersTbListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Users_Tb::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Firstname',
			'Lastname',
			'Email',
			'Matric No',
			'Phone',
			'Gender',
			'Department',
			'Level',
			'Status',
			'Reg Date'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->firstname,
			$record->lastname,
			$record->email,
			$record->matric_no,
			$record->phone,
			$record->gender,
			$record->department,
			$record->level,
			$record->status,
			$record->reg_date
        ];
    }
}
