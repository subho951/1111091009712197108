<div class="logo text-center"><img src="<?= env('FRONT_ASSETS_URL') ?>images-omdayal/logo-om-dayal.png"></div>
<h6 class="fw-bold pt-2 pb-2 text-dark text-center"><i class="fa fa-lock"></i> Validate OTP</h6>
<div class="card shadow">
    <div class="card-body pt-4 pb-4">
        @if(session('success_message'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show autohide" role="alert">
            {{ session('success_message') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('error_message'))
        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show autohide" role="alert">
            {{ session('error_message') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form method="POST" action="">
            @csrf
            <input type="hidden" name="id" value="<?= $id ?>">
            <!-- Email -->
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="otp1" id="otp1" placeholder="One Time Pasword (OTP)" minlength="4" maxlength="4" onkeypress="return isNumber(event)" autocomplete="off" required>
                <label for="email">One Time Pasword (OTP)</label>
            </div>
            <!-- Button -->
            <button class="btn btn-danger bg-gradient w-100" type="submit">Validate</button>
        </form>
    </div>
</div>

<div class="p-4">&nbsp;</div>
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>