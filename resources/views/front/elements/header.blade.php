<button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
<div class="logo"><img src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>"></div>
<div class="profile-icon">
    <a href="<?= url('profile') ?>" title="View Profile">
    <?php if(empty($user)){?>
        <img src="<?=env('FRONT_ASSETS_URL')?>images-omdayal/profile-photo.jpg" style="width:30px; height:30px; border-radius:50%;">
    <?php } else {?>
        <?php if($user->photo != ''){?>
            <img src="<?=env('UPLOADS_URL'). '/user/' . $user->photo?>" style="width:30px; height:30px; border-radius:50%;">
        <?php } else {?>
            <img src="<?=env('FRONT_ASSETS_URL')?>images-omdayal/profile-photo.jpg" style="width:30px; height:30px; border-radius:50%;">
        <?php }?>
    <?php }?>
    </a>
</div>
