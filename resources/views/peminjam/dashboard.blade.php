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



    <h1 style="font-size: 32px; font-weight: 700; color: #1e1e2d; margin-bottom: 30px; text-align: center;"></h1>

    @if(session('success'))
        <div class="alert alert-success" style="padding: 15px; background-color: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: white; border-radius: 18px; padding: 32px 32px 24px 32px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); max-width: 1100px; margin: 0 auto;">
        <div style="display: flex; gap: 0; border-bottom: 2px solid #f0f0f0; margin-bottom: 24px;">
            <button id="tab-dipinjam" class="tab-btn active" style="background: none; border: none; font-size: 18px; font-weight: 600; color: #222; padding: 12px 32px 12px 0; border-bottom: 3px solid #5a5af3; cursor: pointer;">Ruangan Dipinjam</button>
            <button id="tab-riwayat" class="tab-btn" style="background: none; border: none; font-size: 18px; font-weight: 600; color: #888; padding: 12px 0 12px 32px; border-bottom: 3px solid transparent; cursor: pointer;">Riwayat Pinjaman</button>
        </div>

        <div id="panel-dipinjam">
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 0;">
                <thead>
                    <tr style="background: #f6f6fa;">
                        <th style="padding: 12px 10px; text-align: left; color: #888; font-weight: 600;">No.</th>
                        <th style="padding: 12px 10px; text-align: left; color: #888; font-weight: 600;">Tanggal</th>
                        <th style="padding: 12px 10px; text-align: left; color: #888; font-weight: 600;">Ruang</th>
                        <th style="padding: 12px 10px; text-align: left; color: #888; font-weight: 600;">Waktu</th>
                        <th style="padding: 12px 10px; text-align: left; color: #888; font-weight: 600;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse(($ruanganDipinjam ?? []) as $peminjaman)
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 12px 10px;">{{ $no++ }}</td>
                            <td style="padding: 12px 10px;">{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->translatedFormat('d F Y') }}</td>
                            <td style="padding: 12px 10px;">{{ $peminjaman->ruangan->nama_ruang ?? '-' }}</td>
                            <td style="padding: 12px 10px;">{{ $peminjaman->jam_mulai }} - {{ $peminjaman->jam_selesai }}</td>
                            <td style="padding: 12px 10px;">
                                @if($peminjaman->status == 'dipinjam')
                                    <span style="display: inline-block; padding: 4px 16px; border-radius: 8px; background: #ffe5e5; color: #c0392b; font-weight: 600;">Dipinjam</span>
                                @elseif($peminjaman->status == 'disetujui subkoor')
                                    <span style="display: inline-block; padding: 4px 16px; border-radius: 8px; background: #d4edda; color: #155724; font-weight: 600;">Disetujui Subkoor</span>
                                @elseif($peminjaman->status == 'disetujui bapendik')
                                    <span style="display: inline-block; padding: 4px 16px; border-radius: 8px; background: #cce5ff; color: #004085; font-weight: 600;">Disetujui Bapendik</span>
                                @else
                                    <span style="display: inline-block; padding: 4px 16px; border-radius: 8px; background: #e2e3e5; color: #383d41; font-weight: 600;">{{ ucfirst($peminjaman->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" style="text-align: center; color: #888; padding: 24px;">Tidak ada ruangan yang sedang dipinjam.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div id="panel-riwayat" style="display: none;">
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 0;">
                <thead>
                    <tr style="background: #f6f6fa;">
                        <th style="padding: 12px 10px; text-align: left; color: #888; font-weight: 600;">No.</th>
                        <th style="padding: 12px 10px; text-align: left; color: #888; font-weight: 600;">Tanggal</th>
                        <th style="padding: 12px 10px; text-align: left; color: #888; font-weight: 600;">Judul</th>
                        <th style="padding: 12px 10px; text-align: left; color: #888; font-weight: 600;">Ruang</th>
                        <th style="padding: 12px 10px; text-align: left; color: #888; font-weight: 600;">Waktu</th>
                        <th style="padding: 12px 10px; text-align: left; color: #888; font-weight: 600;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse(($riwayatPeminjaman ?? []) as $peminjaman)
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 12px 10px;">{{ $no++ }}</td>
                            <td style="padding: 12px 10px;">{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->translatedFormat('d F Y') }}</td>
                            <td style="padding: 12px 10px;">{{ $peminjaman->tujuan ?? '-' }}</td>
                            <td style="padding: 12px 10px;">{{ $peminjaman->ruangan->nama_ruang ?? '-' }}</td>
                            <td style="padding: 12px 10px;">{{ $peminjaman->jam_mulai }} - {{ $peminjaman->jam_selesai }}</td>
                            <td style="padding: 12px 10px;">
                                @if($peminjaman->status == 'disetujui subkoor')
                                    <span style="display: inline-block; padding: 4px 16px; border-radius: 8px; background: #d4edda; color: #155724; font-weight: 600;">Disetujui Subkoor</span>
                                @elseif($peminjaman->status == 'disetujui bapendik')
                                    <span style="display: inline-block; padding: 4px 16px; border-radius: 8px; background: #cce5ff; color: #004085; font-weight: 600;">Disetujui Bapendik</span>
                                @elseif(str_contains($peminjaman->status, 'ditolak'))
                                    <span style="display: inline-block; padding: 4px 16px; border-radius: 8px; background: #f8d7da; color: #721c24; font-weight: 600;">Ditolak</span>
                                @elseif($peminjaman->status == 'selesai')
                                    <span style="display: inline-block; padding: 4px 16px; border-radius: 8px; background: #e2e3e5; color: #383d41; font-weight: 600;">Selesai</span>
                                @elseif($peminjaman->status == 'pending')
                                    <span style="display: inline-block; padding: 4px 16px; border-radius: 8px; background: #fff6e0; color: #b7950b; font-weight: 600;">Menunggu Approval</span>
                                @else
                                    <span style="display: inline-block; padding: 4px 16px; border-radius: 8px; background: #e2e3e5; color: #383d41; font-weight: 600;">{{ ucfirst($peminjaman->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" style="text-align: center; color: #888; padding: 24px;">Tidak ada riwayat peminjaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            // Tab switching logic
            function activateTab(tab) {
                if(tab === 'dipinjam') {
                    document.getElementById('tab-dipinjam').classList.add('active');
                    document.getElementById('tab-riwayat').classList.remove('active');
                    document.getElementById('panel-dipinjam').style.display = '';
                    document.getElementById('panel-riwayat').style.display = 'none';
                    document.getElementById('tab-dipinjam').style.color = '#222';
                    document.getElementById('tab-riwayat').style.color = '#888';
                    document.getElementById('tab-dipinjam').style.borderBottom = '3px solid #5a5af3';
                    document.getElementById('tab-riwayat').style.borderBottom = '3px solid transparent';
                } else {
                    document.getElementById('tab-riwayat').classList.add('active');
                    document.getElementById('tab-dipinjam').classList.remove('active');
                    document.getElementById('panel-dipinjam').style.display = 'none';
                    document.getElementById('panel-riwayat').style.display = '';
                    document.getElementById('tab-riwayat').style.color = '#222';
                    document.getElementById('tab-dipinjam').style.color = '#888';
                    document.getElementById('tab-riwayat').style.borderBottom = '3px solid #5a5af3';
                    document.getElementById('tab-dipinjam').style.borderBottom = '3px solid transparent';
                }
            }
            document.getElementById('tab-dipinjam').onclick = function() { activateTab('dipinjam'); };
            document.getElementById('tab-riwayat').onclick = function() { activateTab('riwayat'); };
            activateTab('dipinjam');

            // Search bar for gedung (if present)
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