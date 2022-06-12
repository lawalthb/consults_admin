@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("users_tb/add");
    $can_edit = $user->can("users_tb/edit");
    $can_view = $user->can("users_tb/view");
    $can_delete = $user->can("users_tb/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $department_id_option_list = $comp_model->department_id_option_list();
    $level_option_list = $comp_model->level_option_list();
    $pageTitle = "customers";
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
                            <div class="h5 font-weight-bold text-primary">Customer List</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("users_tb/add") ?>" >
                    <i class="material-icons">add</i>                               
                    Add New Customer 
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
            <div class="col-md-4 comp-grid" >
                <div class="dropdown">
                    <button class="btn btn-block btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Department
                    </button>
                    <div class="dropdown-menu" >
                        <?php 
                            $options = $department_id_option_list ?? [];
                            foreach($options as $option){
                            $value = $option->value;
                            $label = $option->label;
                            $nav_link = add_query_params(['users_tb_department' => $value]);
                        ?>
                        <a class="dropdown-item <?php echo is_active_link('users_tb_department', $value); ?>" href="<?php print_link($nav_link) ?>">
                        <?php echo $label; ?>
                    </a>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 comp-grid" >
            <div class="dropdown">
                <button class="btn btn-block btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Level
                </button>
                <div class="dropdown-menu" >
                    <?php 
                        $options = $level_option_list ?? [];
                        foreach($options as $option){
                        $value = $option->value;
                        $label = $option->label;
                        $nav_link = add_query_params(['users_tb_level' => $value]);
                    ?>
                    <a class="dropdown-item <?php echo is_active_link('users_tb_level', $value); ?>" href="<?php print_link($nav_link) ?>">
                    <?php echo $label; ?>
                </a>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-4 comp-grid" >
        <div class="dropdown">
            <button class="btn btn-block btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Gender
            </button>
            <div class="dropdown-menu" >
                <?php
                    $options = Menu::users_tb_gender();
                    if(!empty($options)){
                    foreach($options as $option){
                    $value = $option['value'];
                    $label = $option['label'];
                    $nav_link = add_query_params(array('users_tb_gender' => $value ) , false);
                    $is_active = is_active_link('users_tb_gender', $value);
                ?>
                <a class="dropdown-item <?php echo $is_active; ?>" href="<?php print_link($nav_link) ?>">
                <?php echo $label ?>
            </a>
            <?php
                }
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
        <div class="row ">
            <div class="col-md-12 comp-grid" >
                <?php Html::display_page_errors($errors); ?>
                <div class="filter-tags mb-2">
                    <?php
                        Html::filter_tag('users_tb_department', 'Department', $department_id_option_list);
                    ?>
                    <?php
                        Html::filter_tag('users_tb_level', 'Level', $level_option_list);
                    ?>
                    <?php
                        Html::filter_tag('users_tb_gender', 'Gender', Menu::users_tb_gender());
                    ?>
                </div>
                <div class=" "><?php
                    $sn = 0;
                ?>
            </div>
            <div  class=" page-content" >
                <div id="users_tb-list-records">
                    <div class="row">
                        <div class="col">
                            <div id="page-main-content" class="table-responsive">
                                <table class="table table-hover table-striped table-sm text-left">
                                    <thead class="table-header ">
                                        <tr>
                                            <th class="td-#Template#SN" > SN</th>
                                            <th class="td-firstname" > Firstname</th>
                                            <th class="td-lastname" > Lastname</th>
                                            <th class="td-email" > Email</th>
                                            <th class="td-matric_no" > Matric No</th>
                                            <th class="td-phone" > Phone</th>
                                            <th class="td-gender" > Gender</th>
                                            <th class="td-department" > Department</th>
                                            <th class="td-level" > Level</th>
                                            <th class="td-status" > Status</th>
                                            <th class="td-reg_date" > Reg Date</th>
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
                                            foreach($records as $index => $data){
                                            $rec_id = ($data['user_id'] ? urlencode($data['user_id']) : null);
                                            $counter++;
                                        ?>
                                        <tr>
                                            <!--PageComponentStart-->
                                            <td class="td-#Template#SN"><span>{{$index + $records->firstItem()}}</span></td>
                                            <td class="td-firstname">
                                                <?php echo  $data['firstname'] ; ?>
                                            </td>
                                            <td class="td-lastname">
                                                <?php echo  $data['lastname'] ; ?>
                                            </td>
                                            <td class="td-email">
                                                <a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a>
                                            </td>
                                            <td class="td-matric_no">
                                                <?php echo  $data['matric_no'] ; ?>
                                            </td>
                                            <td class="td-phone">
                                                <a href="<?php print_link("tel:$data[phone]") ?>"><?php echo $data['phone']; ?></a>
                                            </td>
                                            <td class="td-gender">
                                                <?php echo  $data['gender'] ; ?>
                                            </td>
                                            <td class="td-department">
                                                <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("departments_tb//" . urlencode($data['department'])) ?>">
                                                <?php echo $data['departments_tb_name'] ?>
                                            </a>
                                        </td>
                                        <td class="td-level">
                                            <?php echo  $data['level'] ; ?>
                                        </td>
                                        <td class="td-status">
                                            <?php echo  $data['status'] ; ?>
                                        </td>
                                        <td class="td-reg_date">
                                            <?php echo  $data['reg_date'] ; ?>
                                        </td>
                                        <!--PageComponentEnd-->
                                        <td class="td-btn">
                                            <div class="dropdown" >
                                                <button data-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                <i class="material-icons">menu</i> 
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php if($can_view){ ?>
                                                    <a class="dropdown-item "   href="<?php print_link("users_tb/view/$rec_id"); ?>">
                                                    <i class="material-icons">visibility</i> View
                                                </a>
                                                <?php } ?>
                                                <?php if($can_edit){ ?>
                                                <a class="dropdown-item "   href="<?php print_link("users_tb/edit/$rec_id"); ?>">
                                                <i class="material-icons">edit</i> Edit
                                            </a>
                                            <?php } ?>
                                            <?php if($can_delete){ ?>
                                            <a class="dropdown-item record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal" href="<?php print_link("users_tb/delete/$rec_id"); ?>">
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
                            <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("users_tb/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
</style><style>
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
<script>
	/*
	* Page Custom Javascript | Jquery codes
	*/

	//$(document).ready(function(){
	//	
	//});
</script>

@endsection
