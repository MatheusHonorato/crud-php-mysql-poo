<?php

use App\Http\Request;

include_once 'messages.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo Request::getBaseUrl(); ?>/css/style.css">
    <title><?php echo $title ?? 'CRUD users'; ?></title>
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <?php echo $message; ?>
                <?php if(Request::getUri() != '/users'): ?>
                    <a class="btn btn-primary text-white" href="<?php echo Request::getBaseUrl(); ?>/users">List</a>
                <?php endif; ?>
                <?php if(Request::getUri() != '/users/create'): ?>
                    <a class="btn btn-success text-white" href="<?php echo Request::getBaseUrl(); ?>/users/create">Create</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>
        <?php echo $content; ?>
    </main>

    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> - DevContratado</p>
    </footer>
</body>
</html>
