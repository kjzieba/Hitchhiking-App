<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>Sign up</title>
</head>
<body>
<div class="container">
    <div class="logo-text">
        <h1>
            RideShare
        </h1>
        <h2>
            Share your car with others!
        </h2>
    </div>
    <div class="register-container">
        <form class="register-form" action="register" method="post">
            <div class="messages">
                <?php if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <h2>
                Sign up for RideShare
            </h2>
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <input name="password-repeat" type="password" placeholder="repeat password">
            <input name="name" type="text" placeholder="name">
            <input name="surname" type="text" placeholder="surname">
            <button type="submit">Sign up</button>
            <hr class="solid-line">
            <p>Already have an account? <a href="login">Log in</a></p>
        </form>
    </div>
</div>
</body>