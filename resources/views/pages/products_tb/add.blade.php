@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Item";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="card-4 bg-light mb-3" >
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto " >
                    <div class="row  q-col-gutter-sm q-px-sm" >
                        <div class="col">
                            <div class="h5 font-weight-bold text-primary">Add New Products Tb</div>
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
                <div class="col-md-9 comp-grid" >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class="card-4 page-content" >
                        <!--[form-start]-->
                        <form id="products_tb-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('products_tb.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="product_name">Product Name <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-product_name-holder" class=" ">
                                                <input id="ctrl-product_name"  value="<?php echo get_value('product_name') ?>" type="text" placeholder="Enter Product Name"  required="" name="product_name"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="vendor_id">Vendor Name <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-vendor_id-holder" class=" ">
                                                <select required=""  id="ctrl-vendor_id" data-load-select-options="vendor_email" name="vendor_id"  placeholder="Select  vendor ..."    class="custom-select" >
                                                <option value="">Select  vendor ...</option>
                                                <?php 
                                                    $options = $comp_model->vendor_id_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = Html::get_field_selected('vendor_id', $value);
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                <?php echo $label; ?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="sell_rate">Selling Rate <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-sell_rate-holder" class=" ">
                                                <input id="ctrl-sell_rate"  value="<?php echo get_value('sell_rate') ?>" type="number" placeholder="Enter Selling Rate" step="1"  required="" name="sell_rate"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="purchase_rate">Purchase Rate <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-purchase_rate-holder" class=" ">
                                                <input id="ctrl-purchase_rate"  value="<?php echo get_value('purchase_rate') ?>" type="number" placeholder="Enter Purchase Rate" step="0.1"  required="" name="purchase_rate"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="level">Level <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-level-holder" class=" checkbox-group-required">
                                                <?php 
                                                    $options = $comp_model->level_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $checked = Html::get_field_checked('level', $value, "");
                                                ?>
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                <input class="custom-control-input" <?php echo $checked; ?> value="<?php echo $value; ?>" type="checkbox" name="level[]"    />
                                                <span class="custom-control-label"><?php echo $label; ?></span>
                                                </label>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="department_id">Department <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-department_id-holder" class=" ">
                                                <select required=""  id="ctrl-department_id" name="department_id"  placeholder="Select a Select ..."    class="custom-select" >
                                                <option value="">Select a Select ...</option>
                                                <?php 
                                                    $options = $comp_model->department_id_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = Html::get_field_selected('department_id', $value);
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                <?php echo $label; ?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="vendor_email">Vendor Email </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-vendor_email-holder" class=" ">
                                                <input id="ctrl-vendor_email"  value="<?php echo get_value('vendor_email') ?>" type="text" placeholder="Enter Vendor Email" list="vendor_email-datalist"  data-load-path="<?php print_link('componentsdata/vendor_email_option_list') ?>" name="vendor_email"  class="form-control " />
                                                <datalist id="vendor_email-datalist"></datalist> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="description">Description / Semester <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-description-holder" class=" ">
                                                <input id="ctrl-description"  value="<?php echo get_value('description') ?>" type="text" placeholder="Enter Description / Semester"  required="" name="description"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <div class="bg-light p-2 subform">
                                <h4 class="record-title">Item Available for </h4>
                                <hr />
                                @csrf
                                <div>
                                    <table class="table table-striped table-sm" data-maxrow="11" data-minrow="1">
                                        <thead>
                                            <tr>
                                                <th class="bg-light"><label for="department_id">Department Id</label></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                for( $row = 1; $row <= 1; $row++ ){
                                            ?>
                                            <tr class="input-row">
                                                <input id="ctrl-product_id-row<?php echo $row; ?>"  value="<?php echo get_value('product_id') ?>" type="hidden" placeholder="Enter Product Id" list="product_id_list"  name="product_departments[<?php echo $row ?>][product_id]"  class="form-control " />
                                                <datalist id="product_id_list">
                                                <?php 
                                                    $options = $comp_model->product_departments_product_id_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                ?>
                                                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                <?php
                                                    }
                                                ?>
                                                </datalist>
                                                <td>
                                                    <div id="ctrl-department_id-row<?php echo $row; ?>-holder" class=" ">
                                                    <select required=""  id="ctrl-department_id-row<?php echo $row; ?>" name="product_departments[<?php echo $row ?>][department_id]"  placeholder="Select a value ..."    class="custom-select" >
                                                    <option value="">Select a value ...</option>
                                                    <?php 
                                                        $options = $comp_model->department_id_option_list() ?? [];
                                                        foreach($options as $option){
                                                        $value = $option->value;
                                                        $label = $option->label ?? $value;
                                                        $selected = Html::get_field_selected('department_id', $value);
                                                    ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                    <?php echo $label; ?>
                                                    </option>
                                                    <?php
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <th class="text-center">
                                            <button type="button" class="close btn-remove-table-row">&times;</button>
                                            </th>
                                        </tr>
                                        <?php 
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="100" class="text-right">
                                        <?php $template_id = "table-row-" . random_str(); ?>
                                        <button type="button" data-template="#<?php echo $template_id ?>" class="btn btn-sm btn-light btn-add-table-row"><i class="material-icons">add</i></button>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <!--[table row template]-->
                                <template id="<?php echo $template_id ?>">
                                <tr class="input-row">
                                    <?php $row = "CURRENTROW"; ?>
                                    <input id="ctrl-product_id-row<?php echo $row; ?>"  value="<?php echo get_value('product_id') ?>" type="hidden" placeholder="Enter Product Id" list="product_id_list"  name="product_departments[<?php echo $row ?>][product_id]"  class="form-control " />
                                    <datalist id="product_id_list">
                                    <?php 
                                        $options = $comp_model->product_departments_product_id_option_list() ?? [];
                                        foreach($options as $option){
                                        $value = $option->value;
                                        $label = $option->label ?? $value;
                                    ?>
                                    <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                    <?php
                                        }
                                    ?>
                                    </datalist>
                                    <td>
                                        <div id="ctrl-department_id-row<?php echo $row; ?>-holder" class=" ">
                                        <select required=""  id="ctrl-department_id-row<?php echo $row; ?>" name="product_departments[<?php echo $row ?>][department_id]"  placeholder="Select a value ..."    class="custom-select" >
                                        <option value="">Select a value ...</option>
                                        <?php 
                                            $options = $comp_model->department_id_option_list() ?? [];
                                            foreach($options as $option){
                                            $value = $option->value;
                                            $label = $option->label ?? $value;
                                            $selected = Html::get_field_selected('department_id', $value);
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                        <?php echo $label; ?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </td>
                                <th class="text-center">
                                <button type="button" class="close btn-remove-table-row">&times;</button>
                                </th>
                            </tr>
                        </template>
                        <!--[/table row template]-->
                    </div>
                    <div class="form-ajax-status"></div>
                </div>
                <!--[form-button-start]-->
                <div class="form-group form-submit-btn-holder text-center mt-3">
                    <button class="btn btn-primary" type="submit">
                    Add Item
                    <i class="material-icons">send</i>
                    </button>
                </div>
                <!--[form-button-end]-->
            </form>
            <!--[form-end]-->
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
