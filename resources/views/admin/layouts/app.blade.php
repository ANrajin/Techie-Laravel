<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Techie Admin</title>

    {{-- css --}}
    @include('assets.admin.styles')
  </head>

  <body>
    <!-- ########## START: LEFT PANEL ########## -->
    @include('admin.components.leftSideBar')
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    @include('admin.components.header')
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    @include('admin.components.rightSideBar')
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        {{-- Active Page --}}
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Techie</a>
          <span class="breadcrumb-item active">
              @yield('ActivePage')
          </span>
        </nav>
  
        {{-- Page Body Content --}}
        <div class="sl-pagebody">
            @yield('content')  
        </div>

        {{-- Page Footer --}}
        <footer class="sl-footer">
            @include('admin.components.footer')
        </footer>
    </div>
    <!-- ########## END: MAIN PANEL ########## -->
    {{-- js --}}
    @include('assets.admin.scripts')
  </body>
</html>