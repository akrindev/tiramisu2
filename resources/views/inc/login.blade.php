<div class="nav-item d-md-flex dropdown">
    <div class="btn btn-sm btn-primary" data-toggle="dropdown">
        <i class="fe fe-log-in"></i>

        Login
    </div>

    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow text-center">
        <a href="#" class="dropdown-item text-center text-muted-dark">Login With</a>
        <div class="dropdown-divider"></div>

            <a href="{{ url('/') }}/google-login" class="btn btn-sm btn-danger" id="login-btn-google"><i class="fe fe-award"></i> Google</a>

            {{-- <a href="{{ url('/') }}/fb-login" class="btn btn-sm btn-primary" id="login-btn"><i
                    class="fe fe-facebook"></i> Facebook</a> --}}

            <a href="{{ url('/') }}/tw-login" class="btn btn-sm btn-outline-primary" id="login-btn-tw"><i
                    class="fe fe-twitter"></i> Twitter</a>
    </div>
</div>
