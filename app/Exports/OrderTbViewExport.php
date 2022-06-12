<?php 

namespace App\Exports;
use App\Models\Order_Tb;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class OrderTbViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(Order_Tb::exportViewFields());
        $this->rec_id = $rec_id;
    }


    public function query()
    {
        return $this->query->where("order_id", $this->rec_id);
    }


	public function headings(): array
    {
        return [
			'Order Id',
			'Order No',
			'Product Id',
			'Vendor Id',
			'User Id',
			'Mat No',
			'Rate',
			'Qty',
			'Total Amount',
			'Payment Optn',
			'Date',
			'Dare Reg',
			'Order Status',
			'Sales Status',
			'Remark',
			'Products Tb Product Id',
			'Products Tb Product Name',
			'Products Tb Unit',
			'Products Tb Description',
			'Products Tb Image',
			'Products Tb Vendor Id',
			'Products Tb Department Id',
			'Products Tb Level',
			'Products Tb Sell Rate',
			'Products Tb Purchase Rate',
			'Products Tb Status',
			'Products Tb Reg Date',
			'Products Tb Available For',
			'Products Tb Admin Id',
			'Products Tb Vendor Email',
			'Products Tb Qty',
			'Users Tb User Id',
			'Users Tb Matric No',
			'Users Tb Firstname',
			'Users Tb Lastname',
			'Users Tb Email',
			'Users Tb Phone',
			'Users Tb Department',
			'Users Tb Level',
			'Users Tb Status',
			'Users Tb Email Link',
			'Users Tb Email Comfirm',
			'Users Tb Email Token',
			'Users Tb Reg Date',
			'Users Tb Gender',
			'Users Tb Deleted',
			'Users Tb Photo',
			'Users Tb Email Verified At',
			'Vendors Tb Vendor Id',
			'Vendors Tb Title',
			'Vendors Tb Name',
			'Vendors Tb Email',
			'Vendors Tb Department Id',
			'Vendors Tb Status',
			'Vendors Tb Reg Date',
			'Amount in words'
        ];
    }


    public function map($record): array
    {
        return [
			$record->order_id,
			$record->order_no,
			$record->product_id,
			$record->vendor_id,
			$record->user_id,
			$record->mat_no,
			$record->rate,
			$record->qty,
			$record->total_amount,
			$record->payment_optn,
			$record->date,
			$record->dare_reg,
			$record->order_status,
			$record->sales_status,
			$record->remark,
			$record->products_tb_product_id,
			$record->products_tb_product_name,
			$record->products_tb_unit,
			$record->products_tb_description,
			$record->products_tb_image,
			$record->products_tb_vendor_id,
			$record->products_tb_department_id,
			$record->products_tb_level,
			$record->products_tb_sell_rate,
			$record->products_tb_purchase_rate,
			$record->products_tb_status,
			$record->products_tb_reg_date,
			$record->products_tb_available_for,
			$record->products_tb_admin_id,
			$record->products_tb_vendor_email,
			$record->products_tb_qty,
			$record->users_tb_user_id,
			$record->users_tb_matric_no,
			$record->users_tb_firstname,
			$record->users_tb_lastname,
			$record->users_tb_email,
			$record->users_tb_phone,
			$record->users_tb_department,
			$record->users_tb_level,
			$record->users_tb_status,
			$record->users_tb_email_link,
			$record->users_tb_email_comfirm,
			$record->users_tb_email_token,
			$record->users_tb_reg_date,
			$record->users_tb_gender,
			$record->users_tb_deleted,
			$record->users_tb_photo,
			$record->users_tb_email_verified_at,
			$record->vendors_tb_vendor_id,
			$record->vendors_tb_title,
			$record->vendors_tb_name,
			$record->vendors_tb_email,
			$record->vendors_tb_department_id,
			$record->vendors_tb_status,
			$record->vendors_tb_reg_date,
			$record->tmt
        ];
    }
}
