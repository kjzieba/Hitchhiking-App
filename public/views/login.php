<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>Log In</title>
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
    <div class="login-container">
        <form class="login-form" action="login" method="post" autocomplete="off">
            <div class="messages">
                <?php if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <h2>
                Log in to your RideShare account
            </h2>
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button type="submit">Log In</button>
            <hr class="solid-line">
            <p>Don't have an account? <a href="register">Sign up</a></p>
        </form>
    </div>
</div>
</body>