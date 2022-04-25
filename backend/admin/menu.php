<?php

$userObject = new User();

$user = null;

if (isset($_SESSION['userId'])) {
    $user = $userObject->getUserById($_SESSION['userId']);
}

function generateLink($linkTo, $linkTitle)
{
    $link = '<a class="nav-link';

    if (isset($_GET['page']) && $linkTo === $_GET['page']) {
        $link .= ' active';
    }
    $link .= '" href="?page=' . $linkTo . '">' . $linkTitle . '</a>';

    return $link;
}
?>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <?= generateLink('blog', 'Blog'); ?>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Prisijungęs kaip: <?= $user['username']; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="nav-item">
                                <a class="nav-link" href="?page=logout">Atsijungti</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>