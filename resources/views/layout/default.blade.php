<!DOCTYPE html>
    <!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        <!-- Vendor CSS -->

        <link href="{{URL::asset('vendors/bower_components/animate.css/animate.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css')}}" rel="stylesheet">
        <link href="{{URL::asset('vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendors/bootgrid/jquery.bootgrid.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('vendors/bower_components/chosen/chosen.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}">
        <!-- color picker -->
        <link href="{{URL::asset('css/spectrum.css')}}" rel="stylesheet">
        <!-- switch -->
        <link href="{{URL::asset('css/bootstrap-switch.min.css')}}" rel="stylesheet">

        <!-- CSS -->
        <link href="{{URL::asset('css/app.min.1.css')}}" rel="stylesheet">
        <link href="{{URL::asset('css/app.min.2.css')}}" rel="stylesheet">
    </head>

    <body>
        <header id="header" class="clearfix" data-current-skin="blue">
            @include('layout.header')
        </header>

        <section id="main">
            <aside id="sidebar" class="sidebar c-overflow mCustomScrollbar _mCS_1 mCS-autoHide">
                <div class="profile-menu">
                    <a href="">
                        <div class="profile-pic">
                            <img src="{{URL::asset('img/profile-pics/1.jpg')}}" alt="">
                        </div>

                        <div class="profile-info">
                            {{$user->name}}
                            <i class="zmdi zmdi-caret-down"></i>
                        </div>
                    </a>

                    <ul class="main-menu">
                        <li>

                            <a href="{{URL::to('/logout')}}"><i class="zmdi zmdi-directions-run"></i>登出</a>

                        </li>
                    </ul>
                </div>

                <ul class="main-menu">
                    <li {{ (\Request::path() == 'account/*') ? "class=active" : '' }}><a href="{{Url::to('account/list')}}"><i class="zmdi zmdi-key"></i> 後台帳號管理</a></li>
                    <li {{ (\Request::path() == 'purchase/*') ? "class=active" : '' }}><a href="{{Url::to('purchase/list')}}"><i class="zmdi zmdi-local-shipping"></i> 進貨管理</a></li>
                    <li {{ (\Request::path() =='inventory/*') ? "class=active" : '' }}><a href="{{Url::to('inventory')}}"><i class="zmdi zmdi-search"></i> 庫存查詢</a></li>
                    <li {{ (\Request::path() == '') ? "class=active" : '' }}><a href="{{Url::to('order/list')}}"><i class="zmdi zmdi-collection-text"></i> 訂單管理</a></li>
                    <li  class="{{{ (Request::is('projects/*',\Request::path())) ? ' active toggled' :''}}} sub-menu">
                        <a href=""><i class="zmdi zmdi-view-compact"></i> 基本資料管理</a>
                        <ul>
                            <li {{ (\Request::path()== '') ? "class=active" : '' }}><a href="{{Url::to('product/list')}}"> 商品管理</a></li>
                            <li {{ (\Request::path()== '') ? "class=active" : '' }}><a href="{{Url::to('student/list')}}"> 學生管理</a></li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <section id="content">
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
                @yield('content')
            </section>
        </section>

        <footer id="footer">
            @include('layout.footer')
        </footer>
        <!-- Page Loader -->
        <div class="page-loader">
            <div class="preloader pls-blue">
                <svg class="pl-circular" viewBox="25 25 50 50">
                    <circle class="plc-path" cx="50" cy="50" r="20" />
                </svg>

                <p>頁面載入中，請稍候...</p>
            </div>
        </div>
        <!-- Javascript Libraries -->
        <script src="{{URL::asset('vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{URL::asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{URL::asset('vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
        <script src="{{URL::asset('vendors/bower_components/Waves/dist/waves.min.js')}}"></script>
        <script src="{{URL::asset('vendors/bootstrap-growl/bootstrap-growl.min.js')}}"></script>
        <script src="{{URL::asset('vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js')}}"></script>
        <script src="{{URL::asset('vendors/bower_components/moment/min/moment.min.js')}}"></script>
        <script src="{{URL::asset('vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
        <script src="{{asset('vendors/input-mask/input-mask.min.js')}}"></script>

        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->
        <script src="{{URL::asset('vendors/bower_components/chosen/chosen.jquery.min.js')}}"></script>
        <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
        <script src="{{URL::asset('js/functions.js')}}"></script>
        <script src="{{URL::asset('js/demo.js')}}"></script>
        <script src="{{URL::asset('js/moment.min.js')}}"></script>
        <script src="{{URL::asset('js/jquery.ba-dotimeout.js')}}"></script>
        <script src="{{URL::asset('js/bootstrap-switch.min.js')}}"></script>
        @yield('script')
        <script>
            function notify(message, type){
                $.growl({
                    message: message
                },{
                    type: type,
                    allow_dismiss: false,
                    label: 'Cancel',
                    className: 'btn-xs btn-inverse',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    delay: 2500,
                    animate: {
                            enter: 'animated fadeIn',
                            exit: 'animated fadeOut'
                    },
                    offset: {
                        x: 20,
                        y: 85
                    }
                });
            };
            $(document).ready(function(){
                jQuery.validator.addMethod("greaterThan",
                function(value, element, params) {

                    if (!/Invalid|NaN/.test(new Date(value))) {
                        return new Date(value) < new Date($(params).val());
                    }

                    return isNaN(value) && isNaN($(params).val())
                        || (Number(value) < Number($(params).val()));
                },'日期必須大於 {0}.');
                jQuery.validator.addMethod("lessThan",
                function(value, element, params) {

                    if (!/Invalid|NaN/.test(new Date(value))) {
                        return new Date(value) > new Date($(params).val());
                    }

                    return isNaN(value) && isNaN($(params).val())
                        || (Number(value) > Number($(params).val()));
                },'日期必須大於 {0}.');
            });
        </script>
    </body>
</html>
