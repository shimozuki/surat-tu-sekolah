@extends('layouts.app')
@section('title', 'Data Surat')
@section('suratKeluarSudahTTD', 'bg-gray-100 dark:bg-gray-700')

@section('content')
<div
    class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Data Surat</h1>
        </div>

        {{-- Filter Form --}}
        <form method="GET" action="{{ route('laporan.index') }}"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 items-end mb-5">

            {{-- Jenis Surat --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Surat</label>
                <select name="jenis"
                    class="w-full border rounded-lg p-2 dark:bg-gray-700 dark:text-white">
                    <option value="">-- Pilih Jenis Surat --</option>
                    <option value="masuk" {{ request('jenis') == 'masuk' ? 'selected' : '' }}>Surat Masuk</option>
                    <option value="keluar" {{ request('jenis') == 'keluar' ? 'selected' : '' }}>Surat Keluar</option>
                </select>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                <select name="status"
                    class="w-full border rounded-lg p-2 dark:bg-gray-700 dark:text-white">
                    <option value="">-- Pilih Status --</option>
                    <option value="belum" {{ request('status') == 'belum' ? 'selected' : '' }}>Belum</option>
                    <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                </select>
            </div>

            {{-- Start Date --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                    class="w-full border rounded-lg p-2 dark:bg-gray-700 dark:text-white" />
            </div>

            {{-- End Date --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}"
                    class="w-full border rounded-lg p-2 dark:bg-gray-700 dark:text-white" />
            </div>

            {{-- Tombol --}}
            <div class="flex gap-2">
                <button type="submit"
                    class="ml-2 inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-primary-800">
                    Filter
                </button>
                <a href="{{ route('laporan.index') }}"
                    class="ml-2 inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-red-700 hover:bg-blue-800 focus:ring-4 focus:ring-red-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-primary-800">
                    Reset
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Tabel Data --}}
<div class="mt-4 overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
        <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase">Nomor Berkas</th>
                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase">Perihal</th>
                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="p-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
            @forelse ($surat as $item)
            <tr>
                <td class="p-3">{{ $loop->iteration }}</td>
                <td class="p-3">{{ $item->nomor_berkas }}</td>
                <td class="p-3">{{ $item->tanggal }}</td>
                <td class="p-3">{{ $item->perihal }}</td>
                <td class="p-3 capitalize">{{ $item->jenis }}</td>
                <td class="p-3 capitalize">{{ $item->status_persetujuan }}</td>
                <td class="p-3 text-center">
                    <a href="{{ route('surat.show', $item->id) }}"
                        class="px-2 py-1 text-sm text-white bg-yellow-600 rounded hover:bg-yellow-700">
                        Lihat
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="p-3 text-center text-gray-500">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="mt-4">
    {{ $surat->appends(request()->query())->links() }}
</div>
@endsection