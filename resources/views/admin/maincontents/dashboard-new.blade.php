<style>
   b{
      font-size:30px;
   }
   a{
      color:#000;
   }
</style>
<div class="pagetitle">
   <h1><?=$page_header?></h1>
   <nav>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Home</a></li>
         <li class="breadcrumb-item active"><?=$page_header?></li>
      </ol>
   </nav>
</div>
<!-- End Page Title -->
<section class="section dashboard">
   <div class="row align-items-center">
      <div class="col-lg-4">
         <a href="<?= url('admin/institute/list') ?>">
            <div class="card mb-3">
               <div class="card-body">
                  <h5>Institutes</h5>
                  <b><?= $institute_count ?></b>
               </div>
            </div>
         </a>
      </div>
      <div class="col-lg-4">
         <a href="<?= url('admin/category/list') ?>">
            <div class="card mb-3">
               <div class="card-body">
                  <h5>Categories</h5>
                  <b><?= $category_count ?></b>
               </div>
            </div>
         </a>
      </div>
      <div class="col-lg-4">
         <a href="<?= url('admin/event/list') ?>">
            <div class="card mb-3">
               <div class="card-body">
                  <h5>Events</h5>
                  <b><?= $event_count ?></b>
               </div>
            </div>
         </a>
      </div>

      <div class="col-lg-4">
         <a href="<?= url('admin/society-member/list') ?>">
            <div class="card mb-3">
               <div class="card-body">
                  <h5>Society members</h5>
                  <b><?= $society_member_count ?></b>
               </div>
            </div>
         </a>
      </div>
      <div class="col-lg-4">
         <a href="<?= url('admin/employee-member/list') ?>">
            <div class="card mb-3">
               <div class="card-body">
                  <h5>Admin & Employee Members</h5>
                  <b><?= $admin_member_count ?></b>
               </div>
            </div>
         </a>
      </div>
      <div class="col-lg-4">
         <a href="<?= url('admin/teacher-member/list') ?>">
            <div class="card mb-3">
               <div class="card-body">
                  <h5>Teacher Members</h5>
                  <b><?= $teacher_member_count ?></b>
               </div>
            </div>
         </a>
      </div>

      <div class="col-lg-3">
         <a href="<?= url('admin/news/list') ?>">
            <div class="card mb-3">
               <div class="card-body">
                  <h5>News</h5>
                  <b><?= $news_count ?></b>
               </div>
            </div>
         </a>
      </div>
      <div class="col-lg-3">
         <a href="<?= url('admin/magazine/list') ?>">
            <div class="card mb-3">
               <div class="card-body">
                  <h5>Magazines</h5>
                  <b><?= $magazine_count ?></b>
               </div>
            </div>
         </a>
      </div>
      <div class="col-lg-3">
         <a href="<?= url('admin/achievement/list') ?>">
            <div class="card mb-3">
               <div class="card-body">
                  <h5>Achievements</h5>
                  <b><?= $achievement_count ?></b>
               </div>
            </div>
         </a>
      </div>
      <div class="col-lg-3">
         <a href="<?= url('admin/media/institute-list') ?>">
            <div class="card mb-3">
               <div class="card-body">
                  <h5>Medias</h5>
                  <b><?= $media_count ?></b>
               </div>
            </div>
         </a>
      </div>
   </div>
</section>