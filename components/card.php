<?php
function card($id, $title, $description, $color) {
    ob_start();
    ?>
    <div
      draggable="true"
      ondragstart="taskMove(event)"
      ondragend="taskMoveEnd(event)"
      ondrop="onTaskDrop(event)"
      id="<?=$id?>"
      class="card bg-white rounded-xl p-4
             shadow-sm hover:shadow-md
             border-l-4 <?= $color ?>
             transition-all
             "
    >
      <h3 class="font-semibold text-gray-800 mb-1">
        <?=$title?>
      </h3>
      <p class="text-sm text-gray-600">
        <?=$description?>
      </p>
    </div>
    <?php
    return ob_get_clean();
}
