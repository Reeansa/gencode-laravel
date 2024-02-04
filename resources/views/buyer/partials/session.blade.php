@if (session()->has('success'))
    <div class="d-flex align-items-center justify-content-center mt-5 text-center shadow"
        style="position: fixed; z-index: 1; right: 2rem; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);">
        <div id="notification" class="alert alert-success" role="alert">
            <strong>{{ session()->get('success') }}</strong>
        </div>
    </div>
@elseif(session()->has('error'))
    <div class="d-flex align-items-center justify-content-center mt-5 text- shadow"
        style="position: fixed; z-index: 1; right: 2rem; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);">
        <div id="notification" class="alert alert-danger" role="alert">
            <strong>{{ session()->get('error') }}</strong>
        </div>
    </div>
@endif
@push('scripts')
    <script>
        setTimeout(function() {
            document.getElementById('notification').style.display = 'none';
        }, 5000);
    </script>
@endpush
