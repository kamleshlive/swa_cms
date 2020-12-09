<!DOCTYPE html>
<html>
  <head>
    {{-- <meta charset="UTF-8"> --}}
    <title>{{ $page_title or "SWA Admin Pannel" }}</title>

    {{-- <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"> --}}

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/bower_components/admin-lte/bootstrap/dist/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/plugins/datepicker/datepicker3.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset("/bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    {{-- <link href="http://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet"> --}}
    {{-- <style>
        @font-face {
            font-family: 'Noto Sans', sans-serif;
            font-style: normal;
            font-weight: 400;
        }
    </style> --}}
  </head>
  <body class="skin-blue">
    <div class="wrapper">

      <!-- Header -->
      @include('includes/header')



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>

            <small>{{ $page_description or null }}</small>
          </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            @if(Session::has('flash_message'))
            <div class="callout {{ Session::get('alert-class', 'alert-info') }}">
              <p>{{ Session::get('flash_message') }}</p>
              @php Session::forget('flash_message') @endphp
            </div>
            
            @endif
      
          <!-- Your Page Content Here -->
          @yield('content')
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Footer -->
      @include('includes/footer')

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->


<script src="{{ asset ("/js/jquery-3.3.1.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/dist/js/adminlte.js") }}"></script>
<script src="{{ asset ("/bower_components/moment/min/moment.min.js") }}"></script>



<!-- Bootstrap 3.3.2 JS -->

<script src="{{ asset ('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="http://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script src="http://cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="http://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
<script src="http://cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
<script src="http://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
<script src="http://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="{{asset("/plugins/datepicker/bootstrap-datepicker.js")}}"></script>
@yield('scripts')
    <script type="text/javascript">
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $("body").on("click",".copyLink", function(event){
          // console.log('asdasdasdas');
        event.preventDefault();
        var link = $(this).data('link');
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(link).select();
        document.execCommand("copy");
        $temp.remove();
        alert('Link Copied!!');
    });

    </script>
  </body>
</html>
