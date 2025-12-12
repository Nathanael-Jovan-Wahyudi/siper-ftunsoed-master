<x-dashboard-layout>
    <x-slot name="title">SIPER - Arsip Peminjaman</x-slot>
    <x-slot name="profileLabel">{{ Auth::user()->nama_user }}</x-slot>
    
    <x-slot name="navigation">
        <li class="nav-item" onclick="window.location.href='{{ route('admin.dashboard') }}'">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>
        </li>
        <li class="nav-item active">
            <i class="fas fa-archive"></i>
            <span>Arsip Peminjaman</span>
        </li>
        <li class="nav-item" onclick="window.location.href='{{ route('admin.notifikasi.index') }}'">
            <i class="fas fa-bell"></i>
            <span>Notifikasi</span>
        </li>
    </x-slot>

    <div class="archive-container">
        <h2 class="panel-title">Arsip Peminjaman</h2>
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Cari arsip...">
        </div>
        <table class="archive-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Ruangan</th>
                    <th>Waktu</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="archive-tbody">
                <!-- Data will be populated by JavaScript -->
            </tbody>
        </table>
    </div>


</x-dashboard-layout>