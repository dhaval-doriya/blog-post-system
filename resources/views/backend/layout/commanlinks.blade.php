<!-- jQuery  -->
<script src="{{ asset('assets/dashboard/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/dashboard/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/dashboard/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
</script>
<!-- Summernote -->
<script src="{{ asset('assets/dashboard/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dashboard/dist/js/adminlte.min.js') }}"></script>
<!-- CodeMirror -->
<script src="{{ asset('assets/dashboard/plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/codemirror/mode/css/css.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/codemirror/mode/xml/xml.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>

<!-- jquery validtion cdn  -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


<!-- other cdns  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable-min.js"
    integrity="sha512-9pm50HHbDIEyz2RV/g2tn1ZbBdiTlgV7FwcQhIhvykX6qbQitydd6rF19iLmOqmJVUYq90VL2HiIUHjUMQA5fw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.min.js"
    integrity="sha512-GJa/LjpGK81b9EeizDHN9K25l9H6bDAz2v4Ga6FnkFjNlAMVtMh6RbeAdUH94qY3KlggKGi9YfCkwGptnjjDkA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- //select 2 data  -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- toaster js  --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

{{-- toastr js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>



<script src="{{ asset('assets/custom_js/table.js') }}"></script>

<script src="{{ asset('assets/custom_js/comman.js') }}"></script>



<!-- sweet alert   -->
@if (Session::has('message'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'success',
                title: "{{ Session::get('message') }}",
                showConfirmButton: false,
                timer: 1600
            })
        })
    </script>
    @php
        Session::forget('message');
    @endphp
@endif

@if (Session::has('error'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'error',
                title: "{{ Session::get('error') }}",
                showConfirmButton: false,
                timer: 1500
            })
        })
    </script>
    @php
        Session::forget('error');
    @endphp
@endif

@if (Session::has('info'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'info',
                title: "{{ Session::get('info') }}",
                showConfirmButton: false,
                timer: 1500
            })
        })
    </script>
    @php
        Session::forget('info');
    @endphp
@endif

@if (Session::has('warning'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'warning',
                title: "{{ Session::get('warning') }}",
                showConfirmButton: false,
                timer: 1500
            })
        })
    </script>
    @php
        Session::forget('warning');
    @endphp
@endif
