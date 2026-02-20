<h6 class="fw-bold pt-2 pb-2 text-dark">Welcome ! <?= (($user)?$user->name:'') ?></h6>
<div class="card shadow">
    <div class="card-header bg-danger text-white fw-bold">Upcoming Events</div>
    <div class="card-body p-0">
        <div class="carousel" id="carousel" aria-roledescription="carousel">
            <div class="carousel__track" id="track">
                <!-- Slides: replace src with your images -->
                <div class="carousel__slide">
                    <img src="<?=env('FRONT_ASSETS_URL')?>images-omdayal/event-slider/event-1.jpg" alt="">
                    <p class="p-3 mb-0 fw-bold text-dark">
                    Event Name should go here 1<br></p>
                    <p class="text-dark" style="font-size:10px; margin-left:5%; margin-top:-4%;"><i class="fa fa-calendar-alt"></i>
                        16.12.2025&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker"></i> DPS Durgapur
                    </p>
                </div>
                <div class="carousel__slide">
                    <img src="<?=env('FRONT_ASSETS_URL')?>images-omdayal/event-slider/event-2.jpg" alt="">
                    <p class="p-3 mb-0 fw-bold text-dark">
                    Event Name should go here 2<br></p>
                    <p class="text-dark" style="font-size:10px; margin-left:5%; margin-top:-4%;"><i class="fa fa-calendar-alt"></i>
                        16.12.2025&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker"></i> DPS Durgapur
                    </p>
                </div>
                <div class="carousel__slide">
                    <img src="<?=env('FRONT_ASSETS_URL')?>images-omdayal/event-slider/event-3.jpg" alt="">
                    <p class="p-3 mb-0 fw-bold text-dark">
                    Event Name should go here 3<br></p>
                    <p class="text-dark" style="font-size:10px; margin-left:5%; margin-top:-4%;"><i class="fa fa-calendar-alt"></i>
                        16.12.2025&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker"></i> DPS Durgapur
                    </p>
                </div>
            </div>
            <span class="visually-hidden" id="carousel-status" aria-live="polite">Image carousel</span>
        </div>
    </div>
</div>
<div class="card shadow mt-3 mb-3">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <a href="#" style="text-decoration:none">
                    <div class="col-md-12 p-3 shadow mb-3 text-center text-dark fw-bold bg-info bg-gradient"
                        style="border-radius:4px;">
                        Society Members
                    </div>
                </a>
                <a href="#" style="text-decoration:none">
                    <div class="col-md-12 p-3 shadow mb-3 text-center text-dark fw-bold bg-warning bg-gradient"
                        style="border-radius:4px;">
                        Admin & Employee
                    </div>
                </a>
                <a href="#" style="text-decoration:none">
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
        <p style="text-align:justify; font-size:12px;" class="text-secondary">Om Dayal Group takes pride in shaping an
            educational journey empowered with a high level of discipline, qualified and dedicated faculty, and an all
            inclusive and modern approach without compromising on ethical values. Our mission is to impart education
            beyond the frontiers of a formal scholar. Our preparation is in fact, for lifelong learning and achieving.</p>
    </div>
</div>
<div class="p-4">&nbsp;</div>