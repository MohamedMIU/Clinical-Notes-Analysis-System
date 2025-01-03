<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="http://localhost/project/public/assets/css/login_signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form id="signupForm" action="index.php?url=signup/processSignup" method="POST" novalidate autocomplete="off">
            <label for="email">Email</label>
            <input type="text" 
                   id="email" 
                   name="email" 
                   autocomplete="off"
                   autocorrect="off"
                   autocapitalize="off"
                   spellcheck="false"
                   value="<?php echo htmlspecialchars($data['data']['email'] ?? ''); ?>">
            <div class="red-text">
                <?php echo $data['errors']['email'] ?? ''; ?>
            </div>

            <label for="password">Password</label>
            <input type="password" 
                   id="password" 
                   name="pass" 
                   autocomplete="off"
                   readonly
                   onfocus="this.removeAttribute('readonly');">
            <div class="red-text">
                <?php echo $data['errors']['pass'] ?? ''; ?>
            </div>

            <label for="username">Username</label>
            <input type="text" 
                   id="username" 
                   name="username" 
                   autocomplete="off"
                   autocorrect="off"
                   autocapitalize="off"
                   spellcheck="false"
                   value="<?php echo htmlspecialchars($data['data']['username'] ?? ''); ?>">
            <div class="red-text">
                <?php echo $data['errors']['username'] ?? ''; ?>
            </div>

            <button type="submit" name="submit" value="submit" class="btn">Sign Up</button>
            <a class="waves-effect waves-teal btn-flat" href="index.php?url=login/index">Already have an account? Login</a>
        </form>
    </div>
    <script src="http://localhost/project/public/assets/js/signup.js"></script>
</body>
</html>