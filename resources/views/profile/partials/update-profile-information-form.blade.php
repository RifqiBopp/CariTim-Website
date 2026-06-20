<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-300" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:ring-indigo-600" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:ring-indigo-600" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-400">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-400 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- NIM --}}
        <div>
            <x-input-label for="nim" :value="__('NIM')" class="text-gray-300" />
            <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:ring-indigo-600" :value="old('nim', $user->profile->nim ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('nim')" />
        </div>

        {{-- Skills --}}
        <div>
            <x-input-label for="skills" :value="__('Keahlian (Pisahkan dengan koma)')" class="text-gray-300" />
            <x-text-input id="skills" name="skills" type="text" class="mt-1 block w-full bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:ring-indigo-600" :value="old('skills', $user->profile->skills ?? '')" placeholder="Contoh: Laravel, Vue.js, UI/UX" />
            <x-input-error class="mt-2" :messages="$errors->get('skills')" />
        </div>

        {{-- Portfolio Link --}}
        <div>
            <x-input-label for="portfolio_link" :value="__('Link Portofolio')" class="text-gray-300" />
            <x-text-input id="portfolio_link" name="portfolio_link" type="url" class="mt-1 block w-full bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:ring-indigo-600" :value="old('portfolio_link', $user->profile->portfolio_link ?? '')" placeholder="https://..." />
            <x-input-error class="mt-2" :messages="$errors->get('portfolio_link')" />
        </div>

        {{-- Bio --}}
        <div>
            <x-input-label for="bio" :value="__('Bio Singkat')" class="text-gray-300" />
            <textarea id="bio" name="bio" rows="3" class="mt-1 block w-full bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Ceritakan sedikit tentang dirimu...">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
