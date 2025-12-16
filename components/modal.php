<div id="modal"
     class="fixed inset-0 z-50 hidden flex items-center justify-center">

    <div
        class="absolute inset-0 bg-black/50"
        onclick="modalTrigger(event)">
    </div>

    <div
        class="relative bg-white rounded-xl shadow-xl
               w-full max-w-md p-6
               animate-fadeIn scale-95">
        <?php include "components/taskForm.php" ?>
    </div>
</div>

<button
    onclick="modalTrigger(event)"
    class="fixed bottom-6 right-6 w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center shadow-lg hover:bg-green-600 transition-all hover:scale-110" >
    <svg xmlns="http://www.w3.org/2000/svg"
        class="w-7 h-7"
        fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" d="M12 4v16m8-8H4"/>
    </svg>
</button>

<div id="trash"
    ondragover="event.preventDefault()"
    ondrop="onTaskDrop(event)"
    class="fixed left-0 -bottom-25 w-screen hidden
        h-50 rounded-full
        bg-black/60 text-white
        z-50 flex justify-center">
        <div class="h-25 flex justify-center items-center">
            <p class="font-semibold text-xl">
                Drop Here to Delete
            </p>
        </div>
</div>

<div id="updating"
     class="fixed inset-0 z-50 hidden flex items-center justify-center">

    <div class="absolute inset-0 bg-black/50">
    </div>
    <div class="w-[50dvw] aspect-square max-w-24 border-2 border-gray-300 border-t-green-500 rounded-full animate-spin"></div>
</div>