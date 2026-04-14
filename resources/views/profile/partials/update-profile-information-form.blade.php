<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Profile Image Upload -->
        <div>
            <x-input-label for="profile_image" :value="__('Profile Image')" />

            <div class="mt-4 flex items-center gap-6">
                <!-- Current Image Preview -->
                <div class="flex-shrink-0">
                    <div class="w-24 h-24 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center font-semibold text-2xl overflow-hidden">
                        @if($user->profile_image)
                            <img src="{{ $user->getProfileImageUrl() }}"
                                 alt="{{ $user->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            {{ $user->getInitials() }}
                        @endif
                    </div>
                </div>

                <!-- Upload Input -->
                <div class="flex-1">
                    <input id="profile_image"
                           name="profile_image"
                           type="file"
                           class="block w-full text-sm text-gray-500
                                  file:me-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-amber-600 file:text-white
                                  hover:file:bg-amber-700
                                  file:cursor-pointer"
                           accept="image/*"
                           onchange="previewImage(event)" />
                    <p class="mt-2 text-sm text-gray-500">
                        {{ __('JPG, PNG, GIF. Max size 2MB.') }}
                    </p>
                    <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
                </div>
            </div>

            <!-- Image Preview on Change -->
            <div id="preview-container" class="mt-4" style="display: none;">
                <p class="text-sm text-gray-600 mb-2">{{ __('Preview') }}:</p>
                <img id="preview-image" src="" alt="Preview" class="max-w-xs rounded-lg shadow">
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    }
</script>
