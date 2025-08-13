<div class="header w-full bg-blue-600 text-white hover:bg-blue-700 p-2 flex">
            <div class="w-1/2">
                <span class="text-xs">Status : {{ $getTrx->status->name }}</span>
            </div>
            <div class="w-1/2">
                <button type="button" onclick="openMiniPopup('/downloadInvoice/{{ $getTrx->id }}')" class="float-end" title="Cetak nota"><i class="fa fa-print"></i></button>
                <a href="https://wa.me/6281234567890" target="_blank"    class="float-end mr-2" title="Whatsapp"><i class="fa fa-commenting"></i></a>
                <button type="button" class="btn float-end mr-2" onclick="setTableAuditTrail({{$AuditTrails}})"><i class="fa fa-history"></i></button>
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
                                <x-text-input id="order_id" name="order_id" type="text" value="{{ $getTrx->order_id }}"
                                    class="mt-1 block w-full"
                                    required autofocus autocomplete="order_id" readonly/>
                                <x-input-error class="mt-2" :messages="$errors->get('order_id')" />
                            </div>

                            {{-- Tipe Transaksi --}}

                            {{-- Custmer Field --}}
                            <div class="mb-3">
                                <div class="max-w-xl mx-auto">
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nama Pelanggan</label>
                                    <x-text-input id="order_id" name="order_id" type="text" value="{{ $getTrx->customer->customer_name }}"
                                    class="mt-1 block w-full"
                                    required autofocus autocomplete="order_id" readonly/>
                                </div>
                            </div>

                            <div class="mb-3">
                                <span class="text-sm font-medium text-gray-700">Tipe Transaksi</span>
                                <x-text-input id="order_id" name="order_id" type="text" value="{{ $getTrx->transaction_type->name }}"
                                    class="mt-1 block w-full"
                                    required autofocus autocomplete="order_id" readonly/>
                            </div>

                            {{-- Date Field --}}
                            <div class="mb-3 flex">
                                <div class="w-2/4 mr-1">
                                    <x-input-label for="transaction_date" :value="__('Tanggal Masuk')" />
                                    <input type="date"
                                        name="transaction_date"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                        required
                                        autofocus
                                        autocomplete="transaction_date"
                                        value="{{ $getTrx->transaction_date }}"
                                        readonly>
                                </div>
                                <div class="w-2/4 ml-1">
                                    <x-input-label for="completion_date" :value="__('Tanggal Selesai')" />
                                    <input type="date"
                                        name="completion_date"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                        required
                                        autofocus
                                        autocomplete="completion_date"
                                        value="{{ $getTrx->completion_date }}"readonly>
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
                                        <input type="text"
                                        name="transaction_date"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                        required
                                        autofocus
                                        autocomplete="transaction_date"
                                        value="{{ formatRupiah($getTrx->amount) }}"
                                        readonly>
                                    </div>
                                    <div class="w-1/3">
                                        <x-input-label for="paid_amount" :value="__('Uang Muka')" />
                                        <input type="text"
                                        name="transaction_date"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                        required
                                        autofocus
                                        autocomplete="transaction_date"
                                        value="{{ formatRupiah($getTrx->paid_amount) }}"
                                        readonly>
                                    </div>
                                    <div class="w-1/3">
                                        <x-input-label for="balance_due" :value="__('Sisa Pembayaran')" />
                                        <input type="text"
                                        name="transaction_date"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                        required
                                        autofocus
                                        autocomplete="transaction_date"
                                        value="{{ formatRupiah($getTrx->balance_due) }}"
                                        readonly>
                                    </div>
                                </div>
                            </div>

                            {{-- Status Transaction Field --}}
                            <div class="mb-5">
                                <div class="flex space-x-1">
                                    <div class="w-1/3">
                                         <x-input-label for="status_transaction" :value="__('Status Transaksi')" />
                                         <div class="mt-3 text-start">
                                            <x-status-badge id="{{ $getTrx->status_transaction }}" status="{{ $getTrx->status->name }}" />
                                         </div>
                                    </div>
                                    <div class="w-1/3">
                                         <x-input-label for="status_transaction" :value="__('Status Pembayaran')" />
                                         <div class="mt-3 text-start">
                                            <x-status-badge id="{{ $getTrx->status_payment->id }}" status="{{ $getTrx->status_payment->name }}" />
                                         </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Notes Field --}}
                            <div class="mb-3">
                                <x-input-label for="notes" :value="__('Catatan Transaksi')" />
                                <textarea name="notes"
                                    class="textarea w-full border-gray-300 rounded-md"
                                    rows="4"
                                    @if($getTrx->status_transaction != 5) readonly @endif >{{ $getTrx->notes }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div id="tableContainer" class="overflow-x-auto shadow-md sm:rounded-lg">
    <table class="table min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Item</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider text-center">Qty</th>
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
            @foreach ($orderDetail as $dt)
                <tr>
                    <td class="whitespace-nowrap font-medium text-gray-600 dark:text-gray-100 px-4 text-sm py-1 border-b w-1">
                        <p>{{ $dt->items->name }}</p>
                    </td>
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
        </tbody>
    </table>
</div>
<div class="pagination mt-3">
    {{ $orderDetail->links() }}
</div>

{{-- Popup audittrail --}}
<dialog id="my_modal_2" class="modal">
  <div class="modal-box p-6 rounded-lg shadow-lg bg-white w-[800px] max-h-[100vh] overflow-y-auto">
    <div class="content">
      <h3 class="text-xl font-semibold text-gray-800 mb-4">Audit Trail</h3>

      <div class="modal-action max-h-[40vh] overflow-y-auto">
        <table id="table-audittrail" class="table-auto w-full border border-gray-300">
          <thead class="bg-gray-100 sticky top-0">
            <tr>
              <th class="px-4 text-sm py-1 text-left border-b">Waktu</th>
              <th class="px-4 text-sm py-1 border-b text-center">Data</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="2" class="px-4 text-sm py-1 border-b text-center">Belum ada riwayat!</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Close Button -->
      <div class="text-end mt-4">
        <button type="button" onclick="document.getElementById('my_modal_2').close()"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm font-semibold rounded-md">
          Tutup
        </button>
      </div>
    </div>
  </div>
</dialog>


{{-- Modal Update Status --}}
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

                    <div class="mb-2">
                        <x-input-label for="Status" :value="__('Catatan')" />
                        <x-textarea name="note" />
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

    function setTableAuditTrail(data){
        const tableBody = document.querySelector('#table-audittrail tbody');
        tableBody.innerHTML = '';
        if(data.length > 0){
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td class="px-4 text-sm py-1 border-b">
                        <p>${formatDateTime(item.created_at)}</p>
                        <p>${item.creator.name}</p>
                    </td>
                    <td class="px-4 text-sm py-1 border-b">${item.detail}</td>`;
                    tableBody.appendChild(row);
                });

            }else{
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td class="px-4 text-sm py-1 border-b" colspan="2">Belum ada riwayat!</td>`;
                    tableBody.appendChild(row);
                }
        my_modal_2.showModal();
    }

    function formatDateTime(inputDate) {
        const date = new Date(inputDate);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');

        return `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
    }
</script>

