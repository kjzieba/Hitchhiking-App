<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/rides.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>RideShare</title>
</head>
<body>
<div class="main-container">
    <div class="nav">
        <ul>
            <li>
                <div class="logo-text">
                    <h2>Search rides</h2>
                </div>
            </li>
            <li>
                <h2>John</h2>
            </li>
            <li>
                <img src="public/img/settings.svg" alt="settings">
            </li>
        </ul>
    </div>
    <div class="search">
        <div class="head">
            <h2> <-- </h2>
            <h2>Search results</h2>
        </div>
        <section class="search-results">
            <div id="ride-1">
                <div class="info-time-place">
                    <p>10:00</p>
                    <p>Warsaw</p>
                    <p> -> </p>
                    <p>13:30</p>
                    <p>Cracow</p>
                </div>
                <div class="info-passengers-driver">
                    <p>2</p>
                    <p>seats left</p>
                    <p id="driver">Bob</p>
                </div>
                <div class="info-badges">
                    <img src="public/img/no-pets.jpg">
                    <img src="public/img/no-smoking.jpg">
                </div>
                <button>See details</button>
            </div>
            <div id="ride-2">
                <div class="info-time-place">
                    <p>10:00</p>
                    <p>Warsaw</p>
                    <p> -> </p>
                    <p>13:30</p>
                    <p>Cracow</p>
                </div>
                <div class="info-passengers-driver">
                    <p>2</p>
                    <p>seats left</p>
                    <p id="driver">Bob</p>
                </div>
                <div class="info-badges">
                    <img src="public/img/no-pets.jpg">
                    <img src="public/img/no-smoking.jpg">
                </div>
                <button>See details</button>
            </div>
        </section>
    </div>
</div>
</body>