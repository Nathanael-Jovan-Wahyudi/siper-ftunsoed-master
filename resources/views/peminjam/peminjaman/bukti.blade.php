<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Peminjaman Ruangan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; }
        .header { text-align: center; margin-bottom: 24px; }
        .title { font-size: 20px; font-weight: bold; margin-bottom: 8px; }
        .subtitle { font-size: 14px; margin-bottom: 24px; }
        .info-table { width: 100%; margin-bottom: 18px; }
        .info-table td { padding: 4px 8px; }
        .section-title { font-weight: bold; margin-top: 18px; margin-bottom: 6px; }
        .ttd { margin-top: 40px; display: flex; justify-content: space-between; }
        .ttd-col { width: 45%; text-align: center; }
        .ttd-label { margin-bottom: 60px; }
        .ttd-name { font-weight: bold; }
        .status-badge { display: inline-block; padding: 4px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Bukti Peminjaman Ruangan</div>
        <div class="subtitle">SIPER FT Unsoed</div>
    </div>
    <table class="info-table">
        <tr><td>Nama Peminjam</td><td>: {{ $peminjaman->user->nama_user }}</td></tr>
        <tr><td>Ruangan</td><td>: {{ $peminjaman->ruangan->nama_ruang }} - {{ $peminjaman->ruangan->gedung->nama_gedung }}</td></tr>
        <tr><td>Tujuan</td><td>: {{ $peminjaman->tujuan }}</td></tr>
        <tr><td>Detail Kegiatan</td><td>: {{ $peminjaman->detail_kegiatan }}</td></tr>
        <tr><td>Periode</td><td>: {{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d M Y') }} @if($peminjaman->tanggal_selesai && $peminjaman->tanggal_selesai != $peminjaman->tanggal_peminjaman)- {{ \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('d M Y') }}@endif</td></tr>
        <tr><td>Waktu</td><td>: {{ $peminjaman->jam_mulai }} - {{ $peminjaman->jam_selesai }}</td></tr>
        <tr><td>Status</td><td>:
            @if($peminjaman->status == 'disetujui subkoor')
                <span class="status-badge" style="background: #d4edda; color: #155724;">Disetujui Subkoor</span>
            @elseif($peminjaman->status == 'disetujui bapendik')
                <span class="status-badge" style="background: #cce5ff; color: #004085;">Disetujui Bapendik</span>
            @endif
        </td></tr>
    </table>
    <div class="section-title">Jadwal Detail</div>
    <table border="1" width="100%" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th style="padding: 4px 8px;">Hari Ke-</th>
                <th style="padding: 4px 8px;">Tanggal</th>
                <th style="padding: 4px 8px;">Jam Mulai</th>
                <th style="padding: 4px 8px;">Jam Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman->details as $index => $detail)
                <tr>
                    <td style="padding: 4px 8px;">{{ $index + 1 }}</td>
                    <td style="padding: 4px 8px;">{{ \Carbon\Carbon::parse($detail->tanggal)->format('d M Y') }}</td>
                    <td style="padding: 4px 8px;">{{ $detail->jam_mulai }}</td>
                    <td style="padding: 4px 8px;">{{ $detail->jam_selesai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="ttd">
        <div class="ttd-col">
            <div class="ttd-label">Disetujui Subkoor</div>
            <div class="ttd-name">&nbsp;</div>
        </div>
        <div class="ttd-col">
            <div class="ttd-label">Disetujui Bapendik</div>
            <div class="ttd-name">&nbsp;</div>
        </div>
    </div>
</body>
</html>