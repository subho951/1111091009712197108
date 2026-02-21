<h6 class="fw-bold pt-2 pb-2 text-dark">Welcome ! <?= (($user)?$user->name:'') ?></h6>
<div class="card shadow">
    <div class="card-header bg-danger text-white fw-bold">Upcoming Events</div>
    <div class="card-body p-0">
        <div class="carousel" id="carousel" aria-roledescription="carousel">
            <div class="carousel__track" id="track">
                <?php if($events){ foreach($events as $event){?>
                    <div class="carousel__slide">
                        <img src="<?=env('UPLOADS_URL'). '/event/' . $event->photo?>" alt="<?= $event->title ?>" style="height: 300px;">
                        <p class="p-3 mb-0 fw-bold text-dark">
                        <?= $event->title ?><br></p>
                        <p class="text-dark" style="font-size:10px; margin-left:5%; margin-top:-4%;"><i class="fa fa-calendar-alt"></i>
                            <?= date_format(date_create($event->event_date), "d.m.Y") ?>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker"></i> <?= $event->venue ?>
                        </p>
                    </div>
                <?php } }?>
            </div>
            <span class="visually-hidden" id="carousel-status" aria-live="polite">Image carousel</span>
        </div>
    </div>
</div>
<div class="card shadow mt-3 mb-3">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <a href="<?= url('society-members') ?>" style="text-decoration:none">
                    <div class="col-md-12 p-3 shadow mb-3 text-center text-dark fw-bold bg-info bg-gradient"
                        style="border-radius:4px;">
                        Society Members
                    </div>
                </a>
                <a href="<?= url('employee-members') ?>" style="text-decoration:none">
                    <div class="col-md-12 p-3 shadow mb-3 text-center text-dark fw-bold bg-warning bg-gradient"
                        style="border-radius:4px;">
                        Admin & Employee
                    </div>
                </a>
                <a href="<?= url('teacher-members') ?>" style="text-decoration:none">
                    <div class="col-md-12 p-3 shadow  text-center text-dark fw-bold bg-success bg-gradient"
                        style="border-radius:4px;">
                        Teachers
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="card shadow mt-3">
    <div class="card-body">
        <h5 class="text-center text-danger fw-bold">About Om Dayal Group</h5>
        <p style="text-align:justify; font-size:12px;" class="text-secondary" style="text-align:justify;"><?= (($page_content)?$page_content->long_description:'') ?></p>
    </div>
</div>
<div class="p-4">&nbsp;</div>