<x-app-layout>
    <div class="container mx-auto px-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Customers -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Pelanggan</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $Customer['count'] }}</h3>
                    </div>
                    <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-500">
                    <span>+12.5% from last month</span>
                    <i class="fas fa-arrow-up ml-1"></i>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Pesanan</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $Transaction['count'] }}</h3>
                    </div>
                    <div class="p-3 rounded-full bg-purple-50 text-purple-600">
                        <i class="fas fa-shopping-bag text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-500">
                    <span>+8.2% from last month</span>
                    <i class="fas fa-arrow-up ml-1"></i>
                </div>
            </div>

            <!-- Revenue -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pendapatan bulan ini</p>
                        <h3 class="text-2xl font-bold text-gray-800">Rp. {{ number_format($Revenue['total'], 0, ',', '.') }}</h3>
                    </div>
                    <div class="p-3 rounded-full bg-green-50 text-green-600">
                        <i class="fas fa-dollar-sign text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-red-500">
                    <span>-2.4% from last month</span>
                    <i class="fas fa-arrow-down ml-1"></i>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pesanan yang sudah/akan jatuh tempo</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ count($Transaction['pendingOrder']) }}</h3>
                    </div>
                    <div class="p-3 rounded-full bg-orange-50 text-orange-600">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-500">
                    <span>-5.3% from last month</span>
                    <i class="fas fa-arrow-down ml-1"></i>
                </div>
            </div>
        </div>

        <!-- Recent Orders & Top Customers -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Recent Orders -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Pesanan Terbaru</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Transaksi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Masuk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($Transaction['data'] as $item)
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <a href="/transaction/detail/{{ $item->id }}">
                                            <p>#{{ $item->order_id }}</p>
                                            <span>{{$item->customer->customer_name}}</span>
                                        </a>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ date('d-F-y', strtotime($item->transaction_date)) }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-end text-gray-500">Rp. {{ number_format($item->amount, 0, ',', '.') }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm">
                                        <x-status-badge id="{{ $item->status->id }}" status="{{ $item->status->name }}" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t">
                    <a href="{{ route('transaction.view') }}" class="text-primary hover:text-primary-dark text-sm font-medium flex items-center justify-center">
                        View all orders <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- Top Customers -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 top-customers-title">Top Pelanggan</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Pesanan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Transaksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($Customer['data'] as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://placehold.co/100x100?text={{ getInitials($item->customer_name) }}" alt="Portrait of customer Anna Smith with short brown hair and smiling">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->customer_name }}</div>
                                                <div class="text-sm text-gray-500">{{ $item->phone }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">{{ $item->transaction_count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-500">Rp. {{ number_format($item->transaction_sum_amount, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t">
                    <a href="#" class="text-primary hover:text-primary-dark text-sm font-medium flex items-center justify-center">
                        View all customers <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

                <!-- Recent Orders & Top Customers -->
        <div class="grid gap-6">
            <!-- Recent Orders -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Pesanan Prioritas</h2>
                </div>
                <div class="overflow-x-auto h-80">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Transaksi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($Transaction['pendingOrder'] as $item)
                                <tr class="@if(isDuedate($item->completion_date)) bg-red-50 @endif">
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <a href="/transaction/detail/{{ $item->id }}">
                                            <p>#{{ $item->order_id }}</p>
                                            <span>{{$item->customer->customer_name}}</span>
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ date('d-F-y', strtotime($item->completion_date)) }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-end text-gray-500">Rp. {{ number_format($item->amount, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $item->notes }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm">
                                        <x-status-badge id="{{ $item->status->id }}" status="{{ $item->status->name }}" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t">
                    <a href="{{ route('transaction.view') }}" class="text-primary hover:text-primary-dark text-sm font-medium flex items-center justify-center">
                        View all orders <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

         <!-- Fabric Inventory Section -->
        <div class="mt-8 bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Fabric Inventory</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fabric Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Color</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity (yds)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Cotton Twill</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Blue</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">25.5</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">In Stock</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Linen Blend</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Gray</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">18.3</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Low Stock</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Silk Satin</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-800">Red</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5.2</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Critical</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Polyester Blend</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800">Green</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">32.0</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">In Stock</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Wool Blend</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs rounded-full bg-black text-white">Black</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15.7</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">In Stock</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t">
                <a href="#" class="text-primary hover:text-primary-dark text-sm font-medium flex items-center justify-center">
                    View all inventory <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
