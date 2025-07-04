<?php
session_start();
$msg = '';
try {
    $conex = new PDO("mysql:host=localhost; dbname=practica", "root", "");
    $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_POST["login"])) {
        if (empty($_POST["email"]) || empty($_POST["password"])) {
            $msg = '<label>Todos los campos son requeridos</label>';
        } else {
            $sql = "SELECT * FROM usuario WHERE email = :correo";
            $stmt = $conex->prepare(query: $sql);
            $stmt->execute(params: array(':correo' => $_POST["email"]));
            $sqlresult = $stmt->fetch(PDO::FETCH_ASSOC);            
            if ($sqlresult) {
                $_SESSION["email"] = $_POST["email"];
                header("location:index.php");
            } else {
                $msg = '<label>Datos incorrectos del usuario</label>';
            }
        }
    }
} catch (PDOException $error) {
    $msg = $error->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Hipermarker</span>
                </a>
              </div><!-- End Logo -->
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Inicio de Sesión</h5>
                    <p class="text-center small"><b>Ingrese su usuario & constraseña</b></p>
                  </div>
                  <?php if (isset($msg)) { echo '<div class="alert alert-danger">'.$msg.'</div>'; } ?>
                  <form class="row g-3 needs-validation" action="" method="POST" novalidate>
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="text" name="email" class="form-control" id="email" required>
                        <div class="invalid-feedback">Por favor ingrese su email.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Por favor ingrese su contraseña!</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" id="login" name="login" type="submit">Login</button>
                    </div>
                    </form>
                </div>
              </div>
              <div class="credits">
               Diseñado por <a href="https://bootstrapmade.com/">S&S</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
</html>
