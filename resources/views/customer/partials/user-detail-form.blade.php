<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            @if ($data->id == 0)
                {{__('Add User')}}
            @else
                {{__('User Detail')}}
            @endif
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>
    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}
    <form method="post" action="{{ isset($data->id) ? route('users.update') : route('users.store') }}" class="mt-6 space-y-6" method="POST">
        @csrf
        @if(isset($data->id))
            @method('patch')
        @endif

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="id" name="id" type="hidden" class="mt-1 block w-full" :value="old('id', $data->id)" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $data->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $data->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="role" :value="__('Role')" />
            <select name="roleId" class="select mt-1 block w-full border-slate-300">
                <option disabled {{ $data['id'] == 0 ? 'selected':'' }} value="">Role</option>
                @foreach($role as $r)
                    <option value="{{$r['id']}}" {{ $r['id'] == $data['RoleId'] ? 'selected' : '' }} >{{$r['RoleName']}}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('roleId')" />
        </div>

        <div class="flex items-center gap-4">
            @if($data->id == 0)
                <x-primary-button size="sm"><i class="btn fa fa-save mr-1"></i> {{ __('Simpan') }}</x-primary-button>
            @else
                <x-primary-button size="sm"><i class="btn fa fa-edit mr-1"></i> {{ __('Edit') }}</x-primary-button>
            @endif    
            <x-anchor href="/users" color="primary" size="sm"><i class="btn fa fa-save mr-1"></i> {{ __('Kembali') }}</x-anchor>
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
