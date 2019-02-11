<?php 

include 'inc/header.inc.php'; 

if (isset($_COOKIE['User'])) {
    $_SESSION['is_auth'] = true;
}

if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == true) {
    header("Location: index.php");
    exit();
}

?>

<main>
    <div class="container">

        <h1 class="display-4  text-center mt-5">Zaloguj się</h1>

        <?php 
            if (isset($_SESSION['e_login'])) {
                echo '<div class="text-danger text-center pb-3 mt-3">'.$_SESSION['e_login'].'</div>';
                unset($_SESSION['e_login']);
            }
        ?>

        <form action="inc/login.inc.php" method="post" class="w-50 p-3 mx-auto mt-5">

            <div class="form-group">
                <label for="email">Adres email</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                    placeholder="jankowaliski@mail.com"
                    <?php
                            if (isset($_SESSION['email'])) {
                                echo 'value="'.$_SESSION['email'].'"';
                                unset($_SESSION['email']);
                            }
                        ?>>
            </div>
            <div class="form-group">
                <label for="password">Hasło</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="********">
            </div>

            <button type="submit" class="btn btn-primary" name="login_submit">Submit</button>
        </form>
    </div>

</main>

<?php include 'inc/footer.inc.php'; ?>