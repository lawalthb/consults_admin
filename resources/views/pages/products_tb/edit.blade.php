@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Edit Products Tb";
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="card-4 bg-light mb-3" >
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto " >
                    <div class="row  q-col-gutter-sm q-px-sm" >
                        <div class="col">
                            <div class="h5 font-weight-bold text-primary">Edit Products Tb</div>
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
                        <div class="row">
                            <div class="col">
                                <!--[form-start]-->
                                <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("products_tb/edit/$rec_id"); ?>" method="post">
                                <!--[form-content-start]-->
                                @csrf
                                <div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="product_name">Product Name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div id="ctrl-product_name-holder" class=" ">
                                                    <input id="ctrl-product_name"  value="<?php  echo $data['product_name']; ?>" type="text" placeholder="Enter Product Name"  required="" name="product_name"  class="form-control " />
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
                                                        $selected = ( $value == $data['vendor_id'] ? 'selected' : null );
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
                                                    <input id="ctrl-sell_rate"  value="<?php  echo $data['sell_rate']; ?>" type="number" placeholder="Enter Selling Rate" step="1"  required="" name="sell_rate"  class="form-control " />
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
                                                    <input id="ctrl-purchase_rate"  value="<?php  echo $data['purchase_rate']; ?>" type="number" placeholder="Enter Purchase Rate" step="0.1"  required="" name="purchase_rate"  class="form-control " />
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
                                                        $arr_recs = explode(',', $data['level']);
                                                        foreach($options as $option){
                                                        $value = $option->value;
                                                        $label = $option->label ?? $value;
                                                        $checked = (in_array($value , $arr_recs) ? 'checked' : null);
                                                    ?>
                                                    <label class="custom-control custom-checkbox custom-control-inline option-btn">
                                                    <input class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value; ?>" type="checkbox"  name="level[]"  />
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
                                                        $selected = ( $value == $data['department_id'] ? 'selected' : null );
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
                                                    <input id="ctrl-vendor_email"  value="<?php  echo $data['vendor_email']; ?>" type="text" placeholder="Enter Vendor Email" list="vendor_email-datalist"  data-load-path="<?php print_link('componentsdata/vendor_email_option_list') ?>" name="vendor_email"  class="form-control " />
                                                    <datalist id="vendor_email-datalist">
                                                    <?php
                                                        $options = $comp_model->vendor_email_option_list($data['vendor_id']) ?? [];
                                                        foreach($options as $option){
                                                        $value = $option->value;
                                                        $label = $option->label ?? $value;
                                                    ?>
                                                    <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                    </datalist> 
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
                                                    <input id="ctrl-description"  value="<?php  echo $data['description']; ?>" type="text" placeholder="Enter Description / Semester"  required="" name="description"  class="form-control " />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="status">Status <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div id="ctrl-status-holder" class=" ">
                                                    <input id="ctrl-status"  value="<?php  echo $data['status']; ?>" type="number" placeholder="Enter Status" step="any"  required="" name="status"  class="form-control " />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-ajax-status"></div>
                                <!--[form-content-end]-->
                                <!--[form-button-start]-->
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit">
                                    Update
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
