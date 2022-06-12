@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("user_orders_view/add");
    $can_edit = $user->can("user_orders_view/edit");
    $can_view = $user->can("user_orders_view/view");
    $can_delete = $user->can("user_orders_view/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "User Orders View";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="card-4 bg-light mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto " >
                    <div class="row  q-col-gutter-sm q-px-sm" >
                        <div class="col">
                            <div class="h5 font-weight-bold text-primary">User Orders View</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 " >
                    <form  class="search" action="{{ url()->current() }}" method="get">
                        <input type="hidden" name="page" value="1" />
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="Search" />
                            <div class="input-group-append">
                                <button class="btn btn-primary"><i class="material-icons">search</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid" >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class=" page-content" >
                        <div id="user_orders_view-list-records">
                            <div class="row">
                                <div class="col">
                                    <div id="page-main-content" class="table-responsive">
                                        <?php Html::page_bread_crumb("/user_orders_view/", $field_name, $field_value); ?>
                                        <table class="table table-hover table-striped table-sm text-left">
                                            <thead class="table-header ">
                                                <tr>
                                                    <th class="td-order_id" > Order Id</th>
                                                    <th class="td-order_no" > Order No</th>
                                                    <th class="td-product_id" > Product Id</th>
                                                    <th class="td-vendor_id" > Vendor Id</th>
                                                    <th class="td-user_id" > User Id</th>
                                                    <th class="td-mat_no" > Mat No</th>
                                                    <th class="td-rate" > Rate</th>
                                                    <th class="td-qty" > Qty</th>
                                                    <th class="td-total_amount" > Total Amount</th>
                                                    <th class="td-payment_optn" > Payment Optn</th>
                                                    <th class="td-date" > Date</th>
                                                    <th class="td-dare_reg" > Dare Reg</th>
                                                    <th class="td-order_status" > Order Status</th>
                                                    <th class="td-sales_status" > Sales Status</th>
                                                    <th class="td-remark" > Remark</th>
                                                    <th class="td-vend_id" > Vend Id</th>
                                                    <th class="td-title" > Title</th>
                                                    <th class="td-name" > Name</th>
                                                    <th class="td-pro_id" > Pro Id</th>
                                                    <th class="td-product_name" > Product Name</th>
                                                    <th class="td-description" > Description</th>
                                                    <th class="td-image" > Image</th>
                                                    <th class="td-department_id" > Department Id</th>
                                                    <th class="td-sell_rate" > Sell Rate</th>
                                                    <th class="td-level" > Level</th>
                                                </tr>
                                            </thead>
                                            <?php
                                                if($total_records){
                                            ?>
                                            <tbody class="page-data">
                                                <!--record-->
                                                <?php
                                                    $counter = 0;
                                                    foreach($records as $data){
                                                    $rec_id = ($data['order_id'] ? urlencode($data['order_id']) : null);
                                                    $counter++;
                                                ?>
                                                <tr>
                                                    <!--PageComponentStart-->
                                                    <td class="td-order_id">
                                                        <?php echo  $data['order_id'] ; ?>
                                                    </td>
                                                    <td class="td-order_no">
                                                        <?php echo  $data['order_no'] ; ?>
                                                    </td>
                                                    <td class="td-product_id">
                                                        <?php echo  $data['product_id'] ; ?>
                                                    </td>
                                                    <td class="td-vendor_id">
                                                        <?php echo  $data['vendor_id'] ; ?>
                                                    </td>
                                                    <td class="td-user_id">
                                                        <?php echo  $data['user_id'] ; ?>
                                                    </td>
                                                    <td class="td-mat_no">
                                                        <?php echo  $data['mat_no'] ; ?>
                                                    </td>
                                                    <td class="td-rate">
                                                        <?php echo  $data['rate'] ; ?>
                                                    </td>
                                                    <td class="td-qty">
                                                        <?php echo  $data['qty'] ; ?>
                                                    </td>
                                                    <td class="td-total_amount">
                                                        <?php echo  $data['total_amount'] ; ?>
                                                    </td>
                                                    <td class="td-payment_optn">
                                                        <?php echo  $data['payment_optn'] ; ?>
                                                    </td>
                                                    <td class="td-date">
                                                        <span title="<?php echo human_datetime($data['date']); ?>" class="has-tooltip">
                                                        <?php echo relative_date($data['date']); ?>
                                                        </span>
                                                    </td>
                                                    <td class="td-dare_reg">
                                                        <?php echo  $data['dare_reg'] ; ?>
                                                    </td>
                                                    <td class="td-order_status">
                                                        <?php echo  $data['order_status'] ; ?>
                                                    </td>
                                                    <td class="td-sales_status">
                                                        <?php echo  $data['sales_status'] ; ?>
                                                    </td>
                                                    <td class="td-remark">
                                                        <?php echo  $data['remark'] ; ?>
                                                    </td>
                                                    <td class="td-vend_id">
                                                        <?php echo  $data['vend_id'] ; ?>
                                                    </td>
                                                    <td class="td-title">
                                                        <?php echo  $data['title'] ; ?>
                                                    </td>
                                                    <td class="td-name">
                                                        <?php echo  $data['name'] ; ?>
                                                    </td>
                                                    <td class="td-pro_id">
                                                        <?php echo  $data['pro_id'] ; ?>
                                                    </td>
                                                    <td class="td-product_name">
                                                        <?php echo  $data['product_name'] ; ?>
                                                    </td>
                                                    <td class="td-description">
                                                        <?php echo  $data['description'] ; ?>
                                                    </td>
                                                    <td class="td-image">
                                                        <?php 
                                                            Html :: page_img($data['image'],50,50, "medium", "large", 1); 
                                                        ?>
                                                    </td>
                                                    <td class="td-department_id">
                                                        <?php echo  $data['department_id'] ; ?>
                                                    </td>
                                                    <td class="td-sell_rate">
                                                        <?php echo  $data['sell_rate'] ; ?>
                                                    </td>
                                                    <td class="td-level">
                                                        <?php echo  $data['level'] ; ?>
                                                    </td>
                                                    <!--PageComponentEnd-->
                                                </tr>
                                                <?php 
                                                    }
                                                ?>
                                                <!--endrecord-->
                                            </tbody>
                                            <tbody class="search-data"></tbody>
                                            <?php
                                                }
                                                else{
                                            ?>
                                            <tbody class="page-data">
                                                <tr>
                                                    <td class="bg-light text-center text-muted animated bounce p-3" colspan="1000">
                                                        <i class="material-icons">block</i> No record found
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <?php
                                                }
                                            ?>
                                        </table>
                                    </div>
                                    <?php
                                        if($show_footer){
                                    ?>
                                    <div class="">
                                        <div class="row justify-content-center">    
                                            <div class="col-md-auto justify-content-center">    
                                                <div class="p-3 d-flex justify-content-between">    
                                                </div>
                                            </div>
                                            <div class="col">   
                                                <?php
                                                    if($show_pagination == true){
                                                    $pager = new Pagination($total_records, $record_count);
                                                    $pager->show_page_count = false;
                                                    $pager->show_record_count = true;
                                                    $pager->show_page_limit =false;
                                                    $pager->limit = $limit;
                                                    $pager->show_page_number_list = true;
                                                    $pager->pager_link_range=5;
                                                    $pager->render();
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
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
