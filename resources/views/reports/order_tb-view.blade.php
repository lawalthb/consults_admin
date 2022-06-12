
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <tbody>
        <tr>
            <th>Order Id</th>
            <td>{{ $record->order_id }}</td>
        </tr>
        <tr>
            <th>Order No</th>
            <td>{{ $record->order_no }}</td>
        </tr>
        <tr>
            <th>Product Id</th>
            <td>{{ $record->product_id }}</td>
        </tr>
        <tr>
            <th>Vendor Id</th>
            <td>{{ $record->vendor_id }}</td>
        </tr>
        <tr>
            <th>User Id</th>
            <td>{{ $record->user_id }}</td>
        </tr>
        <tr>
            <th>Mat No</th>
            <td>{{ $record->mat_no }}</td>
        </tr>
        <tr>
            <th>Rate</th>
            <td>{{ $record->rate }}</td>
        </tr>
        <tr>
            <th>Qty</th>
            <td>{{ $record->qty }}</td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td>{{ $record->total_amount }}</td>
        </tr>
        <tr>
            <th>Payment Optn</th>
            <td>{{ $record->payment_optn }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $record->date }}</td>
        </tr>
        <tr>
            <th>Dare Reg</th>
            <td>{{ $record->dare_reg }}</td>
        </tr>
        <tr>
            <th>Order Status</th>
            <td>{{ $record->order_status }}</td>
        </tr>
        <tr>
            <th>Sales Status</th>
            <td>{{ $record->sales_status }}</td>
        </tr>
        <tr>
            <th>Remark</th>
            <td>{{ $record->remark }}</td>
        </tr>
        <tr>
            <th>Products Tb Product Id</th>
            <td>{{ $record->products_tb_product_id }}</td>
        </tr>
        <tr>
            <th>Products Tb Product Name</th>
            <td>{{ $record->products_tb_product_name }}</td>
        </tr>
        <tr>
            <th>Products Tb Unit</th>
            <td>{{ $record->products_tb_unit }}</td>
        </tr>
        <tr>
            <th>Products Tb Description</th>
            <td>{{ $record->products_tb_description }}</td>
        </tr>
        <tr>
            <th>Products Tb Image</th>
            <td>{{ $record->products_tb_image }}</td>
        </tr>
        <tr>
            <th>Products Tb Vendor Id</th>
            <td>{{ $record->products_tb_vendor_id }}</td>
        </tr>
        <tr>
            <th>Products Tb Department Id</th>
            <td>{{ $record->products_tb_department_id }}</td>
        </tr>
        <tr>
            <th>Products Tb Level</th>
            <td>{{ $record->products_tb_level }}</td>
        </tr>
        <tr>
            <th>Products Tb Sell Rate</th>
            <td>{{ $record->products_tb_sell_rate }}</td>
        </tr>
        <tr>
            <th>Products Tb Purchase Rate</th>
            <td>{{ $record->products_tb_purchase_rate }}</td>
        </tr>
        <tr>
            <th>Products Tb Status</th>
            <td>{{ $record->products_tb_status }}</td>
        </tr>
        <tr>
            <th>Products Tb Reg Date</th>
            <td>{{ $record->products_tb_reg_date }}</td>
        </tr>
        <tr>
            <th>Products Tb Available For</th>
            <td>{{ $record->products_tb_available_for }}</td>
        </tr>
        <tr>
            <th>Products Tb Admin Id</th>
            <td>{{ $record->products_tb_admin_id }}</td>
        </tr>
        <tr>
            <th>Products Tb Vendor Email</th>
            <td>{{ $record->products_tb_vendor_email }}</td>
        </tr>
        <tr>
            <th>Products Tb Qty</th>
            <td>{{ $record->products_tb_qty }}</td>
        </tr>
        <tr>
            <th>Users Tb User Id</th>
            <td>{{ $record->users_tb_user_id }}</td>
        </tr>
        <tr>
            <th>Users Tb Matric No</th>
            <td>{{ $record->users_tb_matric_no }}</td>
        </tr>
        <tr>
            <th>Users Tb Firstname</th>
            <td>{{ $record->users_tb_firstname }}</td>
        </tr>
        <tr>
            <th>Users Tb Lastname</th>
            <td>{{ $record->users_tb_lastname }}</td>
        </tr>
        <tr>
            <th>Users Tb Email</th>
            <td>{{ $record->users_tb_email }}</td>
        </tr>
        <tr>
            <th>Users Tb Phone</th>
            <td>{{ $record->users_tb_phone }}</td>
        </tr>
        <tr>
            <th>Users Tb Department</th>
            <td>{{ $record->users_tb_department }}</td>
        </tr>
        <tr>
            <th>Users Tb Level</th>
            <td>{{ $record->users_tb_level }}</td>
        </tr>
        <tr>
            <th>Users Tb Status</th>
            <td>{{ $record->users_tb_status }}</td>
        </tr>
        <tr>
            <th>Users Tb Email Link</th>
            <td>{{ $record->users_tb_email_link }}</td>
        </tr>
        <tr>
            <th>Users Tb Email Comfirm</th>
            <td>{{ $record->users_tb_email_comfirm }}</td>
        </tr>
        <tr>
            <th>Users Tb Email Token</th>
            <td>{{ $record->users_tb_email_token }}</td>
        </tr>
        <tr>
            <th>Users Tb Reg Date</th>
            <td>{{ $record->users_tb_reg_date }}</td>
        </tr>
        <tr>
            <th>Users Tb Gender</th>
            <td>{{ $record->users_tb_gender }}</td>
        </tr>
        <tr>
            <th>Users Tb Deleted</th>
            <td>{{ $record->users_tb_deleted }}</td>
        </tr>
        <tr>
            <th>Users Tb Photo</th>
            <td>{{ $record->users_tb_photo }}</td>
        </tr>
        <tr>
            <th>Users Tb Email Verified At</th>
            <td>{{ $record->users_tb_email_verified_at }}</td>
        </tr>
        <tr>
            <th>Vendors Tb Vendor Id</th>
            <td>{{ $record->vendors_tb_vendor_id }}</td>
        </tr>
        <tr>
            <th>Vendors Tb Title</th>
            <td>{{ $record->vendors_tb_title }}</td>
        </tr>
        <tr>
            <th>Vendors Tb Name</th>
            <td>{{ $record->vendors_tb_name }}</td>
        </tr>
        <tr>
            <th>Vendors Tb Email</th>
            <td>{{ $record->vendors_tb_email }}</td>
        </tr>
        <tr>
            <th>Vendors Tb Department Id</th>
            <td>{{ $record->vendors_tb_department_id }}</td>
        </tr>
        <tr>
            <th>Vendors Tb Status</th>
            <td>{{ $record->vendors_tb_status }}</td>
        </tr>
        <tr>
            <th>Vendors Tb Reg Date</th>
            <td>{{ $record->vendors_tb_reg_date }}</td>
        </tr>
        <tr>
            <th>Amount in words</th>
            <td>{{ $record->tmt }}</td>
        </tr>
    </tbody>
</table>
@endsection
