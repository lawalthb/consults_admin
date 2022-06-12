@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Item Available for ";
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
                            <div class="h5 font-weight-bold text-primary">Add New Product Departments</div>
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
                        <form id="product_departments-add-form"  novalidate role="form" enctype="multipart/form-data" class="form multi-form page-form" action="{{ route('product_departments.store') }}" method="post" >
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
                                            <input id="ctrl-product_id-row<?php echo $row; ?>"  value="<?php echo get_value('product_id') ?>" type="hidden" placeholder="Enter Product Id" list="product_id_list"  name="row[<?php echo $row ?>][product_id]"  class="form-control " />
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
                                                <select required=""  id="ctrl-department_id-row<?php echo $row; ?>" name="row[<?php echo $row ?>][department_id]"  placeholder="Select a value ..."    class="custom-select" >
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
                                <input id="ctrl-product_id-row<?php echo $row; ?>"  value="<?php echo get_value('product_id') ?>" type="hidden" placeholder="Enter Product Id" list="product_id_list"  name="row[<?php echo $row ?>][product_id]"  class="form-control " />
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
                                    <select required=""  id="ctrl-department_id-row<?php echo $row; ?>" name="row[<?php echo $row ?>][department_id]"  placeholder="Select a value ..."    class="custom-select" >
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
                <!--[form-button-start]-->
                <div class="form-group form-submit-btn-holder text-center mt-3">
                    <button class="btn btn-primary" type="submit">
                    Submit
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
