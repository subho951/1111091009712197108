<?php
    $profileUser = $profileUser ?? $user;
    $typeLabels = [
        1 => 'Society Member',
        2 => 'Admin & Employee Member',
        3 => 'Teacher Member',
    ];
    $memberType = $typeLabels[$profileUser->type] ?? 'Member';
    $defaultPhoto = 'profile-photo.jpg';
    if ($profileUser->type == 1) {
        $defaultPhoto = 'member-society.jpg';
    } elseif ($profileUser->type == 2) {
        $defaultPhoto = 'member-employee.jpg';
    } elseif ($profileUser->type == 3) {
        $defaultPhoto = 'member-teacher.jpg';
    }
?>

<a href="<?= url('home') ?>" style="text-decoration:none;">
    <h6 class="fw-bold pt-2 pb-0 text-dark text-end"><i class="fa fa-arrow-left"></i> Back To Home</h6>
</a>

<h6 class="fw-bold pt-2 pb-0 text-danger text-uppercase">Profile</h6>

<div class="card shadow mt-3 mb-3">
    <div class="card-header bg-danger bg-gradient text-white">
        <h5 class="modal-title mb-0">Profile</h5>
    </div>

    <div class="card-body text-center" style="background-image:url(<?= env('FRONT_ASSETS_URL') ?>images-omdayal/profile-bg.jpg); background-repeat:no-repeat; background-size:cover; width:100%;">
        <?php if ($profileUser->photo != '') { ?>
            <img src="<?= env('UPLOADS_URL') . '/user/' . $profileUser->photo ?>" alt="<?= e($profileUser->name) ?>" style="border-radius:50%; width:150px; height:150px; object-fit:cover; border:1px solid #A40000;">
        <?php } else { ?>
            <img src="<?= env('FRONT_ASSETS_URL') ?>images-omdayal/<?= $defaultPhoto ?>" alt="<?= e($profileUser->name) ?>" style="border-radius:50%; width:150px; height:150px; object-fit:cover; border:1px solid #A40000;">
        <?php } ?>

        <h6 class="fw-bold mt-2"><?= $profileUser->name ?></h6>
        <h6 style="margin-top:-4px;"><?= $profileUser->designation ?></h6>
        <h6 class="text-danger" style="font-size:12px;"><?= $memberType ?></h6>

        <?php if (!empty($profileInstitute)) { ?>
            <h6 style="font-size:12px;"><i class="fa fa-university"></i> <?= $profileInstitute->name ?></h6>
        <?php } ?>

        <h6 style="font-size:12px;">
            <i class="fa fa-mobile"></i> <?= $profileUser->phone ?>
            <?php if ($profileUser->email != '') { ?>
                | <i class="fa fa-envelope"></i> <?= $profileUser->email ?>
            <?php } ?>
        </h6>

        <?php if ($profileUser->dob != '') { ?>
            <h6 style="font-size:12px;"><i class="fa fa-calendar-alt"></i> <?= date_format(date_create($profileUser->dob), "d.m.Y") ?></h6>
        <?php } ?>

        <?php if ($profileUser->short_profile != '') { ?>
            <h6 style="font-size:12px; line-height:1.5; text-align:justify; margin-top:12px;">Short Bio : <?= $profileUser->short_profile ?></h6>
        <?php } ?>

        <?php if ($profileUser->biodata != '') { ?>
            <h6 style="font-size:12px; margin-top:14px;">
                <a href="<?= env('UPLOADS_URL') . '/user/' . $profileUser->biodata ?>" class="btn btn-danger btn-sm" download>
                    <i class="fa fa-download"></i>
                    Download Full Profile
                </a>
            </h6>
        <?php } ?>
    </div>

    <div class="card-footer text-center" style="background-image:url(<?= env('FRONT_ASSETS_URL') ?>images-omdayal/profile-bg.jpg); background-repeat:no-repeat; background-size:cover; width:100%;">
        <a href="<?= url('edit-profile') ?>" class="btn btn-danger btn-sm">
            <i class="fa fa-user-edit"></i>
            Edit Profile
        </a>
    </div>
</div>

<div class="pb-5"></div>
