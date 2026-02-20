<h6 class="fw-bold pt-2 pb-0 text-danger text-uppercase"><?= (($page_content)?$page_content->page_title:'') ?></h6>
<div class="card shadow mt-3 mb-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" style="margin-top:3%; margin-bottom:3%; text-align:justify; font-size:12px; padding:10px 20px;">
                <?= (($page_content)?$page_content->long_description:'') ?>
            </div>
        </div>
    </div>
</div>
<div class="pb-5"></div>