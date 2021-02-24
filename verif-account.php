


<!-- <div class="form-group">
    <label for="inputPassword4">Password <span class="text-danger">*</span></label>
    <input type="password" required class="form-control" id="inputPassword4">
</div> -->

<?php include('header.php') ?>
    <div class="col-lg-8 p-0">
        <div class="card">
            <div class="card-header text-success p-3">
                Gestion de votre répondeur
            </div>
            <div class="card-body p-3">
                <form action="/" method="POST">
                    <div class="form-row pb-3">
                        <label for="email" class="col-12">Email <span class="text-danger">*</span></label>
                        <input type="text" required class="form-control col-8" id="email" name="email"><span class="col-4">@<?php echo $domain ?>r</span>
                    </div>

                    <button type="submit" class="btn btn-primary px-4" name="method" value="POST">Valider</button>
                </form>
            </div>
        </div>
    </div>
<?php include('footer.php') ?>