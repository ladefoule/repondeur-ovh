<div class="col-lg-9 p-0">
    <div class="card">
        <div class="card-header"><span class="icon-mail"></span> Mon répondeur</div>
        <div class="card-body">
        <?php 
            if(isset($formMethod) && $formMethod)
                print "<form method='$formMethod'>";
        ?>
                <div class="form-row pb-3 d-flex align-items-center">
                    <label for="account" class="col-lg-3 text-lg-right col-form-label">Email <span class="text-danger">*</span></label>
                    <input type="text" required disabled class="form-control col-6 col-lg-5" id="account" value="<?php echo $account ?>"><span class="col-6 col-lg-4">@<?php echo $domain ?></span>
                </div>

                <div class="form-row pb-3">
                    <label class="col-lg-3 col-form-label text-lg-right" for="content">Message <span class="text-danger">*</span></label>
                    <textarea class="col-lg-9 form-control" required <?php if($action == 'show') echo 'disabled'; ?> rows="8" id="content" name="content"><?php echo $content ?></textarea>
                </div>
                
                <!-- Cette propriété ne peut pas être modifiée lors de la modification d'un répondeur -->
                <?php if($action != 'update'){ ?>
                <div class="offset-lg-3 form-check pb-3 d-flex align-items-center">
                    <input class="form-check-input" type="checkbox" <?php if($action == 'show') echo 'disabled'; ?> <?php if($copy) echo 'checked'; ?> id="copy" name="copy">
                    <label class="form-check-label" for="copy">
                        Sauvegarder les mails reçus
                    </label>
                </div>
                <?php } ?>

                <div class="form-row pb-3">
                    <label class="col-lg-3 col-form-label text-lg-right" for="from">Début <span class="text-danger">*</span></label>
                    <input type="date" required <?php if($action == 'show') echo 'disabled'; ?> class="col-lg-9 form-control" id="from" name="from" value="<?php echo $from ?>">
                </div>

                <div class="form-row pb-3">
                    <label class="col-lg-3 col-form-label text-lg-right" for="to">Fin (inclus) <span class="text-danger">*</span></label>
                    <input type="date" required <?php if($action == 'show') echo 'disabled'; ?> class="col-lg-9 form-control" id="to" name="to" value="<?php echo $to ?>">
                </div>
                <?php if($action == 'create'){ ?>
                    <button type="submit" class="offset-lg-3 btn btn-primary px-4" name="action" value="create">Créer</button>
                <?php }else if($action == 'update'){ ?>
                    <button type="submit" class="offset-lg-3 btn btn-warning px-4" name="action" value="update">Modifier</button>
                <?php } ?>
        <?php 
        if(isset($formMethod) && $formMethod)
            print '</form>';
        ?>
            <div class="form-row pb-3 d-flex">
                <?php if($action == 'show'){ ?>
                    <a href="/update" class="offset-lg-3"><button class="btn-sm btn-warning">Modifier</button></a>
                    <a href="/delete"><button class="ml-3 btn-sm btn-danger">Supprimer</button></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>