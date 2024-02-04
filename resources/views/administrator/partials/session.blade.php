@if (session('success'))
    <div class="toast-body hide" style="position: fixed; z-index: 1; right: 0; top: 5rem;" id="notif">
        <div class="bg-white shadow">
            <div class="alert alert-success">
                <div class="d-flex justify-content-start">
                    <span class="alert-icon m-r-20 font-size-30">
                        <i class="anticon anticon-check-circle"></i>
                    </span>
                    <div>
                        <h5 class="alert-heading">{{ session('type') }}</h5>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif (session('error'))
    <div class="toast-body hide" style="position: fixed; z-index: 1; right: 0; top: 5rem;" id="notif">
        <div class="bg-white shadow">
            <div class="alert alert-danger">
                <div class="d-flex justify-content-start">
                    <span class="alert-icon m-r-20 font-size-30">
                        <i class="anticon anticon-close-circle"></i>
                    </span>
                    <div>
                        <h5 class="alert-heading">{{ session('type') }}</h5>
                        <p>{{ session('error') }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
