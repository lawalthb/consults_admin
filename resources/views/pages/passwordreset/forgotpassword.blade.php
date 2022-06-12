@extends('layouts.info')
@section('content')
<div class="container mt-4">
	<div class="row">
		<div class="col-md-6">
			<div class="card-1">
				<div>
					<h3>Password Reset </h3>
					<div class="text-muted">
						Please provide the valid email address you used to register
					</div>
				</div>
				<hr />
				@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
				@endif
				<form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
					@csrf
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<input type="text" class="form-control" id="email" name="email" placeholder="Email" />
					</div>
					@if ($errors->has('email'))
					<div class="alert alert-danger animated bounce">{{ $errors->first('email') }}</div>
					@endif
					<div>
						<button class="btn btn-success" type="submit"> Send <i class="material-icons">email</i></button>
					</div>
				</form>
				<br />
				<div class="text-info">
					A link will be sent to your email containing the information you need for your password
				</div>
			</div>
		</div>
	</div>

</div>
@endsection