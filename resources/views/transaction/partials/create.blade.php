<section>
    <form action="{{ route('transaction.store') }}" class="" id="mainForm" method="POST">
        <div class="header w-full bg-blue-600 text-white hover:bg-blue-700 p-2 flex">
            <div class="w-1/2">
                <span class="text-xs">Status : Transaksi Baru</span>
            </div>
            <div class="w-1/2">
                <span class="text-xs float-end py-1">Tanggal : {{ date('d-F-y') }}</span>
            </div>
        </div>
        <div class="flex w-full mb-3">
            @csrf
            {{-- Detail Info Card --}}
            <div class="card bg-base-300 rounded-box grid grow mr-3 w-3/6">
                <div class="card bg-base-100 shadow-md">
                    <div class="card-body p-4">
                        <header class="place-items-center mb-6">
                            <h5 class="text-gray-600 font-semibold">Info Transaksi</h5>
                        </header>

                        <div class="detail-info">
                            {{-- Name Field --}}
                            <div class="mb-3">
                                <x-input-label for="Nomor Orderan" :value="__('Nomor Orderan')" />
                                <x-text-input id="id" name="id" type="hidden" class="mt-1 block w-full" />
                                <x-text-input id="order_id" name="order_id" type="text" value={{$trxID}}
                                    class="mt-1 block w-full"
                                    required autofocus autocomplete="order_id" readonly/>
                                <x-input-error class="mt-2" :messages="$errors->get('order_id')" />
                            </div>

                            {{-- Tipe Transaksi --}}

                            {{-- Custmer Field --}}
                            <div class="mb-3">
                                <div class="max-w-xl mx-auto">
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Cari Pelanggan</label>
                                    <input type="hidden" name="customer_id" id="customer_id">
                                    <input type="text" id="phoneInput" autocomplete="off"
                                    class="w-full rounded-md px-4 py-2 focus:outline-none border-gray-300"
                                    placeholder="Cari pelanggan dengan nomor telp..." onkeyup="fetchCustomers(this.value)">
                                    <ul id="dropdownResults" class="border border-gray-300 mt-1 rounded-lg shadow max-h-60 overflow-y-auto hidden bg-white z-10">
                                        <!-- Dynamic options appear here -->
                                    </ul>
                                </div>
                                <div class="max-w-xl mx-auto">
                                    <label id="customer_name" class="block text-sm font-semibold mb-2 pl-1"></label>
                                </div>
                                @error('customer_id')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <span class="text-sm font-medium text-gray-700">Tipe Transaksi</span>
                                <div class="mt-2 flex gap-4">
                                    @foreach($transactionType as $r)
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="transaction_type_id" value="{{ $r->id }}" class="form-radio text-blue-600"
                                            {{old('transaction_type_id') == $r->id ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700">{{ $r->name }}</span>
                                        </label>
                                    @endforeach
                                </div>

                                @error('transaction_type_id')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Date Field --}}
                            <div class="mb-3 flex">
                                <div class="w-2/4 mr-1">
                                    <x-input-label for="transaction_date" :value="__('Tanggal Masuk')" />
                                    <x-text-input id="transaction_date" name="transaction_date" type="date" value="{{ old('transaction_date') }}"
                                        class="mt-1 block w-full"
                                        required autofocus autocomplete="transaction_date" />
                                    <x-input-error class="mt-2" :messages="$errors->get('transaction_date')" />
                                </div>
                                <div class="w-2/4 ml-1">
                                    <x-input-label for="completion_date" :value="__('Tanggal Selesai')" />
                                    <x-text-input id="completion_date" name="completion_date" type="date" value="{{ old('completion_date') }}"
                                        class="mt-1 block w-full"
                                        required autofocus autocomplete="completion_date" />
                                    <x-input-error class="mt-2" :messages="$errors->get('completion_date')" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- List Order Card --}}
            <div class="card bg-base-300 rounded-box grid grow w-3/6">
                <div class="card bg-base-100 shadow-md">
                    <div class="card-body p-4">
                        <header class="place-items-center mb-6">
                            <h5 class="text-gray-600 font-semibold">Info Pembayaran</h5>
                        </header>

                        <div class="detail-info">
                            {{-- Amount Field --}}
                            <div class="mb-3">
                                <div class="flex space-x-1">
                                    <div class="w-1/3">
                                        <x-input-label for="amount" :value="__('Total Harga')" />
                                        <x-text-input id="amount" name="amount" type="text"
                                            class="mt-1 block w-full text-end" value="0"
                                            required autofocus autocomplete="off" readonly/>
                                        <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                                    </div>
                                    <div class="w-1/3">
                                        <x-input-label for="paid_amount" :value="__('Total Bayar')" />
                                        <x-text-input id="paid_amount" name="paid_amount" type="text"
                                            class="mt-1 block w-full text-end" onkeyup="calcBalanceDue(this.value,this.id)"
                                            autofocus autocomplete="off" />
                                        <x-input-error class="mt-2" :messages="$errors->get('paid_amount')" />
                                    </div>
                                    <div class="w-1/3">
                                        <x-input-label for="balance_due" :value="__('Sisa Pembayaran')" />
                                        <x-text-input id="balance_due" name="balance_due" type="text"
                                            class="mt-1 block w-full text-end" value="0"
                                            required autofocus autocomplete="off" readonly/>
                                        <x-input-error class="mt-2" :messages="$errors->get('balance_due')" />
                                    </div>
                                </div>
                            </div>

                            {{-- Status Transaction Field --}}
                            <div class="mb-3">
                                <x-input-label for="status_transaction" :value="__('Status Transaksi')" />
                                <select name="status_transaction" class="select mt-1 block w-full rounded-md border-slate-300">
                                    @foreach($statusTransaction as $r)
                                        <option value="{{$r['id']}}" >{{$r['name']}}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status_transaction')" />
                            </div>

                            {{-- Notes Field --}}
                            <div class="mb-3">
                                <x-input-label for="notes" :value="__('Catatan Transaksi')" />
                                <x-textarea name="notes" :value="old('notes')" />
                                <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                            </div>
                            <input type="hidden" id="list-order" name="list_order" value="{{ old('list_order') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
        <hr class="mb-3">
        <div class="w-full">
            {{-- <header class="place-items-center mb-2">
                <h2 class="text-gray-600 font-semibold">List Pesanan</h2>
            </header> --}}
            <div class="list-order max-h-80 overflow-auto">
            <table id="table-order-list" class="table-auto w-full border border-gray-300">
                <thead class="bg-gray-100 sticky top-0">
                    <tr>
                        <th colspan="6" class="px-4 text-sm py-1 text-end border-b">
                            <button type="button" class="btn" onclick="my_modal_1.showModal()"><i class="fa fa-add"></i></button>
                        </th>
                    </tr>
                    <tr>
                        <th class="px-4 text-sm py-1 text-left border-b">Action</th>
                        <th class="px-4 text-sm py-1 text-left border-b">Item</th>
                        <th class="px-4 text-sm py-1 border-b text-center">Qty</th>
                        <th class="px-4 text-sm py-1 border-b text-center">Keterangan</th>
                        <th class="px-4 text-sm py-1 text-center border-b">Price</th>
                        <th class="px-4 text-sm py-1 text-center border-b">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" class="px-4 text-sm py-1 border-b text-center">Belum ada pesanan!</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-slate-300">
                        <th class="px-4 text-sm py-1 border-b text-center" colspan="4">Total Harga</th>
                        <th class="px-4 text-sm py-1 text-end border-b" colspan="2"><span id="tb-total-harga">-</span></th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
        <div class="mt-6 flex justify-end gap-4">
            <button type="submit" form="mainForm" class="btn bg-indigo-600 text-white hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 px-5 py-2 rounded shadow">
                <i class="fa fa-save"></i> Simpan
            </button>
            <a href="/transaction" class="btn bg-gray-300 text-gray-800 hover:bg-gray-400 px-5 py-2 rounded shadow">Batal</a>
        </div>

