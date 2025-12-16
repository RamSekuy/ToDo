<form action="./services/addTask.php" method="post" class="space-y-5">
    <h1 class="text-xl font-semibold text-gray-800">
        Add Task
    </h1>

    <div class="flex flex-col gap-1">
        <label for="title" class="text-sm font-medium text-gray-700">
            Title
        </label>
        <input
            type="text"
            name="title"
            id="title"
            required
            placeholder="Task title..."
            class="rounded-lg border border-gray-300 px-3 py-2
                   focus:outline-none focus:ring-2 focus:ring-green-500
                   focus:border-green-500"
        />
    </div>

    <div class="flex flex-col gap-1">
        <label for="desc" class="text-sm font-medium text-gray-700">
            Description
        </label>
        <textarea
            name="description"
            id="desc"
            rows="4"
            placeholder="Task description..."
            class="rounded-lg border border-gray-300 px-3 py-2
                   resize-none
                   focus:outline-none focus:ring-2 focus:ring-green-500
                   focus:border-green-500"
        ></textarea>
    </div>

    <div class="flex justify-end gap-3 pt-2">
        <button
            type="button"
            onclick="modalTrigger(event)"
            class="px-4 py-2 rounded-lg
                   bg-gray-200 text-gray-700
                   hover:bg-gray-300
                   font-medium transition"
        >
            Cancel
        </button>

        <button
            type="submit"
            class="px-4 py-2 rounded-lg
                   bg-green-500 text-white
                   hover:bg-green-600
                   font-medium transition"
        >
            Add Task
        </button>
    </div>
</form>
