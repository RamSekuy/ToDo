<?php
require_once "services/getGroups.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Select Group</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gradient-to-br from-slate-100 to-slate-200 min-h-screen">

<div class="max-w-5xl mx-auto px-4 py-10">

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Pilih Group Task</h1>

        <button onclick="openModal()"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow font-medium transition">
            + Tambah Group
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($groups as $group): ?>
             <div class="relative">
        <!-- Card -->
        <a href="./?group=<?= urlencode($group['name']) ?>"
           class="block relative overflow-hidden rounded-2xl shadow-lg p-6 text-white
                  bg-gradient-to-br from-blue-500 to-indigo-500
                  hover:scale-[1.02] transition">

            <h2 class="text-2xl text-center font-bold">
                <?= htmlspecialchars($group['name']) ?>
            </h2>
        </a>

        <!-- Delete Button -->
        <form method="POST"
              action="services/deleteGroup.php"
              onsubmit="return confirm('Hapus group ini?')"
              class="absolute top-3 right-3">

            <input type="hidden" name="name"
                   value="<?= $group['name'] ?>">

            <button type="submit"
                    class="p-1 rounded-full bg-black/30 hover:bg-red-600 transition"
                    title="Hapus group">

                <!-- Trash Icon SVG -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     class="w-4 h-4 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 6h18M8 6V4h8v2M6 6l1 14h10l1-14M10 10v6M14 10v6"/>
                </svg>
            </button>
        </form>
    </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<div id="modal"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            Tambah Group Baru
        </h3>

       <form method="POST" action="services/addGroup.php">
    <label class="block text-sm font-medium text-gray-600 mb-1">
        Nama Group
    </label>

    <input type="text"
           name="name"
           required
           placeholder="Contoh: UAS Pemrograman Web"
           class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

    <div class="flex justify-end gap-3 mt-6">
        <button type="button"
                onclick="closeModal()"
                class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200">
            Batal
        </button>

        <button type="submit"
                class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium">
            Simpan
        </button>
    </div>
</form>

    </div>
</div>

<script>
function openModal() {
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}
function closeModal() {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

</body>
</html>
