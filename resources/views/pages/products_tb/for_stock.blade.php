@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("products_tb/add");
    $can_edit = $user->can("products_tb/edit");
    $can_view = $user->can("products_tb/view");
    $can_delete = $user->can("products_tb/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $vendor_id_option_list = $comp_model->vendor_id_option_list();
    $pageTitle = "Products stock";
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
                    <div class=" "></div>
                    <div class="row  q-col-gutter-sm q-px-sm" >
                        <div class="col">
                            <div class="h5 font-weight-bold text-primary">Stock  level </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto comp-grid" >
                    <div class="dropdown">
                        <button class="btn btn-block btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Vendor Id
                        </button>
                        <div class="dropdown-menu" >
                            <?php 
                                $options = $vendor_id_option_list ?? [];
                                foreach($options as $option){
                                $value = $option->value;
                                $label = $option->label;
                                $nav_link = add_query_params(['products_tb_vendor_id' => $value]);
                            ?>
                            <a class="dropdown-item <?php echo is_active_link('products_tb_vendor_id', $value); ?>" href="<?php print_link($nav_link) ?>">
                            <?php echo $label; ?>
                        </a>
                        <?php
                            }
                        ?>
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
            <div class="col-md-4 " >
                <form method="get" action="" class="form">
                    <div class="q-mb-sm q-pa-sm ">
                        <label class="font-weight-bold p-2">Filter by Qty Balance</label>
                        <div class="">
                            <?php 
                                $to = 5;
                                $from =  0;
                                $range_field =  get_value('products_tb_qty');
                                if($range_field){
                                $range = explode('-', $range_field);
                                $from = $range[0];
                                $to = $range[1] ?? null;
                                }
                            ?>
                            <input class="ion-range" type="text" data-from="<?php echo $from ?>" data-to="<?php echo $to ?>" data-force_edge="true" data-prefix="" data-postfix=""  name="products_tb_qty" data-step="5" data-type="double" data-min="0"   data-max="200"   data-grid="true" data-grid-snap="true" / > 
                        </div>
                    </div>
                    <hr />
                    <div class="form-group text-center">
                        <button class="btn btn-primary">Filter</button>
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
            <div class="col-md-12 comp-grid" >
                <a  class="btn btn-primary btn-block" href="<?php print_link("stock_tb/index?orderby=reg_date&ordertype=desc") ?>" >
                <i class="material-icons ">equalizer</i>                                
                Stock Flow 
            </a>
        </div>
    </div>
</div>
</div>
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12 comp-grid" >
                <?php Html::display_page_errors($errors); ?>
                <div class="filter-tags mb-2">
                    <?php
                        Html::filter_tag('products_tb_vendor_id', 'Vendor Id', $vendor_id_option_list);
                    ?>
                    <?php
                        Html::filter_tag('products_tb_qty', 'Qty');
                    ?>
                </div>
                <div class=" "><?php
                    $sn = 0;
                ?>
            </div>
            <div  class=" page-content" >
                <div id="products_tb-for_stock-records">
                    <div class="row">
                        <div class="col">
                            <div id="page-main-content" class="table-responsive">
                                <?php Html::page_bread_crumb("/products_tb/for_stock", $field_name, $field_value); ?>
                                <table class="table table-hover table-striped table-sm text-left">
                                    <thead class="table-header ">
                                        <tr>
                                            <th class="td-#Template#SN" > SN</th>
                                            <th class="td-product_name" > Product Name</th>
                                            <th class="td-name" > Vendors Tb Name</th>
                                            <th class="td-#Template#Total Qty In" > Total Qty In</th>
                                            <th class="td-#Template#Total Qty Out" > Total Qty Out</th>
                                            <th class="td-#Template#Qty Balance" > Qty Balance</th>
                                            <th class="td-qty" > Qty</th>
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
                                            $rec_id = ($data['product_id'] ? urlencode($data['product_id']) : null);
                                            $counter++;
                                        ?>
                                        <tr>
                                            <!--PageComponentStart-->
                                            <td class="td-#Template#SN"><span><?=++$sn ;?></span></td>
                                            <td class="td-product_name">
                                                <a href="<?php print_link("products_tb/view/$data[product_id]") ?>"><?php echo $data['product_name']; ?></a>
                                            </td>
                                            <td class="td-vendors_tb_name">
                                                <?php echo  $data['vendors_tb_name'] ; ?>
                                            </td>
                                            <td class="td-#Template#Total Qty In"><?php $resut =  \App\Http\Controllers\Stock_TbController::get_total_in_out($data['product_id']);
                                                foreach($resut as $results ){
                                                echo $qty_in =$results->totalin;
                                                }
                                                $qty_in;
                                            ?></td>
                                            <td class="td-#Template#Total Qty Out"><?php $resut =  \App\Http\Controllers\Stock_TbController::get_total_in_out($data['product_id']);
                                                foreach($resut as $results ){
                                                echo $qty_out=  $results->totalout;
                                                }
                                                $qty_out;
                                            ?></td>
                                            <td class="td-#Template#Qty Balance"><span><?php echo $qty_bal = $qty_in - $qty_out ; ?>  </span></td>
                                            <td class="td-qty">
                                                <?php echo  $data['qty'] ; ?>
                                            </td>
                                            <!--PageComponentEnd-->
                                            <td class="td-btn">
                                                <div class="dropdown" >
                                                    <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                    <i class="material-icons">menu</i> 
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <?php if($can_view){ ?>
                                                        <a class="dropdown-item "   href="<?php print_link("products_tb/view/$rec_id"); ?>">
                                                        <i class="material-icons">visibility</i> View
                                                    </a>
                                                    <?php } ?>
                                                    <?php if($can_edit){ ?>
                                                    <a class="dropdown-item "   href="<?php print_link("products_tb/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="dropdown-item record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal" href="<?php print_link("products_tb/delete/$rec_id"); ?>">
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
                                <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("products_tb/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
