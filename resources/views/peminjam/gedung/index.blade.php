<x-dashboard-layout>
    <x-slot name="title">Daftar Gedung - SIPER FT Unsoed</x-slot>
    <x-slot name="profileLabel">{{ Auth::user()->nama_user }}</x-slot>
    
    <x-slot name="navigation">
        <ul>
            <li><a href="{{ route('peminjam.dashboard') }}" class="nav-item active">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a></li>
            <li><a href="{{ route('peminjam.ajuan.create') }}" class="nav-item">
                <i class="fas fa-plus-circle"></i>
                <span>Ajukan Peminjaman</span>
            </a></li>
            <li><a href="{{ route('peminjam.gedung.index') }}" class="nav-item">
                <i class="fas fa-building"></i>
                <span>Daftar Gedung</span>
            </a></li>
            <li><a href="{{ route('peminjam.notifikasi.index') }}" class="nav-item">
                <i class="fas fa-bell"></i>
                <span>Notifikasi</span>
            </a></li>
        </ul>
    </x-slot>

    <h1 style="font-size: 28px; font-weight: 700; color: #1e1e2d; margin-bottom:  10px;">Daftar Gedung</h1>
    <div class="search-bar" style="margin-bottom: 30px;">
        <input type="text" id="search-gedung" placeholder="Cari gedung..." style="width: 100%; max-width: 400px; padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 24px;">
        @forelse($gedungs as $gedung)
            <div class="gedung-card" style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); transition: transform 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                @php
                    $mapping = [
                        'gedung a' => 'Gedung_A.jpg',
                        'gedung c' => 'Gedung_C.jpg',
                        'gedung d/laboratorium' => 'Gedung_D.jpg',
                        'e' => 'Gedung_E.jpg',
                        'f' => 'Gedung_F.jpg',
                        'aula f' => 'Gedung_F.jpg',
                        'lapangan basket' => 'Gedung_C.jpg',
                        'masjid teknik' => 'Mastek.jpg',
                    ];
                    $nama = strtolower(trim($gedung->nama_gedung));
                    $img = $mapping[$nama] ?? 'Gedung_A.jpg';
                @endphp
                <img src="{{ asset('images/gedung/' . $img) }}" alt="Foto Gedung" style="width: 100%; max-width: 180px; height: 120px; object-fit: cover; border-radius: 10px; margin-bottom: 15px;">
                <h3 style="margin: 0 0 10px 0; color: #1e1e2d; font-size: 20px; font-weight: 600;">{{ $gedung->nama_gedung }}</h3>
                <a href="{{ route('peminjam.ruangan.showGedung', $gedung->gedung_id) }}" style="display: inline-block; padding: 10px 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 8px; font-size: 14px; transition: background-color 0.3s; margin-top: 10px;" onmouseover="this.style.backgroundColor='#2980b9'" onmouseout="this.style.backgroundColor='#3498db'">
                    Lihat Ruangan
                </a>
            </div>
        @empty
            <p style="grid-column: 1 / -1; text-align: center; color: #666; padding: 40px;">Belum ada data gedung</p>
        @endforelse
    </div>

    <x-slot name="scripts">
        <script>
            document.getElementById('search-gedung')?.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const cards = document.querySelectorAll('.gedung-card');
                cards.forEach(card => {
                    const text = card.textContent.toLowerCase();
                    card.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        </script>
    </x-slot>
</x-dashboard-layout>
