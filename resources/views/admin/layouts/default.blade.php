
<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admin.includes.head')
        @yield('stylesheet')
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
    </head>
    <body>

        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            @include('admin.includes.header')
        </nav>

        <!-- Begin Body -->
        <div id="wrapper" class="container-fluid">

            <!-- side bar -->
                <div id="sidebar-wrapper">
                    @include('admin.includes.sidebar')
                </div>

            <!-- content -->
                <div id="page-content-wrapper">
                    @yield('content')

                </div>
        </div>

        <!-- script references -->

        <div>
            @include('admin.includes.footer')
        </div>

        <script src="{{URL::asset('js/jquery-ui.min.js')}}"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function getConfirm(url, alert) {
                if (arguments[0] != null) {
                    if (window.confirm(alert)) {
                        location.href = url;
                    }
                    else {
                        event.cancelBubble = true;
                        event.returnValue = false;
                        return false;
                    }
                }
                else {
                    return false;
                }
                return;
            }
        </script>
        @yield('script')
    </body>
</html>