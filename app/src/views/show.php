<?php

$title = "CRUD users - Show";

ob_start();
?>

<div class="container">
    <div class="row">
        <h1>Show</h1>
    </div>
    <div class="row flex-center">
        <div class="form-div">
            <p>
                Id: <?php echo htmlspecialchars($user->id); ?>
                <br>
                Name: <?php echo htmlspecialchars($user->name); ?>
                <br>
                E-mail: <?php echo htmlspecialchars($user->email); ?>
            </p>
        </div>
    </div>
</div>

<?php

$content = ob_get_clean();

require_once 'layout.php';
