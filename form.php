<form action="/" method="POST">
    <?php include('verif-account.php') ?>

    <div class="form-group">
        <label for="content">Message <span class="text-danger">*</span></label>
        <textarea class="form-control" required id="content" name="message"><?php echo $message ?></textarea>
    </div>
    
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="copie" name="copie" value="<?php echo $dateDebut ?>">
            <label class="form-check-label" for="copie">
                Garder une copie du mail
            </label>
        </div>
    </div>

    <div class="form-row pb-3">
        <label for="email-copie" class="col-12">Envoyer la copie à</label>
        <input type="text" class="form-control col-8" id="email-copie" name="email-copie"><span class="col-4">@<?php echo $domain ?></span>
    </div>

    <div class="form-group">
        <label for="debut">Début <span class="text-danger">*</span></label>
        <input type="date" required class="form-control" id="debut" name="debut" value="<?php echo $dateDebut ?>">
    </div>

    <div class="form-group">
        <label for="fin">Fin <span class="text-danger">*</span></label>
        <input type="date" required class="form-control" id="fin" name="fin" value="<?php echo $dateFin ?>">
    </div>

    <button type="submit" class="btn btn-primary px-4" name="action" value="<?php echo $action ?>">Valider</button>
</form>