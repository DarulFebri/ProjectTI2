<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="row">
        <div class="col-lg-4 mx-auto mt-4">
            <h1 class="text-center">Login Form</h1>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Login">
            </form>
            <?php
            if (isset($_POST['submit'])) {
                require 'koneksi.php';
                $email = $_POST['email'];
                $password = md5($_POST['password']);

                $query = mysqli_query($koneksi, "SELECT * FROM user 
                WHERE email='$email' AND password='$password' ");

                if (mysqli_num_rows($query) > 0) {
                    session_start();
                    $data = mysqli_fetch_array($query);
                    $_SESSION['login'] = TRUE;
                    $_SESSION['nama'] = $data['nama_lengkap'];
                    $_SESSION['level'] = $data['level'];
                    $_SESSION['email'] = $data['email'];
                    header("Location: index.php");
                } else {
                    echo "<script>alert('Sandi atau email yang anda masukan salah!');window.location='index.php?page=login'</script>";
                }
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>