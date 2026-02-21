<h6 class="fw-bold pt-2 pb-0 text-danger">Upcoming Events</h6>
<?php if($upcoming_events){ foreach($upcoming_events as $event){?>
    <div class="card shadow mt-3 mb-3">
        <a href="<?= url('event-details/' . $event->id) ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4" style="margin-top:3%; margin-bottom:3%">
                        <img src="<?=env('UPLOADS_URL'). '/event/' . $event->photo?>" alt="<?= $event->title ?>"
                            class="w-100">
                    </div>
                    <div class="col-8">
                        <p
                            style="font-size:12px; font-weight:600; margin-top:6%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width:80%;">
                            <?= $event->title ?></p>
                        <p class="text-secondary" style="font-size:10px; margin-top:-6%;"><i class="fa fa-calendar-alt"></i>
                            <?= date_format(date_create($event->event_date), "d.m.Y") ?>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker"></i> <?= $event->venue ?>
                        </p>
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php } }?>
<h6 class="fw-bold pt-4 pb-0 text-danger">Past Events</h6>
<?php if($past_events){ foreach($past_events as $event){?>
    <div class="card shadow mt-3 mb-3">
        <a href="<?= url('event-details/' . $event->id) ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4" style="margin-top:3%; margin-bottom:3%">
                        <img src="<?=env('UPLOADS_URL'). '/event/' . $event->photo?>" alt="<?= $event->title ?>"
                            class="w-100">
                    </div>
                    <div class="col-8">
                        <p
                            style="font-size:12px; font-weight:600; margin-top:6%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width:80%;">
                            <?= $event->title ?></p>
                        <p class="text-secondary" style="font-size:10px; margin-top:-6%;"><i class="fa fa-calendar-alt"></i>
                            <?= date_format(date_create($event->event_date), "d.m.Y") ?>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker"></i> <?= $event->venue ?>
                        </p>
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php } }?>