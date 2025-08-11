<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Monitoring Jahitan') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="mt-2">
                    <div class="action text-end mb-3">
                        <input type="text" id="search" autocomplete="off"
                                    class="w-full rounded-md px-4 py-2 focus:outline-none border-gray-300"
                                    placeholder="Cari item...">
                    </div>
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
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
                                                    <a href="#">
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
                        {{$orderDetail->links() }}
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>

<dialog id="my_modal_1" class="modal">
    <div class="modal-box p-6 rounded-lg shadow-lg bg-white max-w-lg mx-auto">
        <div class="content w-[400px]">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Info Jahitan</h3>
            <div class="modal-action">
                <form method="POST" action="{{ route('monitoring.updateDetail') }}">
                    @csrf
                    <div class="mb-2">
                        <input type="hidden" name="value_id" id="value_id" value="">
                        <div class="mb-3">
                            <x-input-label for="order_id" :value="__('Nomor Transaksi')" />
                            <label id="value_order_id" class="block text-sm font-medium text-gray-700 mb-2">-</label>
                        </div>
                        <div class="mb-3">
                            <x-input-label for="item_id" :value="__('Jenis Pakaian')" />
                            <label id="value_item_id" class="block text-sm font-medium text-gray-700 mb-2">-</label>
                        </div>
                    </div>

                    <div class="mb-2">
                        <x-input-label for="Status" :value="__('Status')" />
                        <select name="status_order_item_id" id="value_status_order_item_id" class="status_order_item_id select rounded-md mt-1 block w-full border-slate-300" required>
                            @foreach($statusOrderItem as $r)
                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="action mt-4 text-end">
                        <button id="addDetail" type="submit" class="btn bg-indigo-600 text-white hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 px-4 py-2 rounded-md font-semibold text-xs shadow-sm transition ease-in-out duration-150 uppercase tracking-widest" type="button" size="sm">Simpan</button>
                        <button id="close-modal" type="button" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</dialog>

<script>
    function showModalDetail(data){
        console.log(data);
        document.getElementById('value_id').value = data.id
        document.getElementById('value_order_id').textContent = data.tr_info.order_id + " - " + data.tr_info.customer.customer_name
        document.getElementById('value_item_id').textContent = data.items.name
        document.getElementById('value_status_order_item_id').value = data.status_order_item_id
        my_modal_1.showModal()
    }
    document.getElementById('close-modal').addEventListener('click', function () {
        const modal = document.getElementById('my_modal_1');
        if (modal) modal.close(); // or modal.classList.add('hidden') if using Tailwind-style modals
    });

</script>

