<?php
use App\Models\Media;
?>
<a href="<?= url('media') ?>" style="text-decoration:none;">
    <h6 class="fw-bold pt-2 pb-0 text-dark text-end"><i class="fa fa-arrow-left"></i> Back To Media</h6>
</a>
<h6 class="fw-bold pt-2 pb-0 text-danger text-uppercase">Media : <?= (($institute)?$institute->name:'') ?></h6>

<?php if($cats){ foreach($cats as $row){?>
<h6 class="fw-bold pt-2 pb-2 text-dark alert alert-danger">Category : <?= (($row)?$row->name:'') ?></h6>
    <?php
    $medias = Media::select('title', 'media_file')->where('institute_id', '=', $institute_id)->where('category_id', '=', $row->id)->where('status', '=', 1)->get();
    if($medias){ foreach($medias as $media){
    ?>
        <div class="card shadow mt-3 mb-3 p-2 pt-0 pb-0">
            <div class="container-fluid text-center">
                <div class="row">
                    <div class="col-12  p-4 fw-bold" style="margin-top:3%; margin-bottom:3%">
                        <img src="<?=url('public/') . '/' .$media->media_file?>" alt="<?= $media->title ?>" class="w-100">
                        <h6 class="mt-3"><?= $media->title ?></h6>
                    </div>
                </div>
            </div>
        </div>
    <?php } }?>
<?php } }?>

<div class="pb-4"></div>