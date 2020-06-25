<!--   Argon JS   -->

<script src="{{mix('js/admin.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<script src="https://use.fontawesome.com/30a289ffff.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://unpkg.com/leaflet-search@2.3.7/dist/leaflet-search.src.js"></script>
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>
<script>
    $(document).ready(function() {
      toastr.options = {
          "positionClass" : "toast-top-center",
          "closeButton" : true,
          "debug" : false,
          "newestOnTop" : true,
          "progressBar" : true,
          "preventDuplicates" : false,
          "onclick" : null,
          "showDuration" : "300",
          "hideDuration" : "1000",
          "timeOut" : "5000",
          "extendedTimeOut" : "1000",
          "showEasing" : "swing",
          "hideEasing" : "linear",
          "showMethod" : "fadeIn",
          "hideMethod" : "fadeOut"
      }

      @if(Session::has('success'))
          toastr['success']("{{ Session::get('success') }}")
      @endif
          @if(Session::has('warning'))
          toastr['warning']("{{ Session::get('warning') }}")
      @endif
          @if(Session::has('error'))
          toastr['error']("{{ Session::get('error') }}")
      @endif
  });
 $(document).ready(function() {
    $('#dataTable').DataTable();
    $(function() {
            $('#daterangepicker').daterangepicker({
                opens: 'right',
            }, function(start, end, label) {
            });
    });

});

</script>