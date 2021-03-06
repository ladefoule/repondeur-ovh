<div class="col-lg-9 p-0">
    <div class="card">
        <div class="card-header p-3">
            Gestion de mon répondeur
        </div>
        <div class="card-body p-3">
            <div class="form-row pb-3">
                <label for="account" class="col-md-3 col-form-label text-md-right"><span class="text-danger">*</span> Email</label>
                <div class="col-md-9 d-flex align-items-center">
                    <input type="text" class="form-control-sm col-6" disabled id="account" name="account" value="<?php echo $account ?>">
                    <span class="col-6">@<?php echo $domain ?></span>
                </div>
            </div>

            <div class="form-row pb-3">
                <label for="account" class="col-md-3 col-form-label text-md-right">Mon répondeur</label>
                <div class="col-md-9 d-flex align-items-center d-flex flex-wrap">
                    <?php if($responder){ ?>
                        <span class="col-12 alert alert-info">
                            <!-- Vous avez un répondeur -->Valable du <?php echo $responder['from_locale'] ?> au <?php echo $responder['to_locale'] ?>
                        </span>
                        <a href="/show"><button class="btn-sm btn-info">Visualiser</button></a>
                        <a href="/update"><button class="ml-3 btn-sm btn-warning">Modifier</button></a>
                    <?php }else{ ?>
                        <span class="col-12 alert alert-info">Vous n'avez pas de répondeur actif.</span>
                        <a href="/create"><button class="btn-sm btn-primary">Créer</button></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>