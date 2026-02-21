<h6 class="fw-bold pt-2 pb-0 text-danger">Recent News</h6>
<?php if($news){ foreach($news as $row){?>
    <div class="card shadow mt-3 mb-3">
        <a href="<?= url('news-details/' . $row->id) ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4" style="margin-top:3%; margin-bottom:3%"><img src="<?=env('UPLOADS_URL'). '/news/' . $row->photo?>" alt="<?= $row->name ?>"
                            class="w-100"></div>
                    <div class="col-8">
                        <p
                            style="font-size:12px; font-weight:600; margin-top:6%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width:80%;">
                            <?= $row->name ?></p>
                        <p class="text-secondary" style="font-size:10px; margin-top:-6%;"><i class="fa fa-calendar-alt"></i>
                            <?= date_format(date_create($row->news_date), "d.m.Y") ?>
                        </p>
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php } }?>