{{-- index.blade.php --}}

@extends('layouts.app')

@section('title', 'Beranda - Libco')

@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>

    <section id="home" class="min-h-screen flex items-center pb-8 sm:pb-12 lg:pb-16
               bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50
               dark:from-gray-900 dark:via-gray-800 dark:to-gray-900
               transition-all duration-500">

        <div
            class="container mx-auto px-4 sm:px-6 lg:px-12 grid lg:grid-cols-2 gap-8 lg:gap-12 items-center pt-8 sm:pt-10 lg:pt-0">
            <div class="space-y-6 lg:space-y-8">
                <div
                    class="inline-block px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold dark:bg-blue-900 dark:text-blue-300">
                    🎓 Library Connect
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-gray-900 dark:text-white">
                    Discover, Learn, Grow
                    <span class="block mt-2">With <span
                            class="bg-gradient-to-r from-yellow-400 to-orange-400 px-3 py-1 rounded-lg inline-block transform -rotate-1">Libco</span></span>
                </h1>

                <p class="text-lg sm:text-xl text-gray-600 leading-relaxed dark:text-gray-400">
                    Menghubungkanmu dengan pengetahuan, kapan saja, di mana saja.
                    Akses ribuan buku digital dengan sekali klik.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <a href="/register"
                        class="group bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-full shadow-xl hover:shadow-2xl transition transform hover:scale-105 flex items-center justify-center gap-2 font-semibold text-sm sm:text-base">
                        Daftar Sekarang
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>

                    <a href="#koleksi"
                        onclick="document.getElementById('koleksi').scrollIntoView({behavior:'smooth'});return false;"
                        class="bg-white text-gray-700 px-6 sm:px-8 py-3 sm:py-4 rounded-full shadow-lg hover:shadow-xl transition transform hover:scale-105 font-semibold text-sm sm:text-base border-2 border-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">
                        Akses semua buku
                    </a>
                </div>

                <div class="grid grid-cols-3 gap-4 sm:gap-6 pt-4 sm:pt-8">
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold text-blue-600 dark:text-blue-400">10K+</div>
                        <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Buku Digital</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold text-purple-600 dark:text-purple-400">50K+</div>
                        <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Pengguna Aktif</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold text-orange-600 dark:text-orange-400">4.9★</div>
                        <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Rating</div>
                    </div>
                </div>
            </div>

            <div class="hidden lg:flex relative justify-center">
                <div class="relative animate-float w-full max-w-lg">
                    <div id="lottie-register" class="w-full"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="koleksi" class="py-12 sm:py-20 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4 dark:text-white">Jelajahi Dunia Pengetahuan</h2>
            <p class="text-base sm:text-xl text-gray-600 max-w-3xl mx-auto dark:text-gray-400 mb-8 sm:mb-12">
                Temukan bacaan dari berbagai kategori, diperbarui setiap minggu. Semua bisa diakses gratis atau dengan akun
                premium!
            </p>

            {{-- Filter Kategori --}}
            <div class="relative mb-8 sm:mb-16">
                <div class="flex gap-2 sm:gap-4 overflow-x-auto pb-3 sm:pb-0 sm:flex-wrap sm:justify-center scrollbar-hide px-1"
                    id="filter-kategori">
                    <button onclick="filterKategori('semua', this)"
                        class="filter-btn flex-none px-4 sm:px-6 py-1.5 sm:py-2 text-sm rounded-full text-white bg-purple-600 hover:bg-purple-700 font-semibold transition shadow-md whitespace-nowrap">
                        Semua
                    </button>
                    @foreach($kategoris as $kat)
                        <button onclick="filterKategori('{{ $kat->id_kategori }}', this)"
                            class="filter-btn flex-none px-4 sm:px-6 py-1.5 sm:py-2 text-sm rounded-full text-gray-700 bg-gray-100 hover:bg-gray-200 font-semibold transition dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 whitespace-nowrap">
                            {{ $kat->nama_kategori }}
                        </button>
                    @endforeach
                </div>
                {{-- Fade gradient hint untuk scroll di mobile --}}
                <div
                    class="absolute right-0 top-0 h-full w-8 bg-gradient-to-l from-white dark:from-gray-900 pointer-events-none sm:hidden">
                </div>
            </div>

            {{-- Grid Buku --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 sm:gap-4 md:gap-6"
                id="grid-buku">
                @forelse($books as $book)
                    <div class="book-card flex flex-col items-center text-center p-3 sm:p-4 bg-white rounded-xl shadow-lg hover:shadow-xl transition hover:-translate-y-1 cursor-pointer dark:bg-gray-800"
                        data-id="{{ $book->id_buku }}" data-kategori="{{ $book->id_kategori }}"
                        data-judul="{{ $book->judul_buku }}" data-pengarang="{{ $book->pengarang }}"
                        data-penerbit="{{ $book->penerbit ?? '-' }}" data-tahun="{{ $book->tahun_terbit }}"
                        data-kategori-nama="{{ $book->kategori->nama_kategori ?? '-' }}"
                        data-sinopsis="{{ $book->sinopsis ?? 'Sinopsis belum tersedia.' }}"
                        data-cover="{{ $book->cover ? Storage::url($book->cover) : 'https://via.placeholder.com/150x220/6366f1/ffffff?text=' . urlencode($book->judul_buku) }}"
                        onclick="bukaBukuModal(this)">

                        <img src="{{ $book->cover ? Storage::url($book->cover) : 'https://via.placeholder.com/150x220/6366f1/ffffff?text=' . urlencode(Str::limit($book->judul_buku, 10)) }}"
                            alt="{{ $book->judul_buku }}"
                            class="w-full h-auto object-cover rounded-lg mb-2 sm:mb-3 shadow-md aspect-[2/3]">
                        <h4 class="text-xs sm:text-sm font-semibold text-gray-900 dark:text-white line-clamp-2 leading-tight">
                            {{ $book->judul_buku }}
                        </h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 sm:mt-1 line-clamp-1">{{ $book->pengarang }}
                        </p>
                        <span class="text-xs text-purple-500 font-medium mt-0.5 sm:mt-1">
                            {{ $book->kategori->nama_kategori ?? '-' }}
                        </span>
                    </div>
                @empty
                    <div
                        class="col-span-2 sm:col-span-3 md:col-span-4 lg:col-span-5 xl:col-span-6 text-center py-16 text-gray-400">
                        <p class="text-lg">Belum ada buku tersedia.</p>
                    </div>
                @endforelse
            </div>

            <a href="/register"
                class="inline-block mt-10 sm:mt-16 text-base sm:text-lg font-semibold text-blue-600 hover:text-blue-800 transition dark:text-blue-400 dark:hover:text-blue-500">
                Lihat Semua Koleksi — Daftar Gratis &rarr;
            </a>
        </div>
    </section>

    {{-- ===== MODAL DETAIL BUKU ===== --}}
    <div id="modal-buku"
        class="fixed inset-0 z-50 hidden items-center justify-center p-3 sm:p-4 bg-black/60 backdrop-blur-sm">
        <div
            class="bg-white dark:bg-gray-800 rounded-2xl sm:rounded-3xl shadow-2xl max-w-2xl w-full overflow-hidden animate-fadeIn max-h-[92vh] flex flex-col">
            <div class="flex flex-col sm:flex-row overflow-y-auto flex-1">

                {{-- Cover --}}
                <div
                    class="sm:w-48 flex-shrink-0 bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-gray-700 dark:to-gray-900 flex items-center justify-center p-4 sm:p-6">
                    <img id="modal-cover" src="" alt="Cover Buku"
                        class="w-32 sm:w-full max-h-44 sm:max-h-none rounded-xl shadow-xl object-cover aspect-[2/3] mx-auto">
                </div>

                {{-- Info --}}
                <div class="flex-1 p-4 sm:p-6 flex flex-col justify-between">
                    <div>
                        <button onclick="tutupModal()"
                            class="float-right text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-2xl leading-none ml-2">&times;</button>

                        <span id="modal-kategori"
                            class="inline-block px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold mb-3 dark:bg-purple-900 dark:text-purple-300"></span>

                        <h3 id="modal-judul" class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-1"></h3>
                        <p id="modal-pengarang" class="text-gray-500 dark:text-gray-400 text-sm mb-1"></p>
                        <p id="modal-penerbit" class="text-gray-400 dark:text-gray-500 text-xs mb-3 sm:mb-4"></p>

                        <div class="border-t border-gray-100 dark:border-gray-700 pt-3 sm:pt-4">
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sinopsis</h4>
                            <p id="modal-sinopsis"
                                class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed line-clamp-5 sm:line-clamp-none">
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 sm:mt-6 flex gap-2 sm:gap-3">
                        <a href="/register"
                            class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center py-2.5 sm:py-3 rounded-full font-semibold text-sm sm:text-base hover:shadow-lg transition transform hover:scale-105">
                            📚 Daftar untuk Membaca
                        </a>
                        <button onclick="tutupModal()"
                            class="px-3 sm:px-4 py-2.5 sm:py-3 rounded-full border-2 border-gray-200 text-gray-600 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 transition font-semibold text-sm">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="fitur" class="relative py-12 sm:py-20 bg-gradient-to-br from-blue-600 to-purple-700">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12">
            <div class="text-center mb-10 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">Kenapa Memilih Libco?</h2>
                <p class="text-base sm:text-xl text-blue-100">Platform perpustakaan digital terlengkap dan termudah</p>
            </div>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
                <div class="feature-card p-6 sm:p-8 rounded-2xl hover-scale">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-blue-500 to-blue-600
                              rounded-xl flex items-center justify-center mb-4 sm:mb-6">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-3 text-white">Ribuan Buku</h3>
                    <p class="text-sm sm:text-base text-gray-300 dark:text-gray-200">Akses koleksi lebih dari 10.000 buku
                        digital dari berbagai kategori dan genre</p>
                </div>

                <div class="feature-card p-6 sm:p-8 rounded-2xl hover-scale">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-4 sm:mb-6">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-3 text-white">24/7 Akses</h3>
                    <p class="text-sm sm:text-base text-gray-300 dark:text-gray-200">Baca kapan saja dan di mana saja, tanpa
                        batasan waktu dan tempat</p>
                </div>

                <div class="feature-card p-6 sm:p-8 rounded-2xl hover-scale sm:col-span-2 md:col-span-1">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mb-4 sm:mb-6">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-3 text-white">Super Cepat</h3>
                    <p class="text-sm sm:text-base text-gray-300 dark:text-gray-200">Loading cepat dengan teknologi cloud
                        terkini untuk pengalaman membaca terbaik</p>
                </div>
            </div>
        </div>
    </section>

    <section id="tentangkami" class="py-12 sm:py-20 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12">
            <div class="grid lg:grid-cols-2 gap-10 sm:gap-16 items-center">

                <div>
                    <span
                        class="inline-block px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold mb-4 dark:bg-purple-900 dark:text-purple-300">
                        Tentang Kami
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6 dark:text-white">
                        Mewujudkan Akses Literasi Tanpa Batas
                    </h2>
                    <p class="text-base sm:text-xl text-gray-600 mb-6 sm:mb-8 dark:text-gray-400">
                        Kami percaya bahwa ilmu pengetahuan adalah hak setiap orang. Libco didirikan dengan satu misi
                        sederhana: mendobrak hambatan fisik dan geografis agar setiap individu di Indonesia dapat mengakses
                        ribuan sumber pengetahuan hanya dengan satu sentuhan.
                    </p>

                    <div class="space-y-4 sm:space-y-6">
                        <div class="flex items-start gap-3 sm:gap-4">
                            <div
                                class="flex-shrink-0 w-9 h-9 sm:w-10 sm:h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-base sm:text-lg dark:text-white">Inovasi Digital
                                </h4>
                                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Libco memanfaatkan
                                    teknologi digital untuk menghadirkan layanan perpustakaan yang praktis, modern, dan
                                    dapat diakses kapan saja.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 sm:gap-4">
                            <div
                                class="flex-shrink-0 w-9 h-9 sm:w-10 sm:h-10 bg-purple-500 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20h-5v-2a3 3 0 00-5.356-1.857M9 20V8a6 6 0 0112 0v12M9 20h12" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-base sm:text-lg dark:text-white">Kolaborasi &
                                    Kemitraan</h4>
                                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Libco dirancang untuk dapat
                                    bekerja sama dengan penerbit, sekolah, dan komunitas literasi dalam menyediakan konten
                                    bacaan yang relevan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="relative p-4 sm:p-6 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-3xl shadow-2xl dark:from-gray-700 dark:to-gray-800">
                    <img src="{{asset(path: 'images/ilustrasi_3d.png')}}" alt="Ilustrasi Misi Libco"
                        class="rounded-2xl w-full max-w-sm mx-auto sm:max-w-full h-auto object-cover sm:transform sm:rotate-3 shadow-xl">
                    <blockquote
                        class="mt-4 sm:mt-8 p-3 sm:p-4 bg-white rounded-xl shadow-lg border-l-4 border-purple-500 dark:bg-gray-800 dark:text-gray-300">
                        <p class="text-sm sm:text-base text-gray-700 italic dark:text-gray-300">"Literasi bukan hanya
                            tentang membaca, tetapi tentang membuka potensi masa depan. Libco adalah kunci untuk masa depan
                            itu."</p>
                    </blockquote>
                </div>

            </div>
        </div>
    </section>

    <section
        class="py-12 sm:py-20 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12">
            <div
                class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl sm:rounded-3xl shadow-2xl p-8 sm:p-12 lg:p-16 text-center">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4 sm:mb-6">Siap Memulai Perjalanan
                    Membaca?</h2>
                <p class="text-base sm:text-xl text-blue-100 mb-6 sm:mb-8 max-w-2xl mx-auto">Bergabunglah dengan ribuan
                    pembaca lainnya dan
                    nikmati pengalaman membaca digital yang luar biasa</p>
                <a href="/register"
                    class="inline-block bg-white text-blue-600 px-8 sm:px-10 py-3 sm:py-4 rounded-full shadow-xl hover:shadow-2xl transition transform hover:scale-105 font-bold text-base sm:text-lg">
                    Daftar Sekarang 🚀
                </a>
            </div>
        </div>
    </section>

    <style>
        /* Sembunyikan scrollbar filter kategori di mobile tapi tetap bisa scroll */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>

    <script>
        lottie.loadAnimation({
            container: document.getElementById('lottie-register'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: "{{ asset('lottie/home.json') }}"
        });
    </script>

    <script>
        // === FILTER KATEGORI ===
        function filterKategori(idKategori, btn) {
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-purple-600', 'text-white');
                b.classList.add('bg-gray-100', 'text-gray-700', 'dark:bg-gray-700', 'dark:text-gray-200');
            });
            btn.classList.add('bg-purple-600', 'text-white');
            btn.classList.remove('bg-gray-100', 'text-gray-700');

            document.querySelectorAll('.book-card').forEach(card => {
                if (idKategori === 'semua' || card.dataset.kategori === idKategori) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // === MODAL BUKU ===
        function bukaBukuModal(el) {
            document.getElementById('modal-cover').src = el.dataset.cover;
            document.getElementById('modal-judul').textContent = el.dataset.judul;
            document.getElementById('modal-pengarang').textContent = '✍️ ' + el.dataset.pengarang;
            document.getElementById('modal-penerbit').textContent = el.dataset.penerbit !== '-'
                ? '🏢 ' + el.dataset.penerbit + ' · ' + el.dataset.tahun
                : '📅 ' + el.dataset.tahun;
            document.getElementById('modal-kategori').textContent = el.dataset.kategoriNama;
            document.getElementById('modal-sinopsis').textContent = el.dataset.sinopsis;

            const modal = document.getElementById('modal-buku');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function tutupModal() {
            const modal = document.getElementById('modal-buku');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        // Klik backdrop untuk tutup
        document.getElementById('modal-buku').addEventListener('click', function (e) {
            if (e.target === this) tutupModal();
        });
    </script>

@endsection