<section>
    <form action="{{ route('transaction.update') }}" class="" id="mainForm" method="POST">
        @method('patch')
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
                                <x-text-input id="id" name="id" type="hidden" value="{{ $getTrx->id }}" class="mt-1 block w-full" />
                                <x-text-input id="status_transaction" type="hidden" value="{{ $getTrx->status->id }}" class="mt-1 block w-full" />
                                <x-text-input id="order_id" name="order_id" type="text" value="{{ $getTrx->order_id }}"
                                    class="mt-1 block w-full"
                                    required autofocus autocomplete="order_id" readonly/>
                                <x-input-error class="mt-2" :messages="$errors->get('order_id')" />
                            </div>

                            {{-- Tipe Transaksi --}}

                            {{-- Custmer Field --}}
                            <div class="mb-3">
                                <div class="max-w-xl mx-auto">
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Cari Pelanggan</label>
                                    <input type="hidden" name="customer_id" id="customer_id" value="{{ $getTrx->customer_id }}">
                                    <input type="text" id="phoneInput" autocomplete="off"
                                    class="w-full rounded-md px-4 py-2 focus:outline-none border-gray-300" @if($getTrx->status->id !== 5) readonly @endif
                                    placeholder="Cari pelanggan dengan nomor telp..." onkeyup="fetchCustomers(this.value)" value="{{ $getTrx->customer->phone }}">
                                    <ul id="dropdownResults" class="border border-gray-300 mt-1 rounded-lg shadow max-h-60 overflow-y-auto hidden bg-white z-10">
                                        <!-- Dynamic options appear here -->
                                    </ul>
                                </div>
                                <div class="max-w-xl mx-auto">
                                    <label id="customer_name" class="block text-sm font-semibold mb-2 pl-1">Nama Pelanggan : {{ $getTrx->customer->customer_name }}</label>
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
                                            {{(old('transaction_type_id') == $r->id || $getTrx->transaction_type_id == $r->id ) ? 'checked' : '' }}>
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
                                    <input type="date"
                                        name="transaction_date"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                        required
                                        autofocus
                                        autocomplete="transaction_date"
                                        value="{{ $getTrx->transaction_date }}"
                                        @if($getTrx->status_transaction != 5) readonly @endif >
                                    <x-input-error class="mt-2" :messages="$errors->get('transaction_date')" />
                                </div>
                                <div class="w-2/4 ml-1">
                                    <x-input-label for="completion_date" :value="__('Tanggal Selesai')" />
                                    <input type="date"
                                        name="completion_date"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                        required
                                        autofocus
                                        autocomplete="completion_date"
                                        value="{{ $getTrx->completion_date }}"
                                        @if($getTrx->status_transaction != 5) readonly @endif >
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
                                        <x-input-label for="paid_amount" :value="__('Uang Muka')" />
                                        <input
                                            id="paid_amount"
                                            name="paid_amount"
                                            type="text"
                                            class="mt-1 block w-full text-end border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                            onkeyup="calcBalanceDue(this.value,this.id)"
                                            autofocus autocomplete="off"
                                            value="{{ $getTrx->paid_amount }}"
                                            @if($getTrx->status_transaction != 5) readonly @endif >
                                        <x-input-error class="mt-2" :messages="$errors->get('paid_amount')" />
                                    </div>
                                    <div class="w-1/3">
                                        <x-input-label for="balance_due" :value="__('Sisa Pembayaran')" />
                                        <x-text-input id="balance_due" name="balance_due" type="text"
                                            class="mt-1 block w-full text-end" value="{{ $getTrx->balance_due }}"
                                            required autofocus autocomplete="off" readonly/>
                                        <x-input-error class="mt-2" :messages="$errors->get('balance_due')" />
                                    </div>
                                </div>
                            </div>

                            {{-- Status Transaction Field --}}
                            <div class="mb-3">
                                <div class="flex space-x-1">
                                    <div class="w-2/3">
                                         <x-input-label for="status_transaction" :value="__('Status Transaksi')" />
                                        <select name="status_transaction" class="select mt-1 block w-full rounded-md border-slate-300">
                                            @foreach($statusTransaction as $r)
                                                <option value="{{$r['id']}}" @if($r['id'] == $getTrx->status_transaction) selected @endif >{{$r['name']}}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('status_transaction')" />
                                    </div>
                                    <div class="w-1/3">
                                         <x-input-label for="status_transaction" :value="__('Status Pembayaran')" />
                                         <div class="mt-3 text-center">
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
                            <input type="hidden" id="list-order" name="list_order" value="{{ $detail_order }}">
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
                    <tr class="@if($getTrx->status->id !== 5) hidden @endif">
                        <th colspan="7" class="px-4 text-sm py-1 text-end border-b">
                            <button type="button" class="btn" onclick="my_modal_1.showModal()"><i class="fa fa-add"></i></button>
                        </th>
                    </tr>
                    <tr>
                        <th class="px-4 text-sm py-1 text-left border-b @if($getTrx->status->id !== 5) hidden @endif">Action</th>
                        <th class="px-4 text-sm py-1 text-left border-b">Item</th>
                        <th class="px-4 text-sm py-1 border-b text-center">Qty</th>
                        <th class="px-4 text-sm py-1 border-b text-center">Keterangan</th>
                        <th class="px-4 text-sm py-1 border-b text-center">Status</th>
                        <th class="px-4 text-sm py-1 text-center border-b">Price</th>
                        <th class="px-4 text-sm py-1 text-center border-b">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="px-4 text-sm py-1 border-b text-center">Belum ada pesanan!</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-slate-300">
                        <th class="px-4 text-sm py-1 border-b text-center" colspan="5">Total Harga</th>
                        <th class="px-4 text-sm py-1 text-end border-b" colspan="2"><span id="tb-total-harga">-</span></th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
        <div class="mt-6 flex justify-end gap-4">
            <button type="button" id="pickup_transaction" class="btn @if($getTrx->status->id != 3) hidden @endif bg-green-600 text-white hover:bg-green-700 focus:bg-green-700 active:bg-green-900 px-5 py-2 rounded shadow" data-id="{{ $getTrx->id }}">
                <i class="fa fa-check"></i> Pesanan diambil
            </button>
            <button type="submit" form="mainForm" class="btn bg-indigo-600 text-white hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 px-5 py-2 rounded shadow">
                <i class="fa fa-save"></i> Simpan
            </button>
            <a href="/transaction" class="btn bg-gray-300 text-gray-800 hover:bg-gray-400 px-5 py-2 rounded shadow">Batal</a>
        </div>

