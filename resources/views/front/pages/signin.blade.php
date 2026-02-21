<div class="logo text-center"><img src="<?= env('FRONT_ASSETS_URL') ?>images-omdayal/logo-om-dayal.png"></div>
<h6 class="fw-bold pt-2 pb-2 text-dark text-center"><i class="fa fa-lock"></i> Secured Login</h6>
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
            <!-- Email -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Mobile Number (Username)" minlength="10" maxlength="10" onkeypress="return isNumber(event)" autocomplete="off" required>
                <label for="email">Mobile Number (Username)</label>
            </div>
            <!-- Password -->
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" required>
                <label for="password">Password</label>
            </div>
            <!-- Remember me -->
            <div class=" mb-3" data-bs-toggle="modal" data-bs-target="#forgotPassword">
                Forgot Password ?
            </div>
            <!-- Button -->
            <button class="btn btn-danger bg-gradient w-100" type="submit">Login</button>
        </form>
    </div>
</div>
<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPassword" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger bg-gradient text-white">
                <h5 class="modal-title">Forgot Password ?</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal"></button>-->
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="<?= url('forgot-password') ?>">
                    @csrf
                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Type your registered email address">
                        <label for="email">Registered Email Address</label>
                    </div>
                    <!-- Remember me -->
                    <!-- <div class=" mb-3">
                        After submitting, please check your registered email address for instruction.
                    </div> -->
                    <!-- Button -->
                    <button class="btn btn-danger bg-gradient w-100">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
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