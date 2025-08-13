<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Pelanggan') }}
        </h2>
    </x-slot>
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="mt-2">
                    <div class="text-end mb-3">
                        <x-primary-button size="sm"><a href="/customer/0">{{ __('Tambah') }} <i class="btn fa fa-add ml-1"></i></a></x-primary-button>
                        {{-- <x-primary-button size="sm"><a href="/users/0">{{ __('Print') }} <i class="fa fa-print ml-1"></i></a></x-primary-button> --}}
                    </div>
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Nama Pelanggan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Nomor Telp</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Jenis Kelamin</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Alamat</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-center text-gray-500 dark:text-gray-200 uppercase tracking-wider w-1">Action</th>
                                    {{-- Tambahkan kolom lain jika diperlukan, misalnya untuk Aksi --}}
                                </tr->
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach ($customer as $dt)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $dt->customer_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $dt->phone }}</td> {{-- Pastikan ini mengambil kolom email dari $dt --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $dt->gender }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $dt->address }}</td> {{-- Jangan pernah tampilkan password asli! --}}
                                   <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                        <div class="flex text-center">
                                            <a href="/customer/{{ $dt->id }}" class="mr-1" title="Edit"><i class="fa fa-edit"></i></a>
                                            <form method="POST" action="{{ route('customer.delete',$dt->id) }}">
                                                @method('delete')
                                                @csrf
                                                <button class="mr-1 @if($dt->transaction_count > 0) hidden @endif" title="Delete"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination mt-3">
                        {{$customer->links() }}
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
