@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("users_tb/add");
    $can_edit = $user->can("users_tb/edit");
    $can_view = $user->can("users_tb/view");
    $can_delete = $user->can("users_tb/delete");
    $pageTitle = "Users Tb Details";
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
                            <div class="h5 font-weight-bold text-primary">Users Tb Details</div>
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
                            $rec_id = ($data['user_id'] ? urlencode($data['user_id']) : null);
                            $counter++;
                        ?>
                        <div id="page-main-content" class="">
                            <div class="row">
                                <div class="col">
                                    <!-- Table Body Start -->
                                    <div class="page-data">
                                        <!--PageComponentStart-->
                                        <div class="border-top td-user_id p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> User Id</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['user_id'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-matric_no p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Matric No</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['matric_no'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-firstname p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Firstname</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['firstname'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-lastname p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Lastname</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['lastname'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-email p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Email</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['email'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-phone p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Phone</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['phone'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-department p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Department</div>
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
                                                <div class="text-muted"> Level</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['level'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-status p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Status</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['status'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-email_link p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Email Link</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['email_link'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-email_comfirm p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Email Comfirm</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['email_comfirm'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-email_token p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Email Token</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['email_token'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-reg_date p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Reg Date</div>
                                                <div class="font-weight-bold">
                                                    <span title="<?php echo human_datetime($data['reg_date']); ?>" class="has-tooltip">
                                                    <?php echo relative_date($data['reg_date']); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-gender p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Gender</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['gender'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-deleted p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Deleted</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['deleted'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-photo p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Photo</div>
                                                <div class="font-weight-bold">
                                                    <?php 
                                                        Html :: page_img($data['photo'],400,400, "", "", 1); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-email_verified_at p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Email Verified At</div>
                                                <div class="font-weight-bold">
                                                    <span title="<?php echo human_datetime($data['email_verified_at']); ?>" class="has-tooltip">
                                                    <?php echo relative_date($data['email_verified_at']); ?>
                                                    </span>
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
