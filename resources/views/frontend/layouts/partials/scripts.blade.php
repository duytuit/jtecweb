<!-- Plugins JS File -->
<script src="{{ asset('public/assets/common/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/assets/common/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('public/assets/frontend/js/frontend-main.js') }}"></script>
<script>
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>

