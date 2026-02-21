<h6 class="fw-bold pt-2 pb-0 text-danger">Media</h6>
<?php if($ins){ foreach($ins as $row){?>
    <a href="<?= url('media-details/' . $row->id) ?>">
        <div class="card shadow mt-3 mb-3 p-2 pt-0 pb-0">
            <div class="container-fluid text-center">
                <div class="row">
                    <div class="col-12 bg-gradient p-4 fw-bold" style="margin-top:3%; margin-bottom:3%; background-color:<?= $row->background_color ?>;">
                        <img src="<?=env('UPLOADS_URL'). '/institute/' . $row->logo?>" alt="<?= $row->name ?>" class="w-100"><br>
                        <?= $row->name ?>
                    </div>
                </div>
            </div>
        </div>
    </a>
<?php } }?>
<div class="pb-4"></div>