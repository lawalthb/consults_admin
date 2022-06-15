        @inject('comp_model', 'App\Models\ComponentsData')
        <?php 
            $pageTitle = "OGITECH CONSULTS - ADMIN";
        ?>
        @extends($layout)
        @section('title', $pageTitle)
        @section('content')
        <div>
            <div  class="mb-3" >
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-sm-6 col-md-4 col-lg-3 comp-grid" >
                            <div class=" card-7 mt-5 bg-light"><div class="h4 font-weight-bold text-primary text-center">
                                <img src="{{ asset('images/logo.png') }}" width="50px" height="50px" class="img-fluid rounded-circle" /> 
                                Admin Login
                            </div>
                        </div>
                        <div  class="card-7 page-content" >
                            
                            <div>
                                @if($errors->any())
                                <div class="alert alert-danger animated bounce">{{ $errors->first() }}</div>
                                @endif
                                <form name="loginForm" action="{{ route('auth.login') }}" class="needs-validation form page-form" method="post">
                                    @csrf
                                    <div class="input-group form-group">
                                        <input placeholder="Username Or Email" name="username"  required="required" class="form-control" type="text"  />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="form-control-feedback material-icons">account_circle</i></span>
                                        </div>
                                    </div>
                                    <div class="input-group form-group">
                                        
                                        <input  placeholder="Password" required="required" name="password" class="form-control " type="password" />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="form-control-feedback material-icons">lock</i></span>
                                        </div>
                                    </div>
                                    <div class="row clearfix mt-3 mb-3">
                                        <div class="col-6">
                                            <label class="">
                                            <input value="true" type="checkbox" name="rememberme" />
                                            Remember Me
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('password.forgotpassword') }}" class="text-danger"> Reset Password?</a>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary btn-block btn-md" type="submit"> 
                                        <i class="load-indicator">
                                        <clip-loader :loading="loading" color="#fff" size="20px"></clip-loader> 
                                        </i>
                                        Login <i class="material-icons">lock_open</i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('pagecss')
    <style></style>
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
    