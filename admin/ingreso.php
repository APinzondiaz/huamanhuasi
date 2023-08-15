<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Educational Bootstrap 5 Login Page Website Tampalte</title>
  </head>
  <body>
    <section class="form-02-main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="_lk_de">
              <div class="form-03-main">
                <div class="logo">
                  <img src="assets/images/user.png">
                </div>
                <form id="form1" name="form1" method="post" action="controller_login.php">
                <div class="form-group">
                  <input type="text" name="usuario" class="form-control _ge_de_ol" type="text" placeholder="Ingrese el usuario" required="" aria-required="true">
                </div>

                <div class="form-group">
                  <input type="password" name="clave" class="form-control _ge_de_ol" type="text" placeholder="Ingrese su clave" required="" aria-required="true">
                  <input name="entrar" type="hidden" id="entrar" value="entrar" />
                </div>

                <div class="checkbox form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="">
                    <label class="form-check-label" for="">
                      Remember me
                    </label>
                  </div>
                  <a href="#">Forgot Password</a>
                </div>

                <div class="form-group">
                  <div class="_btn_04">
                  <input name="login" id="login" type="submit" value="Ingresar">
                  </div>
                </div>
                </form>
                <div class="form-group nm_lk"><p>Or Login With</p></div>

                <div class="form-group pt-0">
                  <div class="_social_04">
                    <ol>
                      <li><i class="fa fa-facebook"></i></li>
                      <li><i class="fa fa-twitter"></i></li>
                      <li><i class="fa fa-google-plus"></i></li>
                      <li><i class="fa fa-instagram"></i></li>
                      <li><i class="fa fa-linkedin"></i></li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>