</section>
<dialog id="my_modal_1" class="modal">
    <div class="modal-box p-6 rounded-lg shadow-lg bg-white max-w-lg mx-auto">
        <div class="content w-[400px]">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Tambah pesanan</h3>
            <div class="modal-action">
                <form method="dialog">
                <div class="mb-2">
                    <div class="mb-3">
                        <x-input-label for="Nomor Orderan" :value="__('Jenis Pakaian')" />
                        <select name="item_id" id="item_id" class="item_id select rounded-md mt-1 block w-full border-slate-300">
                            <option value="" disabled selected>Pilih</option>
                            @foreach($itemType as $r)
                                <option value="{{$r['id']}}" data-name="{{ $r['name'] }}" data-price="{{ $r['price'] }}">{{$r['name']}}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('item_id')" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="qty" :value="__('Jumlah')" />
                        <input type="number" name="qty" id="qty" class="input w-full rounded-md px-4 py-2 focus:outline-none border-gray-300">
                    </div>
                    <div class="mb-3">
                        <x-input-label for="note" :value="__('Catatan')" />
                        <x-textarea name="note" />
                    </div>
                </div>

                <div class="action mt-4 text-end">
                    <button id="addDetail" class="btn bg-indigo-600 text-white hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 px-4 py-2 rounded-md font-semibold text-xs shadow-sm transition ease-in-out duration-150 uppercase tracking-widest" type="button" size="sm" onclick="addOrder()">Tambah</button>
                    <button id="close-modal" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</dialog>

{{-- JS Extend --}}
<script src="{{ asset('assets/transaction.js') }}"></script>
