<?php if($event){?>
    <h6 class="fw-bold pt-2 pb-0 text-danger text-uppercase"><?= $event->title ?></h6>
    <h6 class="fw-bold pt-0 pb-0 text-dark" style="font-size:12px;"><i class="fa fa-calendar-alt"></i>
        <?= date_format(date_create($event->event_date), "d.m.Y") ?>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker"></i> <?= $event->venue ?></h6>
    <div class="card shadow mt-3 mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" style="margin-top:3%; margin-bottom:3%"><img src="<?=env('UPLOADS_URL'). '/event/' . $event->photo?>" alt="<?= $event->title ?>"
                        class="w-100"></div>
            </div>
        </div>
    </div>
    <div class="card shadow mt-3 mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12"
                    style="margin-top:3%; margin-bottom:3%; text-align:justify; font-size:12px; padding:10px 20px;">
                    <?= $event->description ?>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-5"></div>
<?php }?>