<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/rides.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>My Rides</title>
</head>
<body>
<div class="main-container">
    <?php include('public/views/components/navbar.php'); ?>
    <div class="search">
        <div class="head">
            <a class="a-btn" href="home">
                <h2> <-- </h2>
            </a>
            <h2>My Rides</h2>
            <input name="search-field" type="text" placeholder="search">
        </div>
        <section class="search-results">
            <?php if ($rides != null): ?>
                <?php foreach ($rides as $ride): ?>
                    <div id="<?= $ride->getID(); ?>">
                        <div class="info-time-place">
                            <p><?= $ride->getTime(); ?></p>
                            <p><?= $ride->getStart(); ?></p>
                            <p> -> </p>
                            <p><?= $ride->getTime(); ?></p>
                            <p><?= $ride->getDestination(); ?></p>
                        </div>
                        <div class="info-passengers-driver">
                            <p><?= $ride->getAvailableSeats(); ?></p>
                            <p>seats left</p>
                            <p id="driver"><?= $ride->getDriver(); ?></p>
                        </div>
                        <div class="info-badges">
                            <img src="public/img/no-pets.jpg">
                            <img src="public/img/no-smoking.jpg">
                        </div>
                        <button>See details</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                You have no rides. You can add your ride or join others' rides!
            <?php endif; ?>
        </section>
    </div>
</div>
</body>