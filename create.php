<?php include('header.php') ?>
    <div class="col-lg-8 p-0">
        <div class="card">
            <div class="card-header p-3">
                Activer votre répondeur
            </div>
            <div class="card-body p-3">
                <form action="/" method="POST">
                    <div class="form-row pb-3">
                        <label for="email" class="col-12">Email <span class="text-danger">*</span></label>
                        <input type="text" required class="form-control col-8" id="email" name="email"><span class="col-4">@ladefoule.fr</span>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword4">Password <span class="text-danger">*</span></label>
                        <input type="password" required class="form-control" id="inputPassword4">
                    </div>

                    <div class="form-group">
                        <label for="content">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control" required id="content" name="message"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="copie" name="copie">
                            <label class="form-check-label" for="copie">
                                Garder une copie du mail
                            </label>
                        </div>
                    </div>

                    <div class="form-row pb-3">
                        <label for="email-copie" class="col-12">Envoyer la copie à</label>
                        <input type="text" class="form-control col-8" id="email-copie" name="email-copie"><span class="col-4">@ladefoule.fr</span>
                    </div>

                    <div class="form-group">
                        <label for="debut">Début <span class="text-danger">*</span></label>
                        <input type="date" required class="form-control" id="debut" name="debut">
                    </div>

                    <div class="form-group">
                        <label for="fin">Fin <span class="text-danger">*</span></label>
                        <input type="date" required class="form-control" id="fin" name="fin">
                    </div>

                    <button type="submit" class="btn btn-primary px-4">Valider</button>
                </form>
            </div>
        </div>
    </div>
<?php include('footer.php') ?>
