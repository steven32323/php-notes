    <?php

    $config = require('config.php');
    $db = new Database($config['database']);

    $heading = 'Note';
    $currentUserId = 1;

    $note = $db->query('SELECT * FROM notes WHERE id = :id', [
        'id' => $_GET['id']
        ])->findOrFail(PDO::FETCH_ASSOC);

        authorize($note['user_id'] === $currentUserId);
    
    if ($note['user_id'] != $currentUserId) {
        abort(Response::FORBIDDEN);
    }

    require "views/note.view.php";