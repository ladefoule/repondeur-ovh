<div class="col-lg-8 p-0">
    <div class="card">
        <div class="card-header p-3">
            Gestion de votre répondeur
        </div>
        <div class="card-body p-3">
            <form action="/" method="POST">
                <div class="form-row pb-3">
                    <label for="account" class="col-md-3 col-form-label text-md-right"><span class="text-danger">*</span> Email</label>
                    <div class="col-md-9 d-flex align-items-center">
                        <input type="text" required class="form-control col-6" id="account" name="account">
                        <span class="col-6">@<?php echo $domain ?>r</span>
                    </div>
                </div>

                <div class="form-row pb-3">
                    <label for="password" class="col-md-3 col-form-label text-md-right"><span class="text-danger text-weight-bold">*</span> Mot de passe</label>
                    <div class="col-md-9">
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                </div>

                <div class="form-row pb-3">
                    <div class="offset-md-3 col-md-9">
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                        <!-- <button type="submit" class="btn btn-primary" name="action" value="POST">Créer</button>
                        <button type="submit" class="btn btn-info" name="action" value="GET">Voir</button>
                        <button type="submit" class="btn btn-warning" name="action" value="PUT">Modifier</button>
                        <button type="submit" class="btn btn-danger" name="action" value="DELETE">Supprimer</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>