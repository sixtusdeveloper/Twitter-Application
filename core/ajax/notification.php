<?php
include '../init.php';
if (isset($_GET['showNotification']) && !empty($_GET['showNotification'])) {
    $user_id = $_SESSION['user_id'];
    $data = $getFromM->getNotificationCount($user_id);
    echo json_encode([
        'notification' => $data->totalN,
        'messages' => $data->totalM,
    ]);
} else {
    header('Location: ' . ROOT_URL . 'index.php');
}
?>
