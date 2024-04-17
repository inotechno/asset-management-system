<script src="{{ asset('libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    function notification(type, message) {
        Swal.fire({
            icon: type,
            title: message,
            showConfirmButton: !1,
            timer: 3000,
        });
    }
</script>
@if ($message = Session::get('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "{{ $message }}",
            showConfirmButton: !1,
            timer: 3000,
        });
    </script>
@endif

@if ($message = Session::get('error'))
    <script>
        Swal.fire({
            icon: "error",
            title: "{{ $message }}",
            showConfirmButton: !1,
            timer: 3000,
        });
    </script>
@endif
