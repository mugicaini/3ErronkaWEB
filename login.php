<?php
session_start();
require_once 'includes/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM bezeroak WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Since DB shows plain text passwords in the example (Aitor Etxebarria -> 1MG3), 
    // we'll check both plain and hashed for robustness.
    if ($user && ($password === $user['pasahitza'] || password_verify($password, $user['pasahitza']))) {
        $_SESSION['user_id'] = $user['id_bezeroa'];
        $_SESSION['izen_abizenak'] = $user['izena'] . " " . $user['abizena'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Emaila edo pasahitza okerrak dira.";
    }
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sartu - IRON STRENGTH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,800;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body class="<?php echo $gaia; ?>">
    <?php include 'includes/nav.php'; ?>
    <div class="login-container">
        <div class="login-card">
            <h1 class="serif brand-sub">Iron Strength</h1>
            <h2 class="serif login-title">Sartu</h2>
            
            <?php if($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>Email helbidea</label>
                    <input type="email" name="email" required placeholder="adibidea@email.com">
                </div>
                <div class="form-group">
                    <label>Pasahitza</label>
                    <input type="password" name="password" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn-primary-login">Sartu orain</button>
            </form>
            
            <div class="login-footer">
                <p class="login-footer-text">
                    Ez daukazu konturik oraindik?
                </p>
                <a href="index.php#prezioak" class="serif plan-link">Ezagutu gure planak</a>
            </div>
            
            <div class="back-link-wrapper">
                <a href="index.php" class="back-link">Atzera hasierara</a>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
