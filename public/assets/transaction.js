let arrOrderItem = [];
let totHarga = 0;

document.addEventListener('DOMContentLoaded', function () {
    amount = document.getElementById('amount');
    amount.value = formatRupiah(amount.value);
    balance_due = document.getElementById('balance_due');
    balance_due.value = formatRupiah(balance_due.value);

    // Set Date Today
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months start at 0
    const dd = String(today.getDate()).padStart(2, '0');

    const formattedDate = `${yyyy}-${mm}-${dd}`;
    document.getElementById('transaction_date').value = formattedDate;

    let getJSONItem = document.getElementById('list-order').value;
    if (getJSONItem !== '') {
        arrOrderItem = JSON.parse(getJSONItem);
        updateTable();
    }

});
function addOrder() {
    let ItemType = document.getElementById('item_id');
    let ItemSelected = ItemType.options[ItemType.selectedIndex];
    let item_id = ItemType.value;
    let item_note = document.getElementById('note').value;

    // Validation
    if (item_id == '' || ItemSelected == '') {
        return
    }

    let item_name = ItemSelected.getAttribute('data-name');
    let qty = parseInt(document.getElementById('qty').value);
    let price = parseInt(ItemSelected.getAttribute('data-price'));
    let total = 0;
    const existingItem = arrOrderItem.find(item => item.item_id === item_id);
    if (existingItem) {
        existingItem.qty += qty;
        existingItem.total = existingItem.qty * existingItem.price;
        total = existingItem.total;
    } else {
        // Add new item
        total = qty * price;
        arrOrderItem.push({
            item_id,
            item_name,
            qty,
            item_note,
            price,
            total
        });
    }
    // totHarga+= total;
    // document.getElementById('tb-total-harga').textContent = formatRupiah(totHarga.toString());
    updateTable();
    closeModal();
}

function updateTable() {
    const tableBody = document.querySelector('#table-order-list tbody');

    // Clear existing rows
    tableBody.innerHTML = '';
    if (arrOrderItem.length > 0) {
        let totalHarga = 0;
        // Loop through items and insert rows
        arrOrderItem.forEach(item => {
            const row = document.createElement('tr');
            totalHarga += item.price * item.qty;
            row.innerHTML = `
                <td class="px-4 text-sm py-1 border-b text-center w-1">
                    <a href="#" onclick="deleteItem(${item.item_id})" class="mr-1" title="Edit"><i class="fa fa-trash"></i></a>
                </td>
                <td class="px-4 text-sm py-1 border-b">${item.item_name}</td>
                <td class="px-4 text-sm py-1 border-b text-center">${item.qty}</td>
                <td class="px-4 text-sm py-1 border-b max-w-[200px] truncate text-ellipsis" title="${item.item_note}">${item.item_note}</td>
                <td class="px-4 text-sm py-1 border-b">
                    <div class="float-end">${formatRupiah(item.price.toString())}</div>
                </td>
                <td class="px-4 text-sm py-1 border-b">
                    <div class="float-end">Rp. ${formatRupiah((item.price * item.qty).toString())}</div>
                </td>
                    `;

            tableBody.appendChild(row);
        });
        document.getElementById('tb-total-harga').textContent = formatRupiah(totalHarga.toString());
        document.getElementById('amount').value = formatRupiah(totalHarga.toString());
        document.getElementById('balance_due').value = formatRupiah(totalHarga.toString());
        document.getElementById('paid_amount').value = '';
    } else {
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

function deleteItem(item_id) {
    const getItems = arrOrderItem.findIndex(item => item.item_id == item_id);
    if (getItems !== -1) {
        arrOrderItem.splice(getItems, 1); // removes the item in-place
    }
    updateTable();
}

function closeModal() {
    document.getElementById('qty').value = '';
    document.getElementById('note').value = '';
    document.getElementById('item_id').selectedIndex = -1;
    document.getElementById('close-modal').click();
}

function fetchCustomers(query) {
    if (document.getElementById('phoneInput').value == "") {
        document.getElementById('customer_id').value = "";
        document.getElementById('customer_name').textContent = "";
    } else {
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

function calcBalanceDue(nominal, id) {
    // Field Paid
    let input = document.getElementById(id);

    // Field Balance
    let balance_due = document.getElementById('balance_due');
    let amount = parseInt(document.getElementById('amount').value.replace(/\D/g, ''), 10);
    let paid = parseInt(input.value.replace(/\D/g, ''), 10);
    let balance = amount - paid;
    if (Number.isNaN(paid)) {
        balance_due.value = formatRupiah(amount.toString());
    } else if (paid <= amount) {
        balance_due.value = formatRupiah(balance.toString());
    } else {
        balance_due.value = '';
    }
    input.value = formatRupiah(nominal);
}
