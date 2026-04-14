<?php
$totalManagedRecords = (int) $institute_count
    + (int) $category_count
    + (int) $event_count
    + (int) $society_member_count
    + (int) $admin_member_count
    + (int) $teacher_member_count
    + (int) $news_count
    + (int) $magazine_count
    + (int) $achievement_count
    + (int) $media_count;

$statCards = [
   [
      'label' => 'Institutes',
      'count' => $institute_count,
      'link' => url('admin/institute/list'),
      'icon' => 'fa-solid fa-university',
      'tone' => 'blue',
      'note' => 'Academic partners',
   ],
   [
      'label' => 'Categories',
      'count' => $category_count,
      'link' => url('admin/category/list'),
      'icon' => 'fa-solid fa-layer-group',
      'tone' => 'slate',
      'note' => 'Content taxonomy',
   ],
   [
      'label' => 'Events',
      'count' => $event_count,
      'link' => url('admin/event/list'),
      'icon' => 'fa-solid fa-calendar-check',
      'tone' => 'gold',
      'note' => 'Scheduled activity',
   ],
   [
      'label' => 'Society Members',
      'count' => $society_member_count,
      'link' => url('admin/society-member/list'),
      'icon' => 'fa-solid fa-users',
      'tone' => 'emerald',
      'note' => 'Public member network',
   ],
   [
      'label' => 'Admin & Employee Members',
      'count' => $admin_member_count,
      'link' => url('admin/employee-member/list'),
      'icon' => 'fa-solid fa-user-tie',
      'tone' => 'rose',
      'note' => 'Internal team accounts',
   ],
   [
      'label' => 'Teacher Members',
      'count' => $teacher_member_count,
      'link' => url('admin/teacher-member/list'),
      'icon' => 'fa-solid fa-chalkboard-user',
      'tone' => 'indigo',
      'note' => 'Faculty directory',
   ],
   [
      'label' => 'News',
      'count' => $news_count,
      'link' => url('admin/news/list'),
      'icon' => 'fa-solid fa-newspaper',
      'tone' => 'blue',
      'note' => 'Latest updates',
   ],
   [
      'label' => 'Magazines',
      'count' => $magazine_count,
      'link' => url('admin/magazine/list'),
      'icon' => 'fa-solid fa-book-open',
      'tone' => 'gold',
      'note' => 'Published editions',
   ],
   [
      'label' => 'Achievements',
      'count' => $achievement_count,
      'link' => url('admin/achievement/list'),
      'icon' => 'fa-solid fa-award',
      'tone' => 'emerald',
      'note' => 'Recognition archive',
   ],
   [
      'label' => 'Media',
      'count' => $media_count,
      'link' => url('admin/media/institute-list'),
      'icon' => 'fa-solid fa-photo-film',
      'tone' => 'slate',
      'note' => 'Asset library',
   ],
];
?>
<div class="pagetitle admin-pagetitle">
   <div>
      <h1><?=$page_header?></h1>
      <nav>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Home</a></li>
            <li class="breadcrumb-item active"><?=$page_header?></li>
         </ol>
      </nav>
   </div>
   <div class="admin-pagetitle-actions">
      <span class="admin-pagetitle-date"><?=date('l, d M Y')?></span>
      <a href="<?=url('admin/settings')?>" class="btn btn-admin-ghost">
         <i class="fa-solid fa-gear"></i>
         <span>Account Settings</span>
      </a>
   </div>
</div>

<section class="section dashboard">
   <div class="admin-dashboard-hero card">
      <div class="card-body">
         <div class="admin-dashboard-hero__copy">
            <span class="admin-dashboard-hero__eyebrow">Welcome back, <?=session('name')?></span>
            <h2><?=$generalSetting->site_name?> control center</h2>
            <p>Track content, people, and system activity from one polished command surface.</p>
            <div class="admin-dashboard-hero__chips">
               <span class="admin-chip"><?=number_format($totalManagedRecords)?> total records</span>
               <span class="admin-chip">Updated <?=date('h:i A')?></span>
               <span class="admin-chip">Premium admin workspace</span>
            </div>
         </div>
         <div class="admin-dashboard-hero__actions">
            <a href="<?=url('/')?>" target="_blank" class="btn btn-admin-visit">
               <i class="fa-solid fa-arrow-up-right-from-square"></i>
               <span>Visit Website</span>
            </a>
            <a href="<?=url('admin/settings')?>" class="btn btn-admin-ghost">
               <i class="fa-solid fa-sliders"></i>
               <span>Quick Settings</span>
            </a>
         </div>
      </div>
   </div>

   <div class="admin-section-label-row">
      <h3>Management Snapshot</h3>
      <p>A fast, visual summary of the modules you manage most often.</p>
   </div>

   <div class="row g-4">
      <?php foreach($statCards as $card){ ?>
         <div class="col-xxl-3 col-lg-4 col-md-6">
            <a href="<?=$card['link']?>" class="admin-stat-card tone-<?=$card['tone']?>">
               <span class="admin-stat-card__icon">
                  <i class="<?=$card['icon']?>"></i>
               </span>
               <span class="admin-stat-card__body">
                  <span class="admin-stat-card__label"><?=$card['label']?></span>
                  <strong><?=number_format($card['count'])?></strong>
                  <small><?=$card['note']?></small>
               </span>
               <span class="admin-stat-card__arrow"><i class="fa-solid fa-arrow-right"></i></span>
            </a>
         </div>
      <?php } ?>
   </div>
</section>
