<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="http://localhost/project/public/assets/css/login_signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm" action="index.php?url=login/processLogin" method="POST" novalidate autocomplete="off">
            <label for="email">Email</label>
            <input type="text" 
                   id="email" 
                   name="email" 
                   autocomplete="username"
                   autocorrect="off"
                   autocapitalize="off"
                   spellcheck="false">
            <div class="red-text">
                <?php echo isset($data['errors']['email']) ? $data['errors']['email'] : ''; ?>
            </div>

            <label for="password">Password</label>
            <input type="password" 
                   id="password" 
                   name="password" 
                   autocomplete="off"
                   readonly
                   onfocus="this.removeAttribute('readonly');">
            <div class="red-text">
                <?php echo isset($data['errors']['password']) ? $data['errors']['password'] : ''; ?>
            </div>

            <button type="submit" name="submit" value="submit" class="btn">Login</button>
            <a class="waves-effect waves-teal btn-flat" href="index.php?url=signup/index">SignUp</a>
            <a class="waves-effect waves-teal btn-flat" href="index.php?url=forgetpassword/index">Forget Password</a>
        </form>
    </div>
    <script src="http://localhost/project/public/assets/js/login.js"></script>
</body>
</html>