<div class="col-lg-8 p-0">
    <div class="card">
        <div class="card-header p-3">
            Gestion de votre répondeur
        </div>
        <div class="card-body p-3">
            <div class="form-row pb-3">
                <label for="account" class="col-md-3 col-form-label text-md-right"><span class="text-danger">*</span> Email</label>
                <div class="col-md-9 d-flex align-items-center">
                    <input type="text" class="form-control col-6" disabled id="account" name="account" value="<?php echo $account ?>">
                    <span class="col-6">@<?php echo $domain ?></span>
                </div>
            </div>

            <div class="form-row pb-3">
                <div class="offset-md-3 col-md-9">
                    <?php if($responderAvailable){ ?>
                        <a href="?action=show"><button class="btn btn-danger" name="action"><?php echo $actions['show']['button'] ?></button></a>
                    <?php }else{ ?>
                        <a href="?action=create"><button class="btn btn-primary" name="action"><?php echo $actions['create']['button'] ?></button></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>