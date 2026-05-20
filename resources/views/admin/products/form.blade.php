@extends('layouts.admin')

@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk')
@section('page-title', isset($product) ? 'Edit Produk' : 'Tambah Produk')

@section('content')
    <div class="max-w-4xl">
        <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($product))
                @method('PUT')
            @endif

            {{-- Product Info --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm mb-6">
                <h2 class="font-heading font-semibold text-lg text-primary mb-6">Informasi Produk</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" required value="{{ $product->name ?? old('name') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                            placeholder="Contoh: Tenda Dome 4P Premium">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">SKU</label>
                        <input type="text" name="sku" value="{{ $product->sku ?? old('sku') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                            placeholder="Contoh: TND-001">
                        @error('sku')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="category" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary">
                            <option value="">Pilih Kategori</option>
                            <option value="Tenda"
                                {{ (isset($product) && $product->category === 'Tenda') || old('category') === 'Tenda' ? 'selected' : '' }}>
                                Tenda</option>
                            <option value="Sepatu"
                                {{ (isset($product) && $product->category === 'Sepatu') || old('category') === 'Sepatu' ? 'selected' : '' }}>
                                Sepatu</option>
                            <option value="Carrier"
                                {{ (isset($product) && $product->category === 'Carrier') || old('category') === 'Carrier' ? 'selected' : '' }}>
                                Carrier</option>
                            <option value="Sleeping Bag"
                                {{ (isset($product) && $product->category === 'Sleeping Bag') || old('category') === 'Sleeping Bag' ? 'selected' : '' }}>
                                Sleeping Bag</option>
                            <option value="Aksesoris"
                                {{ (isset($product) && $product->category === 'Aksesoris') || old('category') === 'Aksesoris' ? 'selected' : '' }}>
                                Aksesoris</option>
                        </select>
                        @error('category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga per Hari <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                            <input type="number" name="price_per_day" required min="0"
                                value="{{ $product->price_per_day ?? old('price_per_day') }}"
                                class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                                placeholder="75000">
                        </div>
                        @error('price_per_day')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Stok <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="stock" required min="0"
                            value="{{ $product->stock ?? old('stock', 0) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                            placeholder="10">
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-secondary focus:ring-secondary"
                            placeholder="Deskripsi produk...">{{ $product->description ?? old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Product Image --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm mb-6">
                <h2 class="font-heading font-semibold text-lg text-primary mb-6">Gambar Produk</h2>

                <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center" id="drop-zone">
                    <div class="mb-4">
                        <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="text-gray-600 mb-2">Drag and drop gambar di sini, atau</p>
                    <label
                        class="inline-block bg-secondary hover:bg-secondary/90 text-white px-6 py-2.5 rounded-xl font-medium cursor-pointer transition">
                        Pilih File
                        <input type="file" name="image" accept="image/*" class="hidden" id="image-input">
                    </label>
                    <p class="text-gray-400 text-sm mt-2">PNG, JPG atau JPEG. Max 2MB</p>
                </div>

                {{-- Image Preview --}}
                <div id="image-preview" class="mt-4 hidden">
                    <img src="" alt="Preview" class="w-32 h-32 object-cover rounded-xl">
                </div>

                @if (isset($product) && $product->image)
                    <div class="mt-4">
                        <p class="text-sm text-gray-500 mb-2">Gambar saat ini:</p>
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                            class="w-32 h-32 object-cover rounded-xl">
                    </div>
                @endif

                @error('image')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-4">
                <button type="submit"
                    class="bg-secondary hover:bg-secondary/90 text-white px-8 py-3 rounded-xl font-medium transition">
                    {{ isset($product) ? 'Update Produk' : 'Simpan Produk' }}
                </button>
                <a href="{{ route('admin.products.index') }}"
                    class="px-8 py-3 border border-gray-200 rounded-xl font-medium text-gray-600 hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // Image preview
            document.getElementById('image-input').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('image-preview');
                        preview.classList.remove('hidden');
                        preview.querySelector('img').src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Drag and drop
            const dropZone = document.getElementById('drop-zone');
            const imageInput = document.getElementById('image-input');

            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.classList.add('border-secondary', 'bg-secondary/5');
            });

            dropZone.addEventListener('dragleave', () => {
                dropZone.classList.remove('border-secondary', 'bg-secondary/5');
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('border-secondary', 'bg-secondary/5');

                const files = e.dataTransfer.files;
                if (files.length) {
                    imageInput.files = files;
                    imageInput.dispatchEvent(new Event('change'));
                }
            });
        </script>
    @endpush
@endsection
