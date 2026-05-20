@props(['title' => 'Tidak ada data', 'description' => 'Belum ada data untuk ditampilkan', 'action' => null, 'actionUrl' => '#'])

<div {{ $attributes->merge(['class' => 'text-center py-16']) }}>
    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
        </svg>
    </div>
    <h3 class="font-heading font-semibold text-lg text-primary mb-2">{{ $title }}</h3>
    <p class="text-gray-500 mb-6 max-w-sm mx-auto">{{ $description }}</p>
    
    @if($action)
    <a href="{{ $actionUrl }}" class="inline-flex items-center gap-2 bg-secondary hover:bg-secondary/90 text-white px-6 py-3 rounded-xl font-medium transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        {{ $action }}
    </a>
    @endif
</div>
