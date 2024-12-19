<script src="{{ asset('adminLTE3/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- DataTables -->
<script src="{{ asset('adminLTE3/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('adminLTE3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('adminLTE3/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('adminLTE3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('adminLTE3/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('adminLTE3/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminLTE3/dist/js/moment.min.js')}}"></script>
<script src="{{ asset('adminLTE3/dist/js/adminlte.min.js')}}"></script>
<script src="{{ asset('adminLTE3/dist/js/chart.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminLTE3/dist/js/demo.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="{{ asset('adminLTE3/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script>
      $(function () {
        //Date picker
        $('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
        })
      });
      $("#tab_2").click(function() {
        console.log('tab2')
        $("li.active").removeClass("active");
        $(this).addClass("active");
      })
</script>
