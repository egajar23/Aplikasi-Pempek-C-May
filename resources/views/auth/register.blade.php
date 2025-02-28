<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- no_hp -->
        <div class="mt-4">
            <x-input-label for="no_hp" :value="__('Nomor HP')" />
            <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" :value="old('no_hp')" required autofocus autocomplete="no_hp" />
            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
        </div>

        <!-- provinsi -->
        <div class="mt-4">
            <x-input-label for="provinsi" :value="__('Provinsi')" />
            <x-text-input id="provinsi" class="block mt-1 w-full" type="text" name="province" :value="old('province')" required autofocus autocomplete="province" ></x-text-input>
            <x-input-error :messages="$errors->get('province')" class="mt-2" />
        </div>

        <!-- kota -->
        <div class="mt-4">
            <x-input-label for="kota" :value="__('Kota')" />
            <x-text-input id="kota" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autofocus autocomplete="city" ></x-text-input>
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <!-- alamat -->
        <div class="mt-4">
            <x-input-label for="alamat" :value="__('Alamat')" />
            <textarea id="alamat" class="block mt-1 w-full border-gray-300 focus:border-hijau-toska focus:ring-hijau-toska rounded-md shadow-sm" type="text" name="address" :value="old('address')" required ></textarea>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- no_hp -->
        <div class="mt-4">
            <x-input-label for="postal_code" :value="__('Kode Pos')" />
            <x-text-input id="postal_code" class="block mt-1 w-full" type="number" name="postal_code" :value="old('postal_code')" required autofocus autocomplete="postal_code" />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <!-- no_hp -->
        <div class="mt-4">
            <x-input-label for="profile_picture" :value="__('Foto')" />
            <x-text-input id="profile_picture" class="block mt-1 w-full" type="file" name="profile_picture" :value="old('profile_picture')" required autofocus autocomplete="profile_picture" />
            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Sudah Punya Akun?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('DAFTAR') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
