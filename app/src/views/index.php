<?php

use App\Http\Request;

$title = "CRUD users - List";

ob_start();
?>

<div class="container">
    <h1>List</h1>

    <table class="table-users">
        <tr>
            <th>Name</th>
            <th>E-mail</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td class="user-name">
                <?php echo htmlspecialchars($user->name); ?>
            </td>
            <td class="user-email">
                <?php echo htmlspecialchars($user->email); ?>
            </td>
            <td>
                <a class="btn btn-primary text-white" href="<?php echo Request::getBaseUrl(); ?>/users/<?php echo htmlspecialchars($user->id); ?>">Show</a>
                <a class="btn btn-primary text-white" href="<?php echo Request::getBaseUrl(); ?>/users/edit/<?php echo htmlspecialchars($user->id); ?>">Edit</a>
                <form class="inline-block" action="<?php echo Request::getBaseUrl(); ?>/users/delete/<?php echo htmlspecialchars($user->id); ?>" method="POST" onsubmit="return confirm('Certeza?')">
                    <button class="btn btn-danger text-white" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php

$content = ob_get_clean();

require_once 'layout.php';
