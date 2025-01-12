<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile picture.") }}
        </p>
        @if ($user->profilePicture && $user->profilePicture->file_data)
            <img
                src="data:{{ $user->profilePicture->file_type }};base64,{{ base64_encode($user->profilePicture->file_data) }}"
                alt="Profile Picture"
                class="w-32 h-32 rounded-full"
                style="height: 88px; width: 88px;"
            />
        @endif
    </header>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
            <input
                id="profile_picture"
                name="profile_picture"
                type="file"
                class="mt-1 block w-full"
            />
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

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
