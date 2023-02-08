<!DOCTYPE html>
<script type="text/javascript" src="../public/js/dropdown.js" defer></script>
<div class="nav">
    <ul>
        <li>
            <div class="logo-text">
                <a class="a-btn" href="../home">
                    <h2>RideShare</h2>
                </a>
            </div>
        </li>
        <li>
            <?php if (isset($_COOKIE['user'])): ?>
                <h2>
                    <?= $_COOKIE['user']; ?>
                </h2>
            <?php else: ?>
                <div class="login-register-buttons">
                    <form action="login" method="get">
                        <button>Login</button>
                    </form>
                    <form action="register" method="get">
                        <button>Sign up</button>
                    </form>
                </div>
            <?php endif; ?>
        </li>
        <li>
            <div class="settings">
                <button>
                    <h2>
                        |||
                    </h2>
                </button>
                <div class="menu">
                    <button onclick="location.href='rides';">My rides</button>
                    <hr class="solid-line">
                    <form action="logout" method="get">
                        <button>Logout</button>
                    </form>
                </div>
            </div>
        </li>
    </ul>
</div>