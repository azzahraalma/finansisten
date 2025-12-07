<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="style_index.css">
</head>

<body class="form-page">
    <div class="falling-coin">
        <img src="img/coin.png" class="coin">
        <img src="img/coin.png" class="coin">
        <img src="img/coin.png" class="coin">
        <img src="img/coin.png" class="coin">
        <img src="img/coin.png" class="coin">
        <img src="img/coin.png" class="coin">
        <img src="img/coin.png" class="coin">
        <img src="img/coin.png" class="coin">
        <img src="img/coin.png" class="coin">
        <img src="img/coin.png" class="coin">
    </div>
    <div class="form-box">
        <a href="index.php" class="cancel-btn"aria-label="batal">x</a>
        <form action="register_proses.php" method="post">
            <h2 class="form-title-h2">Daftar</h2>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="info">
                <p class="user-info">Sudah punya akun? <a href="login.php">Masuk</a></p>
            </div>

            <div class="form-buttons">
                <input type="submit" value="Daftar">
            </div>
        </form>
        <?php if (isset($_GET['error'])): ?>
            <div class="overlay">
                <div class="popup">
                    <p>Username sudah digunakan, coba yang lain.</p>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
                <div class="overlay">
                    <div class="popup">
                        <p>login berhasil</p>
                        <meta http-equiv="refresh" content="3s; url=dashboard.php">
                    </div>
                <?php endif; ?>
            </div>
</body>

</html>