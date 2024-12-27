<?php
session_start();
include('server/connection.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_panel.php');
        exit;
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Admin</title>
</head>
<body>
    <form method="POST">
        <h2>Iniciar Sesión - Administrador</h2>
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit" name="login">Iniciar Sesión</button>
    </form>
</body>
</html>
