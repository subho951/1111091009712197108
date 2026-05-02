<h6 class="fw-bold pt-2 pb-2 text-dark"><i class="fa fa-user-edit"></i> Edit Profile</h6>
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

        <form method="POST" action="<?= url('edit-profile') ?>" enctype="multipart/form-data">
            @csrf
            <div class="text-center mb-3">
                <?php if($user && $user->photo != ''){ ?>
                    <img src="<?= env('UPLOADS_URL') . '/user/' . $user->photo ?>" alt="<?= e($user->name) ?>" class="img-thumbnail rounded-circle" style="width:120px; height:120px; object-fit:cover;">
                <?php } else { ?>
                    <img src="<?= env('FRONT_ASSETS_URL') ?>images-omdayal/profile-photo.jpg" alt="Profile photo" class="img-thumbnail rounded-circle" style="width:120px; height:120px; object-fit:cover;">
                <?php } ?>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name', $user->name ?? '') }}" required>
                <label for="name">Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email', $user->email ?? '') }}" required>
                <label for="email">Email</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control bg-light" id="phone" placeholder="Phone" value="{{ $user->phone ?? '' }}" readonly>
                <label for="phone">Phone</label>
            </div>

            <div class="form-floating mb-3">
                <input type="date" class="form-control" name="dob" id="dob" placeholder="DOB" value="{{ old('dob', $user->dob ?? '') }}" max="<?= date('Y-m-d') ?>">
                <label for="dob">DOB</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation" value="{{ old('designation', $user->designation ?? '') }}">
                <label for="designation">Designation</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" name="short_profile" id="short_profile" placeholder="Short Profile" style="height:120px;">{{ old('short_profile', $user->short_profile ?? '') }}</textarea>
                <label for="short_profile">Short Profile</label>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" name="photo" id="photo" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
            </div>

            <button class="btn btn-danger bg-gradient w-100" type="submit">Update Profile</button>
        </form>
    </div>
</div>
<div class="p-4">&nbsp;</div>
