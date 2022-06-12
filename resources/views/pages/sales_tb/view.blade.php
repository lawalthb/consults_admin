@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("sales_tb/add");
    $can_edit = $user->can("sales_tb/edit");
    $can_view = $user->can("sales_tb/view");
    $can_delete = $user->can("sales_tb/delete");
    $pageTitle = "Sales Tb Details";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="view" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="card-4 bg-light mb-3" >
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto " >
                    <div class="row  q-col-gutter-sm q-px-sm" >
                        <div class="col">
                            <div class="h5 font-weight-bold text-primary">Sales Tb Details</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid" >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class="card-4 page-content" >
                        <?php
                            $counter = 0;
                            if($data){
                            $rec_id = ($data['sales_id'] ? urlencode($data['sales_id']) : null);
                            $counter++;
                        ?>
                        <div id="page-main-content" class="">
                            <div class="row">
                                <div class="col">
                                    <!-- Table Body Start -->
                                    <div class="page-data">
                                        <!--PageComponentStart-->
                                        <div class="border-top td-sales_id p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Sales Id</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['sales_id'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-order_no p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Order No</div>
                                                    <div class="font-weight-bold">
                                                        <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("order_tb/view/" . urlencode($data['order_no'])) ?>">
                                                        <i class="material-icons">visibility</i> <?php echo "Order Tb Detail" ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-product_id p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Product Id</div>
                                                <div class="font-weight-bold">
                                                    <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("products_tb/view/" . urlencode($data['product_id'])) ?>">
                                                    <i class="material-icons">visibility</i> <?php echo "Products Tb Detail" ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top td-vendor_id p-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="text-muted"> Vendor Id</div>
                                            <div class="font-weight-bold">
                                                <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("vendors_tb/view/" . urlencode($data['vendor_id'])) ?>">
                                                <i class="material-icons">visibility</i> <?php echo "Vendors Tb Detail" ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top td-user_id p-2">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="text-muted"> User Id</div>
                                        <div class="font-weight-bold">
                                            <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("users_tb/view/" . urlencode($data['user_id'])) ?>">
                                            <i class="material-icons">visibility</i> <?php echo "Users Tb Detail" ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top td-rate p-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-muted"> Rate</div>
                                    <div class="font-weight-bold">
                                        <?php echo  $data['rate'] ; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top td-qty p-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-muted"> Qty</div>
                                    <div class="font-weight-bold">
                                        <?php echo  $data['qty'] ; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top td-total_amount p-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-muted"> Total Amount</div>
                                    <div class="font-weight-bold">
                                        <?php echo  $data['total_amount'] ; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top td-payment_optn p-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-muted"> Payment Optn</div>
                                    <div class="font-weight-bold">
                                        <?php echo  $data['payment_optn'] ; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top td-date p-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-muted"> Date</div>
                                    <div class="font-weight-bold">
                                        <span title="<?php echo human_datetime($data['date']); ?>" class="has-tooltip">
                                        <?php echo relative_date($data['date']); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top td-dare_reg p-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-muted"> Dare Reg</div>
                                    <div class="font-weight-bold">
                                        <?php echo  $data['dare_reg'] ; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top td-sales_status p-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-muted"> Sales Status</div>
                                    <div class="font-weight-bold">
                                        <?php echo  $data['sales_status'] ; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top td-remark p-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-muted"> Remark</div>
                                    <div class="font-weight-bold">
                                        <?php echo  $data['remark'] ; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top td-checkout_by p-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-muted"> Checkout By</div>
                                    <div class="font-weight-bold">
                                        <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("admins_tb/view/" . urlencode($data['checkout_by'])) ?>">
                                        <i class="material-icons">visibility</i> <?php echo "Admins Tb Detail" ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top td-product_id p-2">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-muted"> Products Tb Product Id</div>
                                <div class="font-weight-bold">
                                    <?php echo  $data['products_tb_product_id'] ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top td-product_name p-2">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-muted"> Products Tb Product Name</div>
                                <div class="font-weight-bold">
                                    <?php echo  $data['products_tb_product_name'] ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top td-unit p-2">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-muted"> Products Tb Unit</div>
                                <div class="font-weight-bold">
                                    <?php echo  $data['products_tb_unit'] ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top td-description p-2">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-muted"> Products Tb Description</div>
                                <div class="font-weight-bold">
                                    <?php echo  $data['products_tb_description'] ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top td-image p-2">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-muted"> Products Tb Image</div>
                                <div class="font-weight-bold">
                                    <?php 
                                        Html :: page_img($data['products_tb_image'],400,400, "", "", 1); 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top td-vendor_id p-2">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-muted"> Products Tb Vendor Id</div>
                                <div class="font-weight-bold">
                                    <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("vendors_tb/view/" . urlencode($data['vendor_id'])) ?>">
                                    <i class="material-icons">visibility</i> <?php echo "Vendors Tb Detail" ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top td-department_id p-2">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-muted"> Products Tb Department Id</div>
                            <div class="font-weight-bold">
                                <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("departments_tb/view/" . urlencode($data['department_id'])) ?>">
                                <i class="material-icons">visibility</i> <?php echo "Departments Tb Detail" ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-level p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Products Tb Level</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['products_tb_level'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-sell_rate p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Products Tb Sell Rate</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['products_tb_sell_rate'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-purchase_rate p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Products Tb Purchase Rate</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['products_tb_purchase_rate'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-status p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Products Tb Status</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['products_tb_status'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-reg_date p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Products Tb Reg Date</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['products_tb_reg_date'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-available_for p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Products Tb Available For</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['products_tb_available_for'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-admin_id p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Products Tb Admin Id</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['products_tb_admin_id'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-vendor_email p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Products Tb Vendor Email</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['products_tb_vendor_email'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-qty p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Products Tb Qty</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['products_tb_qty'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-user_id p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Users Tb User Id</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['users_tb_user_id'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-matric_no p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Users Tb Matric No</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['users_tb_matric_no'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-firstname p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Users Tb Firstname</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['users_tb_firstname'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-lastname p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Users Tb Lastname</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['users_tb_lastname'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-email p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Users Tb Email</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['users_tb_email'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-phone p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Users Tb Phone</div>
                        <div class="font-weight-bold">
                            <?php echo  $data['users_tb_phone'] ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top td-department p-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-muted"> Users Tb Department</div>
                        <div class="font-weight-bold">
                            <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("departments_tb/view/" . urlencode($data['department'])) ?>">
                            <i class="material-icons">visibility</i> <?php echo "Departments Tb Detail" ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-level p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Users Tb Level</div>
                    <div class="font-weight-bold">
                        <?php echo  $data['users_tb_level'] ; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-status p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Users Tb Status</div>
                    <div class="font-weight-bold">
                        <?php echo  $data['users_tb_status'] ; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-email_link p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Users Tb Email Link</div>
                    <div class="font-weight-bold">
                        <?php echo  $data['users_tb_email_link'] ; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-email_comfirm p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Users Tb Email Comfirm</div>
                    <div class="font-weight-bold">
                        <?php echo  $data['users_tb_email_comfirm'] ; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-email_token p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Users Tb Email Token</div>
                    <div class="font-weight-bold">
                        <?php echo  $data['users_tb_email_token'] ; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-reg_date p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Users Tb Reg Date</div>
                    <div class="font-weight-bold">
                        <?php echo  $data['users_tb_reg_date'] ; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-gender p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Users Tb Gender</div>
                    <div class="font-weight-bold">
                        <?php echo  $data['users_tb_gender'] ; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-deleted p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Users Tb Deleted</div>
                    <div class="font-weight-bold">
                        <?php echo  $data['users_tb_deleted'] ; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-photo p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Users Tb Photo</div>
                    <div class="font-weight-bold">
                        <?php 
                            Html :: page_img($data['users_tb_photo'],400,400, "", "", 1); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-email_verified_at p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Users Tb Email Verified At</div>
                    <div class="font-weight-bold">
                        <span title="<?php echo human_datetime($data['users_tb_email_verified_at']); ?>" class="has-tooltip">
                        <?php echo relative_date($data['users_tb_email_verified_at']); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-vendor_id p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Vendors Tb Vendor Id</div>
                    <div class="font-weight-bold">
                        <?php echo  $data['vendors_tb_vendor_id'] ; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-title p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Vendors Tb Title</div>
                    <div class="font-weight-bold">
                        <?php echo  $data['vendors_tb_title'] ; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-name p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Vendors Tb Name</div>
                    <div class="font-weight-bold">
                        <?php echo  $data['vendors_tb_name'] ; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-email p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Vendors Tb Email</div>
                    <div class="font-weight-bold">
                        <?php echo  $data['vendors_tb_email'] ; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top td-department_id p-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-muted"> Vendors Tb Department Id</div>
                    <div class="font-weight-bold">
                        <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("departments_tb/view/" . urlencode($data['department_id'])) ?>">
                        <i class="material-icons">visibility</i> <?php echo "Departments Tb Detail" ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="border-top td-status p-2">
        <div class="row align-items-center">
            <div class="col">
                <div class="text-muted"> Vendors Tb Status</div>
                <div class="font-weight-bold">
                    <?php echo  $data['vendors_tb_status'] ; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="border-top td-reg_date p-2">
        <div class="row align-items-center">
            <div class="col">
                <div class="text-muted"> Vendors Tb Reg Date</div>
                <div class="font-weight-bold">
                    <?php echo  $data['vendors_tb_reg_date'] ; ?>
                </div>
            </div>
        </div>
    </div>
    <!--PageComponentEnd-->
    <div class="d-flex q-col-gutter-xs justify-end">
        <div class="dropdown" >
            <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
            <i class="material-icons">menu</i> 
            </button>
            <ul class="dropdown-menu">
                <?php if($can_edit){ ?>
                <a class="dropdown-item "   href="<?php print_link("sales_tb/edit/$rec_id"); ?>">
                <i class="material-icons">edit</i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="dropdown-item record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal" href="<?php print_link("sales_tb/delete/$rec_id"); ?>">
            <i class="material-icons">clear</i> Delete
        </a>
        <?php } ?>
    </ul>
</div>
</div>
</div>
<!-- Table Body End -->
</div>
</div>
</div>
<?php
    }
    else{
?>
<!-- Empty Record Message -->
<div class="text-muted p-3">
    <i class="material-icons">block</i> No Record Found
</div>
<?php
    }
?>
</div>
</div>
</div>
</div>
</div>
</section>
@endsection
@section('pagecss')
<style>
	/**
	body{
			
	}
	*/
</style>
@endsection
@section('pagejs')
<script>
	/*
	* Page Custom Javascript | Jquery codes
	*/

	//$(document).ready(function(){
	//	
	//});
</script>

@endsection
