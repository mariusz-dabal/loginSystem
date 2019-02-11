<?php include "inc/header.inc.php";?>

<main>
    <div class="container">

        <h1 class="display-4 text-center mt-5">Zarejestruj się</h1>

        <?php 
            if (isset($_SESSION['e_form'])) {
                foreach ($_SESSION['e_form'] as $key => $value) {
                    echo '<div class="text-danger text-center">'.$_SESSION["e_form"][$key].'</div>';
                }
                
                unset($_SESSION['e_form']);      
            }
        ?>

        <form action="inc/register.inc.php" method="post" class="w-50 p-3 mx-auto mt-5">

            <div class="form-group">
                <label for="firstName">Imię</label>
                <input type="text" name="first_name" class="form-control" id="firstName" placeholder="Jan"
                    <?php
                            if (isset($_SESSION['first_name'])) {
                                echo 'value="'.$_SESSION['first_name']
                                .'"';
                                unset($_SESSION['first_name']);
                            }
                        ?>>
            </div>

            <div class="form-group">
                <label for="lastName">Nazwisko</label>
                <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Kowalski"
                    <?php
                            if (isset($_SESSION['last_name'])) {
                                echo 'value="'.$_SESSION['last_name'].'"';
                                unset($_SESSION['last_name']);
                            }
                        ?>>
            </div>

            <div class="form-group">
                <label for="email">Adres email</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                    placeholder="jankowalski@mail.com"
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

            <div class="form-group">
                <label for="password2">Powtórz Hasło</label>
                <input type="password" name="password2" class="form-control" id="password2" placeholder="********">
            </div>

            <button type="submit" class="btn btn-primary" name="register_submit">Submit</button>
        </form>
    </div>
</main>

<?php include "inc/footer.inc.php";?>