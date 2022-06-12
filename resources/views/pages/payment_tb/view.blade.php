@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("payment_tb/add");
    $can_edit = $user->can("payment_tb/edit");
    $can_view = $user->can("payment_tb/view");
    $can_delete = $user->can("payment_tb/delete");
    $pageTitle = "Payment Tb Details";
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
                            <div class="h5 font-weight-bold text-primary">Payment Tb Details</div>
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
                            $rec_id = ($data['payment_id'] ? urlencode($data['payment_id']) : null);
                            $counter++;
                        ?>
                        <div id="page-main-content" class="">
                            <div class="row">
                                <div class="col">
                                    <!-- Table Body Start -->
                                    <div class="page-data">
                                        <!--PageComponentStart-->
                                        <div class="border-top td-payment_id p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Payment Id</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['payment_id'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-vendor_id p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Vendor Id</div>
                                                    <div class="font-weight-bold">
                                                        <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("vendors_tb/view/" . urlencode($data['vendor_id'])) ?>">
                                                        <i class="material-icons">visibility</i> <?php echo "Vendors Tb Detail" ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-amount_in p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Amount In</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['amount_in'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-amount_out p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Amount Out</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['amount_out'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-amount_balance p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Amount Balance</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['amount_balance'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-reg_date p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Reg Date</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['reg_date'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-cmment p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Cmment</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['cmment'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-date p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Date</div>
                                                <div class="font-weight-bold">
                                                    <span title="<?php echo human_datetime($data['date']); ?>" class="has-tooltip">
                                                    <?php echo relative_date($data['date']); ?>
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
                                                <a class="dropdown-item "   href="<?php print_link("payment_tb/edit/$rec_id"); ?>">
                                                <i class="material-icons">edit</i> Edit
                                            </a>
                                            <?php } ?>
                                            <?php if($can_delete){ ?>
                                            <a class="dropdown-item record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal" href="<?php print_link("payment_tb/delete/$rec_id"); ?>">
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
