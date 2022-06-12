@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->can("order_tb/add");
    $can_edit = $user->can("order_tb/edit");
    $can_view = $user->can("order_tb/view");
    $can_delete = $user->can("order_tb/delete");
    $pageTitle = "Order Tb Details";
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
                            <div class="h5 font-weight-bold text-primary">Order Tb Details</div>
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
                            $rec_id = ($data['order_id'] ? urlencode($data['order_id']) : null);
                            $counter++;
                        ?>
                        <div id="page-main-content" class="">
                            <div class="row">
                                <div class="col">
                                    <!-- Table Body Start -->
                                    <div class="page-data">
                                        <!--PageComponentStart-->
                                        <div class="border-top td-order_no p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Order No</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['order_no'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-matric_no p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Users Tb Matric No</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['users_tb_matric_no'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-firstname p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Users Tb Firstname</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['users_tb_firstname'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-lastname p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Users Tb Lastname</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['users_tb_lastname'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-email p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Users Tb Email</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['users_tb_email'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-level p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Users Tb Level</div>
                                                    <div class="font-weight-bold">
                                                        <?php echo  $data['users_tb_level'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top td-department p-2">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="text-muted"> Department</div>
                                                    <div class="font-weight-bold">
                                                        <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("departments_tb//" . urlencode($data['department'])) ?>">
                                                        <?php echo $data['users_tb_department'] ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-rate p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Rate</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['rate'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-qty p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Qty</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['qty'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-total_amount p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Total Amount</div>
                                                <div class="font-weight-bold">
                                                    <?php echo  $data['total_amount'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top td-product_id p-2">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-muted"> Product Id</div>
                                                <div class="font-weight-bold">
                                                    <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("products_tb/view/" . urlencode($data['product_id'])) ?>">
                                                    <i class="material-icons">visibility</i> <?php echo "Products Tb Detail" ?>
                                                </a>
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
                            <div class="border-top td-user_id p-2">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="text-muted"> User Id</div>
                                        <div class="font-weight-bold">
                                            <a size="sm" class="btn btn-sm btn btn-link page-modal" href="<?php print_link("users_tb/view/" . urlencode($data['user_id'])) ?>">
                                            <i class="material-icons">visibility</i> <?php echo "Users Tb Detail" ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top td-mat_no p-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-muted"> Mat No</div>
                                    <div class="font-weight-bold">
                                        <?php echo  $data['mat_no'] ; ?>
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
                        <div class="border-top td-tmt p-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-muted"> Amount in words</div>
                                    <div class="font-weight-bold">
                                        <?php echo number_to_words( $data['tmt'] , 'en'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--PageComponentEnd-->
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
