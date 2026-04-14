<?php
use Illuminate\Support\Facades\Route;
$routeName    = Route::current();
$pageName     = explode("/", $routeName->uri());
$pageSegment  = $pageName[1] ?? '';
?>
<div class="sidebar-brand">
  <a href="<?=url('admin/dashboard')?>" class="sidebar-brand-link">
    <span class="sidebar-brand-mark"><i class="fa-solid fa-building-shield"></i></span>
    <span class="sidebar-brand-copy">
      <strong><?=$generalSetting->site_name?></strong>
      <small>Admin Control Center</small>
    </span>
  </a>
</div>

<div class="sidebar-meta">
  <span class="sidebar-meta__label">Signed in as</span>
  <strong><?=session('name')?></strong>
  <small><?=session('email')?></small>
</div>

<div class="sidebar-nav-wrap">
  <p class="sidebar-section-label">Overview</p>
  <ul class="sidebar-nav" id="sidebar-nav-overview">
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'dashboard')?'active':'')?>" href="{{ url('admin/dashboard') }}">
        <i class="fa fa-home"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'institute')?'active':'')?>" href="{{ url('admin/institute/list') }}">
        <i class="fa fa-university"></i>
        <span>Institutes</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'category')?'active':'')?>" href="{{ url('admin/category/list') }}">
        <i class="fa fa-list-alt"></i>
        <span>Categories</span>
      </a>
    </li>
  </ul>

  <p class="sidebar-section-label">People</p>
  <ul class="sidebar-nav" id="sidebar-nav-people">
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'society-member')?'active':'')?>" href="{{ url('admin/society-member/list') }}">
        <i class="fa fa-users"></i>
        <span>Society Members</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'employee-member')?'active':'')?>" href="{{ url('admin/employee-member/list') }}">
        <i class="fa fa-user-tie"></i>
        <span>Admin & Employee Members</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'teacher-member')?'active':'')?>" href="{{ url('admin/teacher-member/list') }}">
        <i class="fa fa-chalkboard-user"></i>
        <span>Teacher Members</span>
      </a>
    </li>
  </ul>

  <p class="sidebar-section-label">Content</p>
  <ul class="sidebar-nav" id="sidebar-nav-content">
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'event')?'active':'')?>" href="{{ url('admin/event/list') }}">
        <i class="fa fa-calendar"></i>
        <span>Events</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'news')?'active':'')?>" href="{{ url('admin/news/list') }}">
        <i class="fa-solid fa-magnifying-glass"></i>
        <span>News</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'magazine')?'active':'')?>" href="{{ url('admin/magazine/list') }}">
        <i class="fa fa-newspaper"></i>
        <span>Magazines</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'achievement')?'active':'')?>" href="{{ url('admin/achievement/list') }}">
        <i class="fa fa-award"></i>
        <span>Achievements</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'media')?'active':'')?>" href="{{ url('admin/media/institute-list') }}">
        <i class="fa-solid fa-image"></i>
        <span>Media</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'page')?'active':'')?>" href="{{ url('admin/page/list') }}">
        <i class="fa fa-file-text"></i>
        <span>Pages</span>
      </a>
    </li>
  </ul>

  <p class="sidebar-section-label">Reports & System</p>
  <ul class="sidebar-nav" id="sidebar-nav-system">
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'email-logs')?'active':'')?>" href="{{ url('admin/email-logs') }}">
        <i class="fa fa-envelope"></i>
        <span>Email Logs</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'login-logs')?'active':'')?>" href="{{ url('admin/login-logs') }}">
        <i class="fa fa-list"></i>
        <span>Login Logs</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'settings')?'active':'')?>" href="{{ url('admin/settings') }}">
        <i class="fa fa-cogs"></i>
        <span>Account Settings</span>
      </a>
    </li>
  </ul>
</div>
