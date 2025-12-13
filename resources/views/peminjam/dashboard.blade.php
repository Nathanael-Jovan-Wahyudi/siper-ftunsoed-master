<x-dashboard-layout>
    <x-slot name="title">Dashboard Peminjam - SIPER FT Unsoed</x-slot>
    <x-slot name="profileLabel">{{ Auth::user()->nama_user }}</x-slot>
    
    <x-slot name="navigation">
        <ul>
            <li>
                <a href="{{ route('peminjam.dashboard') }}" class="nav-item active">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('peminjam.ajuan.create') }}" class="nav-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>Ajukan Peminjaman</span>
                </a>
            </li>
            <li>
                <a href="{{ route('peminjam.ruangan.index') }}" class="nav-item">
                    <i class="fas fa-building"></i>
                    <span>Daftar Ruangan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('peminjam.notifikasi.index') }}" class="nav-item">
                    <i class="fas fa-bell"></i>
                    <span>Notifikasi</span>
                </a>
            </li>
        </ul>
    </x-slot>


    <h1 style="font-size: 28px; font-weight: 700; color: #1e1e2d; margin-bottom:  10px;">SIPER - Dashboard Peminjam</h1>

    @if(session('success'))
        <div class="alert alert-success" style="padding: 15px; background-color: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <p class="section-title" style="font-size: 18px; font-weight: 600; margin-bottom: 15px; color: #2c3e50;">
        Pilih Gedung Terlebih Dahulu
    </p>
    <div class="search-bar" style="margin-bottom: 30px;">
        <input type="text" id="search-gedung" placeholder="Cari gedung..." style="width: 100%; max-width: 400px; padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 24px; margin-bottom: 40px;">
        @forelse($gedungs as $gedung)
            <div class="gedung-card" style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); transition: transform 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <img src="{{ asset('images/gedung_default.jpg') }}" alt="Foto Gedung" style="width: 100%; max-width: 180px; height: 120px; object-fit: cover; border-radius: 10px; margin-bottom: 15px;">
                <h3 style="margin: 0 0 10px 0; color: #1e1e2d; font-size: 20px; font-weight: 600;">{{ $gedung->nama_gedung }}</h3>
                <a href="{{ route('peminjam.ruangan.showGedung', $gedung->gedung_id) }}" style="display: inline-block; padding: 10px 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 8px; font-size: 14px; transition: background-color 0.3s; margin-top: 10px;" onmouseover="this.style.backgroundColor='#2980b9'" onmouseout="this.style.backgroundColor='#3498db'">
                    Lihat Ruangan
                </a>
            </div>
        @empty
            <p style="grid-column: 1 / -1; text-align: center; color: #666; padding: 40px;">Belum ada data gedung</p>
        @endforelse
    </div>

    <p class="section-title" style="font-size: 18px; font-weight: 600; margin-bottom: 15px; color: #2c3e50;">
        Daftar Ajuan Anda
    </p>

    <table class="peminjaman-table" style="width: 100%; background: white; border-collapse: collapse; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <thead>
            <tr>
                <th style="padding: 12px 15px; text-align: left; background-color: #34495e; color: white; font-weight: 500;">No</th>
                <th style="padding: 12px 15px; text-align: left; background-color: #34495e; color: white; font-weight: 500;">Ruangan</th>
                <th style="padding: 12px 15px; text-align: left; background-color: #34495e; color: white; font-weight: 500;">Tanggal</th>
                <th style="padding: 12px 15px; text-align: left; background-color: #34495e; color: white; font-weight: 500;">Waktu</th>
                <th style="padding: 12px 15px; text-align: left; background-color: #34495e; color: white; font-weight: 500;">Status</th>
                <th style="padding: 12px 15px; text-align: left; background-color: #34495e; color: white; font-weight: 500;">Aksi</th>
            </tr>
        </thead>
        <tbody id="ajuan-tbody">
            @forelse($peminjamans ?? [] as $index => $peminjaman)
                <tr style="border-bottom: 1px solid #ecf0f1;">
                    <td style="padding: 12px 15px;">{{ $index + 1 }}</td>
                    <td style="padding: 12px 15px;">{{ $peminjaman->ruangan->nama_ruang }}</td>
                    <td style="padding: 12px 15px;">{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d M Y') }}</td>
                    <td style="padding: 12px 15px;">{{ $peminjaman->jam_mulai }} - {{ $peminjaman->jam_selesai }}</td>
                    <td style="padding: 12px 15px;">
                        @if($peminjaman->status == 'pending')
                            <span style="display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500; background-color: #fff3cd; color: #856404;">
                                Menunggu Approval
                            </span>
                        @elseif($peminjaman->status == 'disetujui bapendik')
                            <span style="display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500; background-color: #cce5ff; color: #004085;">
                                Disetujui Bapendik
                            </span>
                        @elseif($peminjaman->status == 'disetujui subkoor')
                            <span style="display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500; background-color: #d4edda; color: #155724;">
                                Disetujui
                            </span>
                        @elseif(str_contains($peminjaman->status, 'ditolak'))
                            <span style="display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500; background-color: #f8d7da; color: #721c24;">
                                Ditolak
                            </span>
                        @else
                            <span style="display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500; background-color: #e2e3e5; color: #383d41;">
                                {{ ucfirst($peminjaman->status) }}
                            </span>
                        @endif
                    </td>
                    <td style="padding: 12px 15px;">
                        <a href="{{ route('peminjam.peminjaman.detail', $peminjaman->peminjaman_id) }}" style="color: #3498db; text-decoration: none;">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center; color: #666;">
                        Belum ada ajuan peminjaman
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

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