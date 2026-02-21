<h6 class="fw-bold pt-2 pb-0 text-danger text-uppercase">Admin & Employee Members</h6>
<input type="text" class="form-control" placeholder="Search by name or designation..." name="search_keyword" id="search_keyword">
<div class="card shadow mt-3 mb-3">
    <div class="container-fluid">
        <div class="row">
            <?php if($members){ foreach($members as $member){?>
                <div class="col-6 member-card" 
                    style="margin-top:3%; margin-bottom:3%" 
                    data-name="<?= strtolower($member->name) ?>"
                    data-designation="<?= strtolower($member->designation) ?>"
                    data-bs-toggle="modal" 
                    data-bs-target="#fullModal<?= $member->id ?>">
                    <?php if($member->photo != ''){?>
                        <img src="<?=env('UPLOADS_URL'). '/user/' . $member->photo?>" class="w-100 rounded-2" alt="<?= $member->name ?>" style="height: 153px;">
                    <?php } else {?>
                        <img src="<?=env('FRONT_ASSETS_URL')?>images-omdayal/member-employee.jpg" class="w-100 rounded-2" alt="<?= $member->name ?>" style="height: 153px;">
                    <?php }?>
                    <h6 class="text-center pt-2" style="font-size:12px; font-weight:900;"><?= $member->name ?></h6>
                    <h6 class="text-center pt-0 text-danger" style="font-size:11px; font-weight:900; margin-top:-6px;">
                        <?= $member->designation ?>
                    </h6>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="fullModal<?= $member->id ?>" tabindex="-1">
                    <div class="modal-dialog ">
                        <div class="modal-content">

                            <div class="modal-header bg-danger bg-gradient text-white">
                                <h5 class="modal-title">Profile</h5>
                                <!--<button type="button" class="btn-close" data-bs-dismiss="modal"></button>-->
                            </div>

                            <div class="modal-body text-center" style="background-image:url(<?= env('FRONT_ASSETS_URL') ?>images-omdayal/profile-bg.jpg); background-repeat:no-repeat; width:100%;">
                                
                                <?php if ($member->photo != '') { ?>
                                    <img src="<?= env('UPLOADS_URL') . '/user/' . $member->photo ?>" alt="<?= $member->name ?>" style="border-radius:50%; width:150px; height:150px; border:1px solid #A40000;">
                                <?php } else { ?>
                                    <img src="<?= env('FRONT_ASSETS_URL') ?>images-omdayal/member-employee.jpg" alt="<?= $member->name ?>" style="border-radius:50%; width:150px; height:150px; border:1px solid #A40000;">
                                <?php } ?>

                                <h6 class="fw-bold mt-2"><?= $member->name ?></h6>
                                <h6 style="margin-top:-4px;"><?= $member->designation ?></h6>
                                <h6 style="font-size:12px;"><i class="fa fa-mobile"></i> <?= $member->phone ?> | <i class="fa fa-envelope"></i>
                                    <?= $member->email ?></h6>

                                <h6 style="font-size:12px;">Short Bio : <?= $member->short_profile ?></h6>

                                <h6 style="font-size:12px;">
                                    <a href="<?= env('UPLOADS_URL') . '/user/' . $member->biodata ?>" class="btn btn-danger btn-sm" download>
                                        <i class="fa fa-download"></i>
                                        Download Full Profile
                                    </a>
                                </h6>
                            </div>

                            <div class="modal-footer"
                                style="background-image:url(<?= env('FRONT_ASSETS_URL') ?>images-omdayal/profile-bg.jpg); background-repeat:no-repeat; width:100%;">
                                <button class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } }?>
        </div>
    </div>
</div>
<div class="pb-5"></div>

<script>
    document.getElementById('search_keyword').addEventListener('keyup', function () {
        let keyword = this.value.toLowerCase().trim();
        let cards = document.querySelectorAll('.member-card');

        cards.forEach(function (card) {
            let name = card.dataset.name;
            let designation = card.dataset.designation;

            if (name.includes(keyword) || designation.includes(keyword)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>