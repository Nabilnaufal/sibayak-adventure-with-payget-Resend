<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-secondary rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="#ffffff" class="icon icon-tabler icons-tabler-filled icon-tabler-mountain">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M6.18 10.95l2.54 3.175l.084 .093a1 1 0 0 0 1.403 -.01l1.637 -1.638l1.324 1.985a1 1 0 0 0 1.457 .226l3.632 -2.906l3.647 7.697a1 1 0 0 1 -.904 1.428h-18a1 1 0 0 1 -.904 -1.428zm5.82 -7.878a3.3 3.3 0 0 1 2.983 1.888l2.394 5.057l-3.15 2.52l-1.395 -2.092l-.075 -.099a1 1 0 0 0 -1.464 -.053l-1.711 1.709l-1.301 -1.627l-1.151 -1.435l1.888 -3.98a3.3 3.3 0 0 1 2.982 -1.888" />
                    </svg>
                </div>
                <span class="text-xl font-heading font-bold text-white" id="logo-text">Sibayak Adventure</span>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}"
                    class="nav-link text-white/90 hover:text-white transition font-medium">Beranda</a>
                <a href="{{ route('products.index') }}"
                    class="nav-link text-white/90 hover:text-white transition font-medium">Produk</a>
                <a href="#about" class="nav-link text-white/90 hover:text-white transition font-medium">Tentang</a>
                <a href="#contact" class="nav-link text-white/90 hover:text-white transition font-medium">Kontak</a>
            </div>

            {{-- Auth Buttons --}}
            <div class="hidden md:flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="text-white/90 hover:text-white transition font-medium">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="bg-secondary hover:bg-secondary/90 text-white px-5 py-2.5 rounded-xl font-medium transition transform hover:scale-105">
                        Daftar
                    </a>
                @else
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 text-white">
                            <div class="w-9 h-9 bg-secondary rounded-full flex items-center justify-center">
                                <span class="text-sm font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <span class="font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 glass rounded-xl shadow-lg py-2">
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                            <a href="{{ route('profile') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
                            <a href="{{ route('cart.index') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Keranjang</a>
                            <hr class="my-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Keluar</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            {{-- Mobile Menu Button --}}
            <button class="md:hidden text-white" id="mobile-menu-btn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div class="md:hidden hidden glass-dark" id="mobile-menu">
        <div class="px-4 py-4 space-y-3">
            <a href="{{ route('home') }}" class="block text-white/90 hover:text-white py-2">Beranda</a>
            <a href="{{ route('products.index') }}" class="block text-white/90 hover:text-white py-2">Produk</a>
            <a href="#about" class="block text-white/90 hover:text-white py-2">Tentang</a>
            <a href="#contact" class="block text-white/90 hover:text-white py-2">Kontak</a>
            <hr class="border-white/20">
            @guest
                <a href="{{ route('login') }}" class="block text-white/90 hover:text-white py-2">Masuk</a>
                <a href="{{ route('register') }}"
                    class="block bg-secondary text-white text-center py-2.5 rounded-xl">Daftar</a>
            @else
                <a href="{{ route('dashboard') }}" class="block text-white/90 hover:text-white py-2">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block w-full text-left text-red-400 py-2">Keluar</button>
                </form>
            @endguest
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            const logoText = document.getElementById('logo-text');
            const navLinks = document.querySelectorAll('.nav-link');

            if (window.scrollY > 50) {
                navbar.classList.add('glass', 'shadow-lg');
                navbar.classList.remove('bg-transparent');
                logoText.classList.remove('text-white');
                logoText.classList.add('text-primary');
                navLinks.forEach(link => {
                    link.classList.remove('text-white/90', 'hover:text-white');
                    link.classList.add('text-gray-700', 'hover:text-primary');
                });
            } else {
                navbar.classList.remove('glass', 'shadow-lg');
                navbar.classList.add('bg-transparent');
                logoText.classList.add('text-white');
                logoText.classList.remove('text-primary');
                navLinks.forEach(link => {
                    link.classList.add('text-white/90', 'hover:text-white');
                    link.classList.remove('text-gray-700', 'hover:text-primary');
                });
            }
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
@endpush
