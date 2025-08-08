<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="mt-2">
                    <div class="text-end mb-3">
                        <x-primary-button size="sm"><a href="/users/0">{{ __('Add') }} <i class="btn fa fa-add ml-1"></i></a></x-primary-button>
                        <x-primary-button size="sm"><a href="/users/0">{{ __('Print') }} <i class="fa fa-print ml-1"></i></a></x-primary-button>
                    </div>
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Created Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Updated Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider w-1">Action</th>
                                    {{-- Tambahkan kolom lain jika diperlukan, misalnya untuk Aksi --}}
                                </tr->
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach ($data as $dt)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $dt->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $dt->email }}</td> {{-- Pastikan ini mengambil kolom email dari $dt --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $dt->role->RoleName }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $dt->created_at }}</td> {{-- Jangan pernah tampilkan password asli! --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $dt->updated_at }}</td> {{-- Jangan pernah tampilkan password asli! --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                        <a href="/users/{{ $dt->id }}" class="mr-1" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="/usersDelete/{{ $dt->id }}" class="mr-1" title="Delete"><i class="fa fa-trash"></i></a>
                                        {{-- <form action="post" action="users">
                                            @csrf
                                            @method('delete')
                                            <x-text-input id="id" name="id" type="hidden" value="{{$dt->id}}" />
                                            <button class="w-auto" title="Delete"><i class="fa fa-trash"></i></button>
                                        </form> --}}
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
