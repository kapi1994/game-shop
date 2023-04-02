<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php
                if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']->role_id == 1) :
                ?>
                    <li class="nav-item"><a href="index.php?page=contact" class="nav-link">Contact</a></li>
                <?php elseif (isset($_SESSION['user']) && $_SESSION['user']->role_id == 2) : ?>
                    <li class="nav-item"><a href="admin.php?page=home" class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'home') : ?> active border-bottom fw-bold <?php endif; ?>">Home</a></li>
                    <li class="nav-item"><a href="admin.php?page=publishers" class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'publishers') : ?> border-bottom fw-bold active <?php endif; ?>">Publishers</a></li>
                    <li class="nav-item"><a href="admin.php?page=platforms" class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'platforms') : ?> active fw-bold border-bottom <?php endif; ?>">Platforms</a></li>
                    <li class="nav-item"><a href="admin.php?page=games" class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'games') : ?> fw-bold active border-bottom <?php endif; ?>">Games</a></li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li class="nav-item"><a href="index.php?page=login" class="nav-link
                <?php if (isset($_GET['page']) && $_GET['page'] == 'login') : ?> fw-bold active border-bottom <?php endif; ?>
                ">Log in</a></li>
                    <li class="nav-item"><a href="index.php?page=register" class="nav-link
                <?php if (isset($_GET['page']) && $_GET['page'] == 'register') : ?> active border-bottom fw-bold <?php endif; ?>
                ">Register</a></li>
                <?php else : ?>
                    <li class="nav-item"><a href="models/auth/logout.php" class="nav-link">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>