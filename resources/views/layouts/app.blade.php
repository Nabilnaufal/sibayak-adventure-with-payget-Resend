<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sibayak Adventure') - Rental Alat Hiking</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1f3d2b',
                        secondary: '#6b8e23',
                        accent: '#8b5e3c',
                        sand: '#f5f5dc',
                        'sand-dark': '#e8e8c8',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap"
        rel="stylesheet">

    {{-- Custom Styles --}}
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .glass-dark {
            background: rgba(31, 61, 43, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>

    @stack('styles')
</head>

<body class="bg-sand font-sans text-gray-800 antialiased">
    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')
    {{-- Alpine.js --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- Scripts --}}
    @stack('scripts')

    <script>
        function openModal(title, content) {
            const modal = document.getElementById('app-modal');
            const overlay = document.getElementById('modal-overlay');
            const contentBox = document.getElementById('modal-content');

            document.getElementById('modal-title').innerHTML = title;
            document.getElementById('modal-body').innerHTML = content;

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                contentBox.classList.remove('opacity-0', 'scale-95');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('app-modal');
            const overlay = document.getElementById('modal-overlay');
            const contentBox = document.getElementById('modal-content');

            overlay.classList.add('opacity-0');
            contentBox.classList.add('opacity-0', 'scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }

        document.addEventListener('click', function(e) {
            const modal = document.getElementById('app-modal');
            const content = document.getElementById('modal-content');

            if (!content.contains(e.target) && modal.classList.contains('flex')) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") {
                closeModal();
            }
        });
    </script>
    <x-modal />

    <script>
        function showSyarat(e) {
            e.preventDefault();
            e.stopPropagation();

            const content = `
        <div class="space-y-2">
            <p><strong>Syarat Booking Alat Hiking:</strong></p>
            <ul class="list-disc pl-5 space-y-1">
                <li>Wajib meninggalkan KTP sebagai jaminan.</li>
                <li>Penyewa bertanggung jawab atas barang yang disewa.</li>
                <li>Kerusakan atau kehilangan dikenakan denda sesuai harga barang.</li>
                <li>Pengembalian harus tepat waktu.</li>
                <li>Barang harus dikembalikan dalam kondisi baik.</li>
            </ul>
        </div>
    `;

            openModal("Syarat & Ketentuan", content);
        }
    </script>

</body>

</html>
