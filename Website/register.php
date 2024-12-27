<?php 

session_start();

include('server/connection.php');

//Si el usuario ya se ha registrado, lleve al usuario a la página de la cuenta
if(isset($_SESSION['logged_in'])){
    header('location: account.php');
       exit;
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Si tus contraseñas no son similares
    if ($password !== $confirmPassword) {
        header('location: register.php?error=las contraseñas no coinciden');
    } 
    // Si tu contraseña tiene menos de 6 caracteres
    else if (strlen($password) < 6) {
        header('location: register.php?error=La contraseña debe tener al menos 6 caracteres');
    } 
    // Si no hay ningún error
    else {
        // Compruebe si hay un usuario con este correo electrónico o no
        $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();

        // Si ya hay un usuario registrado en el correo electrónico
        if ($num_rows != 0) {
            header('location: register.php?error=el usuario con este email ya existe');
        } 
        // Si ningún usuario se registró con este correo electrónico antes 
        else {
            // Crear un nuevo usuario
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $name, $email, md5($password));

            // Si la cuenta fue creada exitosamente
            if ($stmt->execute()) {
                $user_id = $stmt->insert_id;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: account.php?register_success=Tu registro fue exitoso');
            } 
            // No se pudo crear la cuenta
            else {
                header('location: register.php?error=La cuenta no puede ser creada en este momento');
            }
        }
    }


}
   





?>


<?php

include('layouts/header.php');

?>


    <!--Register-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Registro</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST" action="register.php">
                <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error']; }?></p>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required/>
                </div>
                <div class="form-group">
                    <label>Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Register"/>
                </div>
                <div class="form-group">
                    <a id="login-url" href="" class="btn">Tienes una cuenta? Login</a>
                </div>
            </form>
        </div>
    </section>



<?php

include('layouts/footer.php');

?>