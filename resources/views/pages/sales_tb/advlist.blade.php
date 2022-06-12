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
    $vendor_id_option_list = $comp_model->vendor_id_option_list();
    $pageTitle = "Sales";
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
<div  class="mb-3" >
    <div class="container-fluid">
        <div class="row ">
        </div>
    </div>
</div>
<div  class="mb-3" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-6 col-lg-4 comp-grid" >
                <form method="get" action="" class="form">
                    <div class="q-mb-sm q-pa-sm ">
                        <label class="font-weight-bold p-2">Filter by Date</label>
                        <div class="">
                            <input class="form-control datepicker"  value="<?php echo get_value('sales_tb_date') ?>" type="datetime"  name="sales_tb_date" placeholder="Select date" data-enable-time="" data-date-format="Y-m-d" data-alt-format="M j, Y" data-inline="true" data-no-calendar="false" data-mode="range"  />
                        </div>
                    </div>
                    <hr />
                    <div class="form-group text-center">
                        <button class="btn btn-primary">GET</button>
                    </div>
                </form>
            </div>
            <div class="col-6 col-lg-4 comp-grid" >
                <div class="dropdown">
                    <button class="btn btn-block btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Vendor
                    </button>
                    <div class="dropdown-menu" >
                        <?php 
                            $options = $vendor_id_option_list ?? [];
                            foreach($options as $option){
                            $value = $option->value;
                            $label = $option->label;
                            $nav_link = add_query_params(['sales_tb_vendor_id' => $value]);
                        ?>
                        <a class="dropdown-item <?php echo is_active_link('sales_tb_vendor_id', $value); ?>" href="<?php print_link($nav_link) ?>">
                        <?php echo $label; ?>
                    </a>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div  class="" >
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-sm-12 col-lg-12 comp-grid" >
                <div  class=" page-content" >
                    <div id="sales_tb-advlist-records">
                        <div class="row">
                            <div class="col">
                                <div id="page-main-content" class="table-responsive">
                                    <?php Html::page_bread_crumb("/sales_tb/advlist", $field_name, $field_value); ?>
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
                                                <th class="td-total_amount <?php echo (get_value('orderby') == 'total_amount' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('total_amount', "Total Amount", ''); ?>
                                                </th>
                                                <th class="td-name" > Vendors Tb Name</th>
                                                <th class="td-firstname" > Users Tb Firstname</th>
                                                <th class="td-lastname" > Users Tb Lastname</th>
                                                <th class="td-matric_no" > Users Tb Matric No</th>
                                                <th class="td-date <?php echo (get_value('orderby') == 'date' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('date', "Date", ''); ?>
                                                </th>
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
                                                $sum_of_total_amount = 0;
                                                foreach($records as $data){
                                                $rec_id = ($data['sales_id'] ? urlencode($data['sales_id']) : null);
                                                $counter++;
                                                $sum_of_total_amount = $sum_of_total_amount + $data['total_amount'];
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
                                            <td class="td-total_amount">
                                                <?php echo  $data['total_amount'] ; ?>
                                            </td>
                                            <td class="td-vendors_tb_name">
                                                <?php echo  $data['vendors_tb_name'] ; ?>
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
                                                <?php echo  $data['date'] ; ?>
                                            </td>
                                            <td class="td-sales_status">
                                                <?php echo  $data['sales_status'] ; ?>
                                            </td>
                                            <!--PageComponentEnd-->
                                            <td class="td-btn">
                                                <?php if($can_delete){ ?>
                                                <a class="mx-1 btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal"  href="<?php print_link("sales_tb/delete/$rec_id"); ?>">
                                                <i class="material-icons">clear</i> Refund
                                            </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    ?>
                                    <!--endrecord-->
                                </tbody>
                                <tbody class="search-data"></tbody>
                                <tfoot><tr><th></th><th></th><th></th><th></th><th><?php echo "N".number_format($sum_of_total_amount);  ?></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr></tfoot>
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
                                        <div class="dropup export-btn-holder mx-1">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">save</i> Export
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <?php $export_print_link = add_query_params(['export' => 'print']); ?>
                                                <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                <img src="{{ asset('images/print.png') }}" class="mr-2" /> PRINT
                                            </a>
                                            <?php $export_pdf_link = add_query_params(['export' => 'pdf']); ?>
                                            <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="{{ asset('images/pdf.png') }}" class="mr-2" /> PDF
                                        </a>
                                        <?php $export_csv_link = add_query_params(['export' => 'csv']); ?>
                                        <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                        <img src="{{ asset('/images/csv.png') }}" class="mr-2" /> CSV
                                    </a>
                                    <?php $export_excel_link = add_query_params(['export' => 'excel']); ?>
                                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                    <img src="{{ asset('images/xsl.png') }}" class="mr-2" /> EXCEL
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">   
                    <?php
                        if($show_pagination == true){
                        $pager = new Pagination($total_records, $record_count);
                        $pager->show_page_count = true;
                        $pager->show_record_count = true;
                        $pager->show_page_limit =true;
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
