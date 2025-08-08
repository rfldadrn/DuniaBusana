@php
    $colors = [
        '1' => 'bg-blue-100 text-blue-800', //Orderan Baru
        '2' => 'bg-yellow-100 text-yellow-600', //Dalam Proses
        '3' => 'bg-green-100 text-green-800', //Siap Diambil
        '4' => 'bg-gray-100 text-gray-800', //Selesai
        '5' => 'bg-red-100 text-red-800', //Dibatalkan
        '6' => 'bg-purple-100 text-purple-800', //Perbaikan
        '7' => 'bg-orange-100 text-orange-800', //Menunggu Konfirmasi
    ];

    $class = $colors[$id] ?? 'bg-blue-500 text-white';
@endphp

<span class="px-2 py-1 rounded-full text-sm {{ $class }}">
    {{ ucfirst($status) }}
</span>
