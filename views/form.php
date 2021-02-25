<form action="/" method="POST">
    <div class="form-row pb-3">
        <label for="account" class="col-12">Email <span class="text-danger">*</span></label>
        <input type="text" required disabled class="form-control col-8" id="account" value="<?php echo $account ?>"><span class="col-4">@<?php echo $domain ?></span>
        <input type="hidden" name="account" value="<?php echo $account ?>">
    </div>

    <div class="form-group">
        <label for="content">Message <span class="text-danger">*</span></label>
        <textarea class="form-control" required id="content" name="message"><?php echo $content ?></textarea>
    </div>
    
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="copy" name="copy" value="<?php echo $copy ?>">
            <label class="form-check-label" for="copy">
                Garder une copie du mail
            </label>
        </div>
    </div>

    <!-- <div class="form-row pb-3">
        <label for="copyTo" class="col-12">Envoyer la copie à</label>
        <input type="text" class="form-control col-8" id="copyTo" name="copyTo"><span class="col-4">@<?php //echo $copyTo ?></span>
    </div> -->

    <div class="form-group">
        <label for="from">Début <span class="text-danger">*</span></label>
        <input type="date" required class="form-control" id="from" name="from" value="<?php echo $from ?>">
    </div>

    <div class="form-group">
        <label for="to">to <span class="text-danger">*</span></label>
        <input type="date" required class="form-control" id="to" name="to" value="<?php echo $to ?>">
    </div>

    <button type="submit" class="btn btn-primary px-4" name="api" value="<?php echo $actions[$route][1] ?>"><?php echo $actions[$route][0] ?></button>
</form>