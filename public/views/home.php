<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>RideShare</title>
</head>
<body>
<div class="main-container">
    <?php include ('public/views/components/navbar.php'); ?>
    <div class="content">
        <div class="search">
            <form class="search-form" action="search" method="post">
                <h2>Look for a ride</h2>
                <input name="start" type="text" placeholder="start">
                <input name="destination" type="text" placeholder="destination">
                <input name="passengers" type="number" placeholder="passengers">
                <input name="date" type="date" placeholder="date">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="add">
            <h2>Want to share your car on your trip?</h2>
            <form action="ride">
                <button class="add-button" type="submit">Add</button>
            </form>
        </div>
    </div>
</div>
</body>