<?php

use App\Http\Request;

$title = "CRUD users - Create";

ob_start();
?>

<div class="container">
    <div class="row">
        <h1>Create</h1>
    </div>
    <div class="row flex-center">
        <div class="form-div">
            <form class="form" action="<?php echo Request::getBaseUrl(); ?>/users" method="POST">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <button class="btn btn-success text-white" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>

<?php

$content = ob_get_clean();

require_once 'layout.php';
