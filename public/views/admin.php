<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/rides.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>Admin Dashboard</title>
</head>
<body>
<div class="main-container">
    <?php include('public/views/components/navbar.php'); ?>
    <section class="admin">
        <div class="user-info">
            <h2>ID</h2>
            <h2>Name</h2>
            <h2>Action</h2>
        </div>
        <hr class="solid-line">

        <?php if ($users != null): ?>
            <?php foreach ($users as $user): ?>
                <div class="user-info">
                    <p><?= $user->getID() ?></p>
                    <p><?= $user->getName() ?></p>
                    <form action="delete/<?= $user->getID() ?>" method="post">
                        <button>Delete</button>
                    </form>
                </div>
                <hr class="solid-line">
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</div>
</body>