<div class="col-md-8 p-0">
    <div class="card">
        <div class="card-header">Gestion de votre répondeur</div>
        <div class="card-body">
            <form method="POST">
                <div class="form-row pb-3">
                    <label for="account" class="col-12">Email <span class="text-danger">*</span></label>
                    <input type="text" required disabled class="form-control col-8" id="account" value="<?php echo $account ?>"><span class="col-4">@<?php echo $domain ?></span>
                    <input type="hidden" name="account" value="<?php echo $account ?>">
                </div>

                <div class="form-group">
                    <label for="content">Message <span class="text-danger">*</span></label>
                    <textarea class="form-control" required <?php if($action == 'delete') echo 'disabled'; ?> rows="10" id="content" name="content"><?php echo $content ?></textarea>
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" <?php if($action == 'delete') echo 'disabled'; ?> id="copy" name="copy" value="<?php echo $copy ?>">
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
                    <input type="date" required <?php if($action == 'delete') echo 'disabled'; ?> class="form-control" id="from" name="from" value="<?php echo $from ?>">
                </div>

                <div class="form-group">
                    <label for="to">to <span class="text-danger">*</span></label>
                    <input type="date" required <?php if($action == 'delete') echo 'disabled'; ?> class="form-control" id="to" name="to" value="<?php echo $to ?>">
                </div>

                <button type="submit" class="btn btn-<?php echo $actions[$action]['class'] ?> px-4" name="action" value="<?php echo $action ?>"><?php echo $actions[$action]['button'] ?></button>
            </form>
        </div>
    </div>
</div>

<script>
    var textarea = document.querySelector('textarea');

    textarea.addEventListener('keydown', autosize);
                
    function autosize(){
        var el = this;
        setTimeout(function(){
            el.style.cssText = 'height:auto; padding:0';
            // for box-sizing other than "content-box" use:
            // el.style.cssText = '-moz-box-sizing:content-box';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
        },0);
    }
</script>