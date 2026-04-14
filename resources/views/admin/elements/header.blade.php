<div class="header-shell d-flex align-items-center w-100 gap-3">
  <div class="header-brand-wrap d-flex align-items-center gap-3">
    <a href="<?=url('admin/dashboard')?>" class="brand-mark" aria-label="<?=$generalSetting->site_name?>">
      <?php if($generalSetting->site_logo != ''){?>
        <img src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>" alt="<?=$generalSetting->site_name?>" class="brand-mark-image">
      <?php } else { ?>
        <i class="fa-solid fa-shield-halved"></i>
      <?php } ?>
    </a>
    <div class="brand-copy d-none d-md-flex flex-column">
      <span class="brand-kicker">Administration Suite</span>
      <strong><?=$generalSetting->site_name?></strong>
    </div>
  </div>

  <i class="bi bi-list toggle-sidebar-btn ms-1" aria-label="Toggle sidebar"></i>

  <div class="header-actions d-none d-lg-flex align-items-center gap-2 ms-auto">
    <a href="<?=url('/')?>" target="_blank" class="btn btn-admin-ghost btn-admin-visit">
      <i class="fa-solid fa-arrow-up-right-from-square"></i>
      <span>Visit Website</span>
    </a>
    <a href="{{ url('admin/settings') }}" class="btn btn-admin-ghost">
      <i class="fa-solid fa-gear"></i>
      <span>Settings</span>
    </a>
  </div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <?php if($admin->image != ''){?>
            <img src="<?=env('UPLOADS_URL').$admin->image?>" alt="<?=$admin->name?>" class="rounded-circle profile-avatar">
          <?php } else { ?>
            <img src="<?=env('NO_IMAGE')?>" alt="<?=$admin->name?>" class="rounded-circle profile-avatar">
          <?php } ?>
          <span class="d-none d-md-block dropdown-toggle ps-2"><?=session('name')?></span>
        </a><!-- End Profile Image Icon -->
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?=session('name')?></h6>
            <span><?=session('type')?></span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/settings') }}">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/logout') }}">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>
        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->
    </ul>
  </nav>
</div>
