
<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admin.includes.head')
        @yield('stylesheet')
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

        @yield('script')
   
    </body>
</html>