<?php
require_once 'components/card.php';

function column($status, ...$tasks) {
    $color = match ($status) {
        'Todo' => 'border-blue-500',
        'In Progress' => 'border-yellow-500',
        'Done' => 'border-green-500',
        default => 'border-gray-400',
    };

    ob_start();
    ?>
    <section
        id="<?=$status?>"
        class="flex flex-col
               bg-gradient-to-br from-gray-100 to-gray-200
               rounded-xl mt-4 p-4 w-72
               h-[90dvh]
               border border-gray-300"
        ondrop="updateTaskStatus(event)"
        ondragover="event.preventDefault()"
    >
        <h2 class="font-semibold text-lg mb-3 text-gray-700 tracking-wide">
            <?= $status ?>
        </h2>

        <div class="flex flex-col gap-4 overflow-y-auto pr-1">
            <?php if(count($tasks)==0) echo "Belum ada task"?>
            <?php foreach ($tasks as $task): ?>
                <?= card(
                    $task['id'],
                    $task['title'],
                    $task['description'],
                    $color
                ) ?>
            <?php endforeach; ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
