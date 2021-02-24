
<?php include('header.php') ?>
    <div class="col-lg-8 p-0">
        <div class="card">
            <div class="card-header text-info p-3">
                Visualiser votre répondeur
            </div>
            <div class="card-body p-3">
                <form action="/" method="POST">
                    <?php include('verif-account.php') ?>
                    <button type="submit" class="btn btn-primary px-4" name="method" value="DELETE">Valider</button>
                </form>
            </div>
        </div>
    </div>
<?php include('footer.php') ?>
