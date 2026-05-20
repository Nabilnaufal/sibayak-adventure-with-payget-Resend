<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Sibayak Adventure</title>

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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        .glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-sand font-sans text-gray-800 antialiased">
    <div class="min-h-screen flex">
        {{-- Left Side - Image --}}
        <div class="hidden lg:flex lg:w-1/2 relative">
            <div class="absolute inset-0">
                <img src="{{ asset('images/hiking.jpg') }}" alt="Hiking" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/80 to-secondary/60"></div>
            </div>

            <div class="relative z-10 flex flex-col justify-between p-12 text-white">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff" class="icon icon-tabler icons-tabler-filled icon-tabler-mountain"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M6.18 10.95l2.54 3.175l.084 .093a1 1 0 0 0 1.403 -.01l1.637 -1.638l1.324 1.985a1 1 0 0 0 1.457 .226l3.632 -2.906l3.647 7.697a1 1 0 0 1 -.904 1.428h-18a1 1 0 0 1 -.904 -1.428zm5.82 -7.878a3.3 3.3 0 0 1 2.983 1.888l2.394 5.057l-3.15 2.52l-1.395 -2.092l-.075 -.099a1 1 0 0 0 -1.464 -.053l-1.711 1.709l-1.301 -1.627l-1.151 -1.435l1.888 -3.98a3.3 3.3 0 0 1 2.982 -1.888" /></svg>
                    </div>
                    <span class="text-xl font-heading font-bold">Sibayak Adventure</span>
                </a>

                {{-- Quote --}}
                <div>
                    <blockquote class="text-3xl font-heading font-bold leading-tight mb-6">
                        "Puncak Menunggu Diatas,Dan Aku Harus Pergi"
                    </blockquote>
                    <p class="text-white/70">- John Muir</p>
                </div>

                {{-- Stats --}}
                <div class="flex gap-12">
                    <div>
                        <p class="font-heading text-3xl font-bold">1000+</p>
                        <p class="text-white/70">Happy Customers</p>
                    </div>
                    <div>
                        <p class="font-heading text-3xl font-bold">50+</p>
                        <p class="text-white/70">Products</p>
                    </div>
                    <div>
                        <p class="font-heading text-3xl font-bold">5+</p>
                        <p class="text-white/70">Years Experience</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Side - Form --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                {{-- Mobile Logo --}}
                <div class="lg:hidden mb-8 text-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                        <div class="w-10 h-10 bg-secondary rounded-xl flex items-center justify-center">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff" class="icon icon-tabler icons-tabler-filled icon-tabler-mountain"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M6.18 10.95l2.54 3.175l.084 .093a1 1 0 0 0 1.403 -.01l1.637 -1.638l1.324 1.985a1 1 0 0 0 1.457 .226l3.632 -2.906l3.647 7.697a1 1 0 0 1 -.904 1.428h-18a1 1 0 0 1 -.904 -1.428zm5.82 -7.878a3.3 3.3 0 0 1 2.983 1.888l2.394 5.057l-3.15 2.52l-1.395 -2.092l-.075 -.099a1 1 0 0 0 -1.464 -.053l-1.711 1.709l-1.301 -1.627l-1.151 -1.435l1.888 -3.98a3.3 3.3 0 0 1 2.982 -1.888" /></svg>
                        </div>
                        <span class="text-xl font-heading font-bold text-primary">Sibayak Adventure</span>
                    </a>
                </div>

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
