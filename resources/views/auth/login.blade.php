<!DOCTYPE html>
    <!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>雜貨店管理系統</title>

        <!-- Vendor CSS -->
        <link href="{{asset('vendors/bower_components/animate.css/animate.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}" rel="stylesheet">

        <!-- CSS -->
        <link href="{{asset('css/app.min.1.css')}}" rel="stylesheet">
        <link href="{{asset('css/app.min.2.css')}}" rel="stylesheet">
    </head>

	<body class="login-content">
        <div class="lc-block toggled" id="l-login">
			<div class="m-b-20">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

				<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label class="col-md-4 control-label">帳號</label>
						<div class="col-md-6">
							<input type="account" class="form-control" name="account" value="{{ old('account') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">密碼</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<div class="">
								<input type="checkbox" id="remember" name="remember">
								<label for="remember">
								 	記住我的登入資訊
								</label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">登入</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>

