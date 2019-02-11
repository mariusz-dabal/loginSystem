<?php include "inc/header.inc.php";?>

<main>
    <div class="container">
        <h1 class="display-1 mt-5">Index.php</h1>
        <?php 
            if (isset($_GET['activate']) && $_GET['activate'] == true) {
                echo '<p>Twoje konto zostało aktywowane, możesz teraz się zalogować.</p>';
            }

            if (isset($_GET['register']) && $_GET['register'] == true) {
                echo '<p>Na Twój adres email został przesłany link aktywacyjny.</p>';
            }
        ?>
    </div>
</main>

<?php include "inc/footer.inc.php";?>