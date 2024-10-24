<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$validUsername = 'user@example.com'; // Ganti dengan email yang valid
$validPassword = 'your_password'; // Ganti dengan password yang valid

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $message = "Must be filled.";
    } elseif (strlen($password) < 6) {
        $message = "Password must be more than 6 characters.";
    } elseif (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
        $message = "Password must contain both uppercase and lowercase letters.";
    } else {
        // Memeriksa kredensial
        if ($username === $validUsername && $password === $validPassword) {
            $_SESSION['username'] = $username; // Simpan username di session
            error_log("Login success, redirecting to main.php");
            header("Location: main.php"); // Arahkan ke halaman utama
            exit();
        } else {
            error_log("Login failed, wrong username or password");
            $message = "Login gagal, silakan coba lagi.";
        }
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laundry</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <form class="needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <h1 class="h3 mb-3 fw-normal text-center">PLEASE LOG IN</h1>

            <?php if (!empty($message)): ?>
                <div class="alert alert-danger text-center"><?php echo $message; ?></div>
            <?php endif; ?>

            <div class="form-floating">
                <input name="username" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
                <div class="invalid-feedback">
                    Masukan Email Yang Valid
                </div>
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
                <div class="invalid-feedback">
                    Masukan Password.
                </div>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
        </form>
    </main>
</body>
</html>
