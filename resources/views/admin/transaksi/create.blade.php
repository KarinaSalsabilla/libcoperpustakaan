@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-2xl">

    Header
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
            <a href="{{ route('admin.transaksi.index') }}" class="hover:text-amber-600">Transaksi</a>
            <span>/</span>
            <span class="text-gray-700">Tambah Peminjaman</span>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Peminjaman</h1>
        <p class="text-sm text-gray-500 mt-1">Catat peminjaman buku oleh anggota</p>
    </div>

    {{-- Error --}}
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 mb-5">
            <p class="font-semibold text-sm mb-1">Terdapat kesalahan:</p>
            <ul class="text-sm list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('admin.transaksi.store') }}">
        @csrf

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 space-y-5">

            {{-- Pilih Anggota --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Anggota <span class="text-red-500">*</span>
                </label>
                <select name="id_user"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent @error('id_user') border-red-400 @enderror"
                    required>
                    <option value="">-- Pilih Anggota --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id_user }}"
                            {{ old('id_user') == $user->id_user ? 'selected' : '' }}>
                            {{ $user->name }} — {{ $user->email }}
                        </option>
                    @endforeach
                </select>
                @error('id_user')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pilih Buku --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Buku <span class="text-red-500">*</span>
                </label>
                <select name="id_buku"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent @error('id_buku') border-red-400 @enderror"
                    required>
                    <option value="">-- Pilih Buku --</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id_buku }}"
                            {{ old('id_buku') == $book->id_buku ? 'selected' : '' }}>
                            {{ $book->judul_buku }} · {{ $book->pengarang }}
                            (Stok: {{ $book->jumlah_ebook }})
                        </option>
                    @endforeach
                </select>
                @error('id_buku')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Pinjam & Batas --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Tanggal Pinjam <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal_pinjam"
                        value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent @error('tanggal_pinjam') border-red-400 @enderror"
                        required>
                    @error('tanggal_pinjam')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Tenggat Kembali <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal_batas"
                        value="{{ old('tanggal_batas', date('Y-m-d', strtotime('+7 days'))) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent @error('tanggal_batas') border-red-400 @enderror"
                        required>
                    @error('tanggal_batas')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Info stok --}}
            <div id="stok-info" class="hidden bg-amber-50 border border-amber-200 rounded-xl px-4 py-3">
                <p class="text-sm text-amber-700">
                    <span class="font-semibold">Info Stok:</span>
                    <span id="stok-text">-</span>
                </p>
            </div>

        </div>

        {{-- Tombol --}}
        <div class="flex items-center gap-3 mt-6">
            <button type="submit"
                class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition-colors">
                Simpan Peminjaman
            </button>
            <a href="{{ route('admin.transaksi.index') }}"
                class="px-6 py-2.5 border border-gray-300 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition-colors">
                Batal
            </a>
        </div>

    </form>
</div>

{{-- Script: tampilkan info stok saat pilih buku --}}
<script>
    const stokData = {
        @foreach($books as $book)
            {{ $book->id_buku }}: {{ $book->jumlah_ebook }},
        @endforeach
    };

    document.querySelector('select[name="id_buku"]').addEventListener('change', function () {
        const id    = this.value;
        const info  = document.getElementById('stok-info');
        const text  = document.getElementById('stok-text');

        if (id && stokData[id] !== undefined) {
            info.classList.remove('hidden');
            const stok = stokData[id];
            text.textContent = stok > 0
                ? ` ${stok} eksemplar tersedia`
                : ' Stok habis! Buku tidak bisa dipinjam.';
            text.className = stok > 0 ? 'text-amber-700' : 'text-red-600 font-semibold';
        } else {
            info.classList.add('hidden');
        }
    });
</script>
@endsection