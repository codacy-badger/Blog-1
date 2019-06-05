<?php
use Blog\App\Entity\Session;

$serializePassword = file_get_contents('store');
$sessionPassword = unserialize($serializePassword);
$key = $sessionPassword->getPassword();
$session = new Session($key);
$sessionId = $session->getCookie('id');
$sessionStatut = $session->getCookie('statut');
$sessionUsername = $session->getCookie('username');

$title = "Connexion";
require_once '../View/layout.php' ; ?>


<body>
<?php require '../View/header.php' ; ?>


<h1><?= filter_var($title, FILTER_SANITIZE_FULL_SPECIAL_CHARS); ?></h1>

<?php
if(!empty($sessionId)){
    echo filter_var($alert, FILTER_UNSAFE_RAW); ?>
    <div class="text-center">
        <?php echo '<p>Bienvenue ' . filter_var($sessionUsername, FILTER_SANITIZE_FULL_SPECIAL_CHARS) . '</p>';
        echo '<form action="' . filter_var($directory, FILTER_SANITIZE_FULL_SPECIAL_CHARS) . '/index.php?access=user!logout" method="post"><button class="btn btn-primary" type="submit" name="logout">Se déconnecter</button></form>'; ?>
    </div>
<?php }
else{
    echo filter_var($alert, FILTER_UNSAFE_RAW); ?>

    <div class="login">
        <h2 class="text-center">Inscription</h2>
        <form class="mb-5" action="<?= filter_var($directory, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>/index.php?access=user!register" method="post">
            <div class="d-flex">
                <label for="lastname">Nom de famille</label>
                <input type="text" id="lastname" name="lastname" value="<?= filter_input(INPUT_GET, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>"/>
            </div>
            <div class="d-flex">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" value="<?= filter_input(INPUT_GET, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>"/>
            </div>
            <div class="d-flex">
                <label for="email">Votre Email</label>
                <input type="email" id="email" name="email" value="<?= filter_input(INPUT_GET, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>"/>
            </div>
            <div class="d-flex">
                <label for="username">Pseudonyme</label>
                <input type="text" id="username" name="username" value="<?= filter_input(INPUT_GET, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>"/>
            </div>
            <div class="d-flex">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password"/>
            </div>
            <div class="d-flex">
                <label for="confirm_password">Confirmer votre mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password"/>
            </div>
            <div class="text-center">
                <button class="btn btn-success" type="submit" name="register">S'inscrire</button>
            </div>
        </form>


        <h2 class="text-center">Connexion</h2>
        <form class="mb-5" action="<?= filter_var($directory, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>/index.php?access=user!login" method="post">
            <div class="d-flex">
                <label for="usernamemail">Pseudonyme / Email </label>
                <input type="text" id="usernamemail" name="usernamemail" value="<?= filter_input(INPUT_GET, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>"/>
            </div>
            <div class="d-flex">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password"/>
            </div>
            <div class="text-center">
                <button class="btn btn-success" type="submit" name="login">Se Connecter</button>
            </div>
        </form>
    </div>
<?php }
?>




</body>

