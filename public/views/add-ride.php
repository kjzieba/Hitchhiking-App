<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/add-ride.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>Add ride</title>
</head>
<body>
<div class="main-container">
    <?php include('public/views/components/navbar.php'); ?>
    <div class="add-ride">
        <div class="head">
            <a class="a-btn" href="home">
                <h2> <-- </h2>
            </a>
            <h2>Add ride</h2>
        </div>
        <form class="add-ride-form" action="ride" method="post">
            <input name="start" type="text" placeholder="start">
            <input name="destination" type="text" placeholder="destination">
            <input name="date" type="date" placeholder="date">
            <input name="time" type="time" placeholder="time">
            <input name="available-seats" type="number" placeholder="available seats">
            <button type="submit">Add</button>
        </form>
    </div>
</div>
</body>