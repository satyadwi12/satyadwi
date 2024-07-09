<?php
session_start();

// Function to generate a simple arithmetic CAPTCHA
function generateCaptcha() {
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $captcha = $num1 + $num2;

    // Store the correct answer in the session
    $_SESSION['captcha'] = $captcha;

    // Return the equation as a string
    return "$num1 + $num2 = ?";
}

if (isset($_POST['login'])) {
    // Validate CAPTCHA
    if ($_POST['captcha'] == $_SESSION['captcha']) {
        // CAPTCHA validation passed

        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $query = mysqli_query($koneksidb, $sql);
        $results = mysqli_fetch_array($query);

        if (mysqli_num_rows($query) > 0) {
            $_SESSION['ulogin'] = $_POST['email'];
            $_SESSION['fname'] = $results['nama_user'];
            $currentpage = $_SERVER['REQUEST_URI'];
            echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
        } else {
            echo "<script>alert('Email atau Password Salah!');</script>";
        }
    } else {
        echo "<script>alert('CAPTCHA verification failed!');</script>";
    }
}
?>

<div class="modal fade" id="loginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Login</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Alamat Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <p><?php echo generateCaptcha(); ?></p>
                  <input type="text" class="form-control" name="captcha" placeholder="Jawaban CAPTCHA">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember">            
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Belum punya akun? <a href="regist.php">Daftar Disini</a></p>
      </div>
    </div>
  </div>
</div>
