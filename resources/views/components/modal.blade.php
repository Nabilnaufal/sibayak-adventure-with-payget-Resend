<!-- MODAL GLOBAL -->
<div id="app-modal" class="fixed inset-0 z-50 hidden items-center justify-center">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0"
        id="modal-overlay"></div>

    <!-- Content -->
    <div class="relative bg-white w-[90%] max-w-lg rounded-2xl shadow-xl transform transition-all duration-300 scale-95 opacity-0"
        id="modal-content">

        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b">
            <h2 id="modal-title" class="text-lg font-semibold"></h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-black text-xl">&times;</button>
        </div>

        <!-- Body -->
        <div id="modal-body" class="p-4 text-sm text-gray-600"></div>

    </div>
</div>