</section>

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


{{-- Popup for detail item --}}
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
<script>
    let arrOrderItem = [];
    let totHarga = 0;

    document.addEventListener('DOMContentLoaded', function () {
        amount = document.getElementById('amount');
        amount.value = formatRupiah(amount.value.toString());

        paid_amount = document.getElementById('paid_amount');
        paid_amount.value = formatRupiah(paid_amount.value.toString());

        balance_due = document.getElementById('balance_due');
        balance_due.value = formatRupiah(balance_due.value.toString());

        let getJSONItem = document.getElementById('list-order').value;
        if(getJSONItem !== ''){
            temp = JSON.parse(getJSONItem);
            let name = '';
            temp.forEach(item => {
                item_id = item.item_id;
                item_name = item.items.name;
                item_note = item.note;
                qty = item.qty;
                price = item.price;
                total = item.qty * item.price;
                status_id = item.status_order_item.id;
                status_name = item.status_order_item.name;
                arrOrderItem.push({
                item_id,
                item_name,
                qty,
                item_note,
                price,
                status_id,
                status_name,
                total
                });
            });
            updateTable();
        }

    });

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

    function addOrder(){
        let ItemType = document.getElementById('item_id');
        let ItemSelected = ItemType.options[ItemType.selectedIndex];
        let item_id = ItemType.value;
        let item_note = document.getElementById('note').value;

        // Validation
        if(item_id == '' || ItemSelected == ''){
            return
        }

        let item_name = ItemSelected.getAttribute('data-name');
        let qty = parseInt(document.getElementById('qty').value);
        let price = parseInt(ItemSelected.getAttribute('data-price'));
        let total = 0;
        const existingItem = arrOrderItem.find(item => item.item_id === item_id);
        const status_id = 1;
        const status_name = "Diterima";
        // if (existingItem) {
        //     existingItem.qty += qty;
        //     existingItem.total = existingItem.qty * existingItem.price;
        //     total = existingItem.total;
        // } else {
        //     // Add new item
            total = qty * price;
            arrOrderItem.push({
            item_id,
            item_name,
            qty,
            item_note,
            price,
            status_id,
            status_name,
            total
            });
        // }
        updateTable();
        closeModal();
    }

    function updateTable() {
        const tableBody = document.querySelector('#table-order-list tbody');
        const getStatusTransaction = document.querySelector('#status_transaction').value;
        // Clear existing rows
        tableBody.innerHTML = '';
        if (arrOrderItem.length > 0){
            let totalHarga = 0;
            // Loop through items and insert rows
            arrOrderItem.forEach(item => {
                const row = document.createElement('tr');
                totalHarga += item.price * item.qty;
                if(getStatusTransaction == 5){
                    row.innerHTML = `
                    <td class="px-4 text-sm py-1 border-b text-center w-1">
                        <a href="#" onclick="deleteItem(${item.item_id})" class="mr-1" title="Edit"><i class="fa fa-trash"></i></a>
                    </td>
                    <td class="px-4 text-sm py-1 border-b">${item.item_name}</td>
                    <td class="px-4 text-sm py-1 border-b text-center">${item.qty}</td>
                    <td class="px-4 text-sm py-1 border-b max-w-[200px] truncate text-ellipsis" title="${item.note}">${item.item_note}</td>
                    <td class="px-4 text-sm py-1 border-b text-center">${item.status_name}</td>
                    <td class="px-4 text-sm py-1 border-b">
                        <div class="float-end">${formatRupiah(item.price.toString()) }</div>
                    </td>
                    <td class="px-4 text-sm py-1 border-b">
                        <div class="float-end">Rp. ${formatRupiah((item.price * item.qty).toString()) }</div>
                    </td>
                        `;
                }else{
                    row.innerHTML = `
                    <td class="px-4 text-sm py-1 border-b">${item.item_name}</td>
                    <td class="px-4 text-sm py-1 border-b text-center">${item.qty}</td>
                    <td class="px-4 text-sm py-1 border-b max-w-[200px] truncate text-ellipsis" title="${item.note}">${item.item_note}</td>
                    <td class="px-4 text-sm py-1 border-b text-center">${item.status_name}</td>
                    <td class="px-4 text-sm py-1 border-b">
                        <div class="float-end">${formatRupiah(item.price.toString()) }</div>
                    </td>
                    <td class="px-4 text-sm py-1 border-b">
                        <div class="float-end">Rp. ${formatRupiah((item.price * item.qty).toString()) }</div>
                    </td>
                        `;
                }

                    tableBody.appendChild(row);
                });
                document.getElementById('tb-total-harga').textContent = formatRupiah(totalHarga.toString());
                document.getElementById('amount').value = formatRupiah(totalHarga.toString());
                // document.getElementById('balance_due').value = formatRupiah((totalHarga).toString());
                // calcBalanceDue(document.getElementById('balance_due').value,'paid_amount');
        }else{
            const row = document.createElement('tr');
                row.innerHTML = `
                    <td colspan="5" class="px-4 text-sm py-1 border-b text-center">Belum ada pesanan!</td>
                `;
                tableBody.appendChild(row);
                document.getElementById('tb-total-harga').textContent = '-';
                document.getElementById('amount').value = formatRupiah("0");
                document.getElementById('balance_due').value = formatRupiah("0");
        }
        document.getElementById('list-order').value = JSON.stringify(arrOrderItem);
    }

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

    function deleteItem(item_id){
        const getItems = arrOrderItem.findIndex(item => item.item_id == item_id);
        if (getItems !== -1) {
            arrOrderItem.splice(getItems, 1); // removes the item in-place
        }
        updateTable();
    }

    function closeModal(){
        document.getElementById('qty').value = '';
        document.getElementById('note').value = '';
        document.getElementById('item_id').selectedIndex = -1;
        document.getElementById('close-modal').click();
    }

    function fetchCustomers(query) {
        if (document.getElementById('phoneInput').value == ""){
            document.getElementById('customer_id').value = "";
            document.getElementById('customer_name').textContent = "";
        }else{
            if (query.length < 3) {
                document.getElementById('dropdownResults').style.display = 'none';
                return;
            }
            fetch(`/search-customer?phone=${query}`)
                .then(response => response.json())
                .then(data => {
                    const dropdown = document.getElementById('dropdownResults');
                    dropdown.innerHTML = '';
                    dropdown.style.display = data.length > 0 ? 'block' : 'none';

                    data.forEach(customer => {
                        const item = document.createElement('li');
                        item.textContent = `${customer.customer_name} (${customer.phone})`;
                        item.className = "px-4 py-2 hover:bg-blue-100 cursor-pointer";
                        item.onclick = () => selectCustomer(customer);
                        dropdown.appendChild(item);
                    });
                });
        }
    }

    function selectCustomer(customer) {
        document.getElementById('phoneInput').value = customer.phone;
        document.getElementById('customer_id').value = customer.id;
        document.getElementById('customer_name').textContent = 'Nama Pelanggan : ' + customer.customer_name;
        document.getElementById('dropdownResults').style.display = 'none';
        // You can also auto-fill other fields or trigger other actions here
    }

    function calcBalanceDue(nominal,id){
        // Field Paid
        let input = document.getElementById(id);

        // Field Balance
        let balance_due = document.getElementById('balance_due');
        let amount = parseInt(document.getElementById('amount').value.replace(/\D/g, ''),10);
        let paid = parseInt(input.value.replace(/\D/g, ''),10);
        let balance = amount - paid;
        if(Number.isNaN(paid)){
            balance_due.value = formatRupiah(amount.toString());
        }else if(paid <= amount){
            balance_due.value = formatRupiah(balance.toString());
        }else{
            balance_due.value = '';
        }
        input.value = formatRupiah(nominal);
    }

    function openMiniPopup(URL) {
        const width = 600;
        const height = 400;

        // Calculate center position
        const left = (window.screen.width - width) / 2;
        const top = (window.screen.height - height) / 2;

        window.open(
            `${URL}`,
            'miniWindow',
            `width=${width},height=${height},left=${left},top=${top},resizable=yes`
        );
    }

    document.getElementById('pickup_transaction').addEventListener('click', function () {
        const transactionId = this.getAttribute('data-id');
        const pickupUrl = "{{ route('pickUpTransaction') }}";
        fetch(pickupUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        body: JSON.stringify({ transaction_id: transactionId })
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);

            // ✅ Redirect manually
            window.location.href = data.redirect_url;

        })
        .catch(err => console.error(err));

    });

</script>
