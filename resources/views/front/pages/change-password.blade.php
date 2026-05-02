<h6 class="fw-bold pt-2 pb-2 text-dark"><i class="fa fa-key"></i> Change Password</h6>
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
        @if($errors->any())
        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show autohide" role="alert">
            {{ $errors->first() }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form method="POST" action="<?= url('change-password') ?>">
            @csrf
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password" autocomplete="off" required>
                <label for="current_password">Current Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" autocomplete="off" minlength="6" required>
                <label for="new_password">New Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" autocomplete="off" minlength="6" required>
                <label for="confirm_password">Confirm Password</label>
            </div>
            <button class="btn btn-danger bg-gradient w-100" type="submit">Update Password</button>
        </form>
    </div>
</div>
<div class="p-4">&nbsp;</div>
