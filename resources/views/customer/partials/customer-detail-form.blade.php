<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            @if ($data->id == 0)
                {{__('Tambah Pelanggan')}}
            @else
                {{__('Detail Pelanggan')}}
            @endif
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Tambah data pelanggan") }}
        </p>
    </header>
    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}
    <form method="post" action="{{ isset($data->id) ? route('customer.update') : route('customer.store') }}" class="mt-6 space-y-6" method="POST">
        @csrf
        @if(isset($data->id))
            @method('patch')
        @endif

        <div>
            <x-input-label for="name" :value="__('Nama Pelanggan')" />
            <x-text-input id="id" name="id" type="hidden" class="mt-1 block w-full" :value="old('id', $data->id)" />
            <x-text-input id="name" name="customer_name" type="text" class="mt-1 block w-full" :value="old('customer_name', $data->customer_name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('customer_name')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Nomor Telp')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $data->phone)" required />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Alamat')" />
            <x-textarea name="address" :value="old('address', $data->address)" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="gender" :value="__('Jenis Kelamin')" />
            <label class="inline-flex items-center mt-1 space-x-2">
                <div>
                    <input type="radio" name="gender" value="male" class="form-radio text-blue-600" @if(old('gender',$data->gender) == "male") {{ 'checked' }} @endif>
                    <span class="ml-1 text-gray-700">Laki-Laki</span>
                </div>
                <div>
                    <input type="radio" name="gender" value="female" class="form-radio text-blue-600" @if(old('gender',$data->gender) == "female") {{ 'checked' }} @endif>
                    <span class="ml-1 text-gray-700">Perempuan</span>
                </div>
            </label>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div class="flex items-center gap-4">
            @if($data->id == 0)
                <x-primary-button size="sm"><i class="btn fa fa-save mr-1"></i> {{ __('Simpan') }}</x-primary-button>
            @else
                <x-primary-button size="sm"><i class="btn fa fa-edit mr-1"></i> {{ __('Edit') }}</x-primary-button>
            @endif
            <x-anchor href="/customer" color="primary" size="sm"><i class="btn fa fa-arrow-left mr-1"></i> {{ __('Kembali') }}</x-anchor>
        </div>
    </form>
</section>
