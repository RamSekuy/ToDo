<?php 
include 'components/coloumn.php'; 
include 'services/getTasks.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <style>
          .card{transition:transform .15s ease, box-shadow .15s ease}
          .card.is-over{transform:translateY(12px)}
          .card.is-dragging{opacity:.6}
        </style>
    </head>
    <body class="bg-gray-100 p-0 flex justify-center items-center gap-x-4">
        <?php include 'components/modal.php'; ?>
        <?php foreach(["ToDo","In Progress","Done"] as $status):
            echo column($status,...$tasks[$status]);
        endforeach?>
    <script src="assets/js/app.js"></script>
</body>
</html>