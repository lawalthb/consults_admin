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
    $pageTitle = "Products Tb";
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
                            <div class="h5 font-weight-bold text-primary">Products Tb</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("products_tb/add") ?>" >
                    <i class="material-icons">add</i>                               
                    Add New Products Tb 
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
                    <div id="products_tb-list-records">
                        <div class="row">
                            <div class="col">
                                <div id="page-main-content" class="table-responsive">
                                    <?php Html::page_bread_crumb("/products_tb/", $field_name, $field_value); ?>
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
                                                <th class="td-product_id" > Product Id</th>
                                                <th class="td-product_name" > Product Name</th>
                                                <th class="td-name" > Vendors Name</th>
                                                <th class="td-sell_rate" > Selling Rate</th>
                                                <th class="td-purchase_rate" > Purchase Rate</th>
                                                <th class="td-name" > Departments</th>
                                                <th class="td-level" > Level</th>
                                                <th class="td-status" > Status</th>
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
                                                <?php if($can_delete){ ?>
                                                <td class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                    <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['product_id'] ?>" type="checkbox" />
                                                    <span class="custom-control-label"></span>
                                                    </label>
                                                </td>
                                                <?php } ?>
                                                <!--PageComponentStart-->
                                                <td class="td-product_id">
                                                    <a href="<?php print_link("products_tb/view/$data[product_id]") ?>"><?php echo $data['product_id']; ?></a>
                                                </td>
                                                <td class="td-product_name">
                                                    <?php echo  $data['product_name'] ; ?>
                                                </td>
                                                <td class="td-vendors_tb_name">
                                                    <?php echo  $data['vendors_tb_name'] ; ?>
                                                </td>
                                                <td class="td-sell_rate">
                                                    <?php echo  $data['sell_rate'] ; ?>
                                                </td>
                                                <td class="td-purchase_rate">
                                                    <?php echo  $data['purchase_rate'] ; ?>
                                                </td>
                                                <td class="td-departments_tb_name">
                                                    <?php echo  $data['departments_tb_name'] ; ?>
                                                </td>
                                                <td class="td-level">
                                                    <?php echo  $data['level'] ; ?>
                                                </td>
                                                <td class="td-status">
                                                    <?php echo  $data['status'] ; ?>
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