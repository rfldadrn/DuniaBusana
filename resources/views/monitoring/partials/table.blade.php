
<div id="tableContainer" class="overflow-x-auto shadow-md sm:rounded-lg">
    <table class="table min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Nomor Transaksi</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Item</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Qty</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Note</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Status Item</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider w-1">Action</th>
                {{-- Tambahkan kolom lain jika diperlukan, misalnya untuk Aksi --}}
            </tr->
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
            @if ($orderDetail->isEmpty())
                <tr>
                    <td colspan="8" class="text-center px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Tidak ada data!</td>
                </tr>
            @endif
            @php
                $grouped = $orderDetail->groupBy(fn($dt) => $dt->trInfo->order_id);
            @endphp
            @foreach ($grouped as $orderId => $details)
                @foreach ($details as $index => $dt)
                    <tr>
                        @if ($index === 0)
                            <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-600 dark:text-gray-100" rowspan="{{ $details->count() }}">
                                <a href="{{ route('monitoring.detail',$dt->trInfo->id) }}">
                                    <p>{{ $dt->trInfo->order_id }}</p>
                                    <span>{{ $dt->trInfo->customer->customer_name }}</span>
                                </a>
                            </td>
                        @endif
                        <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $dt->items->name }}</td>
                        <td class="px-6 py-2 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">{{ $dt->qty }}</td>
                        <td class="px-6 py-2 whitespace-nowrap max-w-[200px] truncate text-ellipsis text-sm text-gray-500 dark:text-gray-400" title="{{ $dt->note }}">{{ $dt->note }}</td>
                        <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            <x-status-badge id="{{ $dt->status_order_item->id }}" status="{{ $dt->status_order_item->name }}"/>
                        </td>
                        <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                            <button type="button" class="btn" onclick="showModalDetail({{ $dt }})"><i class="fa fa-history"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
<div class="pagination mt-3">
    {{ $orderDetail->links() }}
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function(e) {
    const query = e.target.value;
    fetch(`?search=${encodeURIComponent(query)}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById('tableContainer').innerHTML = html;
    })
    .catch(error => {
        console.error('Search error:', error);
    });
});
</script>
