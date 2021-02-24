<?php include('header.php') ?>

    <div class="container d-flex justify-content-center">
        <div class="col-lg-6 p-0">
            <div class="card mt-3">
                <div class="card-header p-3">
                    Activer votre répondeur
                </div>
                <div class="card-body p-3">
                    <form action="/" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email"><span>@ladefoule.fr</span>
                            </div>
                            <div class="form-group col-md-6">
                                <!-- <label for="inputPassword4">Password</label>
                                <input type="password" class="form-control" id="inputPassword4"> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content">Message</label>
                            <textarea class="form-control" id="content" name="message"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="copie" name="copie">
                                <label class="form-check-label" for="copie">
                                    Garder une copie
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email-copie">Envoyer la copie à :</label>
                            <input type="email" class="form-control" id="email-copie" name="email-copie" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="debut">Début :</label>
                            <input type="date" class="form-control" id="debut" name="debut">
                        </div>

                        <div class="form-group">
                            <label for="fin">Fin :</label>
                            <input type="date" class="form-control" id="fin" name="fin">
                        </div>

                        <button type="submit" class="btn btn-primary" name="responder_post">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  </body>
</html>
