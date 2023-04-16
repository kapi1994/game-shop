<?php
$userMenuItems = userMenu();
$adminMenuItems = adminMenu();
$homeLink = "";
if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']->role_id == 1) {
    $homeLink = "index.php?page=home";
} else if (isset($_SESSION['user']) && $_SESSION['user']->role_id == 2) {
    $homeLink = "admin.php?page=home";
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand text-danger fw-bold" href="<?= $homeLink ?>">G<span class="text-dark">-pad</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php
                if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']->role_id == 1) :
                    foreach ($userMenuItems as $userMenuItem) :
                        $menuName = $userMenuItem->name;
                ?>
                        <li class="nav-item"><a href="index.php?page=<?= strtolower($menuName) ?>" class="nav-link
                            <?php if (isset($_GET['page']) && $_GET['page'] == strtolower($menuName)) : ?> fw-bold active border-bottom<?php endif; ?>
                        "><?= $menuName ?></a></li>
                    <?php
                    endforeach;
                elseif (isset($_SESSION['user']) && $_SESSION['user']->role_id == 2) :
                    foreach ($adminMenuItems as $adminMenuItem) :
                        $menuName = $adminMenuItem->name; ?>
                        <li class="nav-item"><a href="admin.php?page=<?= strtolower($menuName) ?>" class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == strtolower($menuName)) : ?> active border-bottom fw-bold <?php endif; ?>"><?= $menuName ?></a></li>

                <?php endforeach;
                endif; ?>
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
                    <?php
                    if (isset($_SESSION['user']) && $_SESSION['user']->role_id == 1) : ?>
                        <li class="nav-item"><a href="index.php?page=cart" class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'cart') : ?> fw-bold active border-bottom <?php endif; ?>">Cart</a></li>
                        <li class="nav-item"><a href="index.php?page=wishlist" class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'wishlist') : ?> fw-bold active border-bottom <?php endif; ?> ">Wishlist</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a href="models/auth/logout.php" class="nav-link">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>