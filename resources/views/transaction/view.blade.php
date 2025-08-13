<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="mt-2">
                    <div class="text-end mb-3">
                        <x-primary-button size="sm"><a href="/transaction/create">{{ __('Add') }} <i class="btn fa fa-add ml-1"></i></a></x-primary-button>
                        <button type="button" class="px-3 py-1.5 text-sm inline-flex items-center border border-transparent rounded-md font-semibold uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 bg-indigo-600 text-white hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900" onclick="my_modal_1.showModal()">Cari<i class="fa fa-search ml-1"></i></button>
                    </div>
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Nomor Transaksi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Tipe Transaksi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Tanggal Transaksi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Tanggal Selesai</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Status Pembayaran</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Status Pemesanan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Total Harga</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider w-1">Action</th>
                                    {{-- Tambahkan kolom lain jika diperlukan, misalnya untuk Aksi --}}
                                </tr->
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @if ($data->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Tidak ada data!</td>
                                    </tr>
                                @endif
                                @foreach ($data as $index => $dt)
                                <tr>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-600 dark:text-gray-100">
                                        <a href="/transaction/detail/{{ $dt->id }}">
                                            <p>{{ $dt->order_id }}</p>
                                            <span>{{ $dt->customer->customer_name }}</span>
                                        </a>
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $dt->transaction_type->name }}</td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $dt->transaction_date }}</td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $dt->completion_date }}</td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        <x-status-badge id="{{ $dt->status_payment->id }}" status="{{ $dt->status_payment->name }}"/>
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        <x-status-badge id="{{ $dt->status->id }}" status="{{ $dt->status->name }}"/>
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        <span class="rupiah">{{ $dt->amount }}</span>
                                    </td>
                                    <td class="@if($dt->status->id !== 1 && $dt->status->id !== 5) hidden @endif px-6 py-1 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                        {{-- <a href="/users/{{ $dt->id }}" class="mr-1" title="Edit"><i class="fa fa-edit"></i></a> --}}
                                        <form method="POST" action="{{ route('transaction.delete',$dt->id) }}">
                                            @method('delete')
                                            @csrf
                                            <button class="mr-1" title="Delete"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination mt-3">
                        {{$data->links() }}
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
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Filter Data</h3>
            <div class="modal-action">
                <form method="POST" action="{{ route('transaction.filter') }}">
                @csrf
                <div class="mb-2">
                    <div class="mb-3">
                        <x-input-label for="order_id" :value="__('Nomor Transaksi')" />
                        <input type="text" name="order_id" id="order_id" class="input w-full rounded-md px-4 py-2 focus:outline-none border-gray-300">
                    </div>
                    <div class="mb-3">
                        <x-input-label for="customer" :value="__('Nama Pelanggan')" />
                        <input type="text" name="customer" id="customer" class="input w-full rounded-md px-4 py-2 focus:outline-none border-gray-300">
                    </div>
                    <div class="mb-3">
                        <x-input-label for="transaction_type_id" :value="__('Tipe Transaksi')" />
                        <select name="transaction_type_id" id="transaction_type_id" class="item_id select rounded-md mt-1 block w-full border-slate-300">
                            <option value="" disabled selected>Pilih</option>
                            @foreach($transactionType as $r)
                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="payment_status_id" :value="__('Status Pembayaran')" />
                        <select name="payment_status_id" id="payment_status_id" class="item_id select rounded-md mt-1 block w-full border-slate-300">
                            <option value="" disabled selected>Pilih</option>
                            @foreach($paymentStatus as $r)
                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="status_transaction" :value="__('Status Pemesanan')" />
                        <select name="status_transaction" id="status_transaction" class="select rounded-md mt-1 block w-full border-slate-300">
                            <option value="" disabled selected>Pilih</option>
                            @foreach($statusTransaction as $r)
                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 flex space-x-1">
                        <div class="w-2/4 mr-1">
                            <x-input-label for="transaction_date" :value="__('Tanggal Masuk')" />
                            <x-text-input id="transaction_date" name="transaction_date" type="date"
                                class="mt-1 block w-full"
                                autofocus autocomplete="transaction_date" />
                        </div>
                        <div class="w-2/4 ml-1">
                            <x-input-label for="completion_date" :value="__('Tanggal Selesai')" />
                            <x-text-input id="completion_date" name="completion_date" type="date"
                                class="mt-1 block w-full"
                                autofocus autocomplete="completion_date" />
                        </div>
                    </div>
                </div>

                <div class="action mt-4 text-end">
                    <button id="addDetail" type="submit" class="btn bg-indigo-600 text-white hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 px-4 py-2 rounded-md font-semibold text-xs shadow-sm transition ease-in-out duration-150 uppercase tracking-widest" type="button" size="sm">Cari</button>
                    <button id="close-modal" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.rupiah').forEach(function(cell) {
        let rawValue = parseInt(cell.textContent);
        cell.textContent = formatRupiah(rawValue.toString());
        });
    });
</script>
