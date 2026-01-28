<?php

use App\Helpers\Helper;

$controllerRoute = $module['controller_route'];
?>
<div class="pagetitle">
    <h1><?= $page_header ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= url('admin/dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active"><?= $page_header ?></li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-xl-12">
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
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title pt-0">
                        <a href="<?= url('admin/' . $controllerRoute . '/add/') ?>" class="btn btn-outline-success btn-sm">Add <?= $module['title'] ?></a>
                    </h5> -->
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" enctype="multipart/form-data" style="border:1px solid #01010129; padding:10px; border-radius:10px; margin-bottom:10px;">
                                <input type="file" name="photo[]" class="form-control mb-3" id="photo" multiple required>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="http://localhost/1111091009712197108/public/uploads/institute/1769435438_360_F_1525361933_wrAhkKnIAuYmw9suastDjy6ZDuPLld64.jpg" class="img-thumbnail" style="width:100%; margin-bottom:10px;">
                                </div>
                                <div class="col-md-2">
                                    <img src="http://localhost/1111091009712197108/public/uploads/institute/1769435438_360_F_1525361933_wrAhkKnIAuYmw9suastDjy6ZDuPLld64.jpg" class="img-thumbnail" style="width:100%; margin-bottom:10px;">
                                </div>
                                <div class="col-md-2">
                                    <img src="http://localhost/1111091009712197108/public/uploads/institute/1769435438_360_F_1525361933_wrAhkKnIAuYmw9suastDjy6ZDuPLld64.jpg" class="img-thumbnail" style="width:100%; margin-bottom:10px;">
                                </div>
                                <div class="col-md-2">
                                    <img src="http://localhost/1111091009712197108/public/uploads/institute/1769435438_360_F_1525361933_wrAhkKnIAuYmw9suastDjy6ZDuPLld64.jpg" class="img-thumbnail" style="width:100%; margin-bottom:10px;">
                                </div>
                                <div class="col-md-2">
                                    <img src="http://localhost/1111091009712197108/public/uploads/institute/1769435438_360_F_1525361933_wrAhkKnIAuYmw9suastDjy6ZDuPLld64.jpg" class="img-thumbnail" style="width:100%; margin-bottom:10px;">
                                </div>
                                <div class="col-md-2">
                                    <img src="http://localhost/1111091009712197108/public/uploads/institute/1769435438_360_F_1525361933_wrAhkKnIAuYmw9suastDjy6ZDuPLld64.jpg" class="img-thumbnail" style="width:100%; margin-bottom:10px;">
                                </div>
                                <div class="col-md-2">
                                    <img src="http://localhost/1111091009712197108/public/uploads/institute/1769435438_360_F_1525361933_wrAhkKnIAuYmw9suastDjy6ZDuPLld64.jpg" class="img-thumbnail" style="width:100%; margin-bottom:10px;">
                                </div>
                                <div class="col-md-2">
                                    <img src="http://localhost/1111091009712197108/public/uploads/institute/1769435438_360_F_1525361933_wrAhkKnIAuYmw9suastDjy6ZDuPLld64.jpg" class="img-thumbnail" style="width:100%; margin-bottom:10px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>