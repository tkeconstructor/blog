
<!DOCTYPE html>
<html lang="en">
    <head>
        @include('lecturer.includes.head')
        @yield('stylesheet')
    </head>
    <body>

        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            @include('lecturer.includes.header')
        </nav>

        <!-- Begin Body -->
        <div id="wrapper" class="container-fluid">

            <!-- side bar -->
                <div id="sidebar-wrapper">
                    @include('lecturer.includes.sidebar')
                </div>

            <!-- content -->
                <div id="page-content-wrapper">
                    @yield('content')

                </div>
        </div>

        <!-- script references -->

        <div>
            @include('lecturer.includes.footer')
        </div>

        @yield('script')
   
    </body>
</html>