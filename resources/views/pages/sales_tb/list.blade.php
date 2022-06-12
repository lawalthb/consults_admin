@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("sales_tb/add");
    $can_edit = $user->can("sales_tb/edit");
    $can_view = $user->can("sales_tb/view");
    $can_delete = $user->can("sales_tb/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Sales Tb";
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
                            <div class="h5 font-weight-bold text-primary">Sales Tb</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("sales_tb/advlist") ?>" >
                    <i class="material-icons ">line_style</i>                               
                    Advance List 
                </a>
                <?php } ?>
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
                    <div id="sales_tb-list-records">
                        <div class="row">
                            <div class="col">
                                <div id="page-main-content" class="table-responsive">
                                    <?php Html::page_bread_crumb("/sales_tb/", $field_name, $field_value); ?>
                                    <table class="table table-hover table-striped table-sm text-left">
                                        <thead class="table-header ">
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class="td-checkbox">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                <span class="custom-control-label"></span>
                                                </label>
                                                </th>
                                                <?php } ?>
                                                <th class="td-order_no" > Order No</th>
                                                <th class="td-product_name" > Products Tb Product Name</th>
                                                <th class="td-qty" > Qty</th>
                                                <th class="td-rate" > Rate</th>
                                                <th class="td-name" > Vendors Tb Name</th>
                                                <th class="td-total_amount" > Total Amount</th>
                                                <th class="td-firstname" > Users Tb Firstname</th>
                                                <th class="td-lastname" > Users Tb Lastname</th>
                                                <th class="td-matric_no" > Users Tb Matric No</th>
                                                <th class="td-date" > Date</th>
                                                <th class="td-sales_status" > Sales Status</th>
                                                <th class="td-btn"></th>
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
                                                $rec_id = ($data['sales_id'] ? urlencode($data['sales_id']) : null);
                                                $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <td class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                    <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['sales_id'] ?>" type="checkbox" />
                                                    <span class="custom-control-label"></span>
                                                    </label>
                                                </td>
                                                <?php } ?>
                                                <!--PageComponentStart-->
                                                <td class="td-order_no">
                                                    <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("order_tb//" . urlencode($data['order_no'])) ?>">
                                                    <?php echo $data['order_tb_order_no'] ?>
                                                </a>
                                            </td>
                                            <td class="td-products_tb_product_name">
                                                <?php echo  $data['products_tb_product_name'] ; ?>
                                            </td>
                                            <td class="td-qty">
                                                <?php echo  $data['qty'] ; ?>
                                            </td>
                                            <td class="td-rate">
                                                <?php echo  $data['rate'] ; ?>
                                            </td>
                                            <td class="td-vendors_tb_name">
                                                <?php echo  $data['vendors_tb_name'] ; ?>
                                            </td>
                                            <td class="td-total_amount">
                                                <?php echo  $data['total_amount'] ; ?>
                                            </td>
                                            <td class="td-users_tb_firstname">
                                                <?php echo  $data['users_tb_firstname'] ; ?>
                                            </td>
                                            <td class="td-users_tb_lastname">
                                                <?php echo  $data['users_tb_lastname'] ; ?>
                                            </td>
                                            <td class="td-users_tb_matric_no">
                                                <?php echo  $data['users_tb_matric_no'] ; ?>
                                            </td>
                                            <td class="td-date">
                                                <span title="<?php echo human_datetime($data['date']); ?>" class="has-tooltip">
                                                <?php echo relative_date($data['date']); ?>
                                                </span>
                                            </td>
                                            <td class="td-sales_status">
                                                <?php echo  $data['sales_status'] ; ?>
                                            </td>
                                            <!--PageComponentEnd-->
                                            <td class="td-btn">
                                                <div class="dropdown" >
                                                    <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                    <i class="material-icons">menu</i> 
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <?php if($can_view){ ?>
                                                        <a class="dropdown-item "   href="<?php print_link("sales_tb/view/$rec_id"); ?>">
                                                        <i class="material-icons">visibility</i> View
                                                    </a>
                                                    <?php } ?>
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
                                </td>
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
                                <?php if($can_delete){ ?>
                                <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("sales_tb/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                <i class="material-icons">clear</i> Delete Selected
                                </button>
                                <?php } ?>
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
