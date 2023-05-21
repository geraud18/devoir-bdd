<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div class="mb-3 col-md-12">
            <label for="current_password" class="form-label">{{__('Current Password')}}</label>
            <input class="form-control" id="current_password" name="current_password" type="password" autocomplete="current-password" />
            @if (!empty($errors->updatePassword->get('current_password')))
                <div class="alert alert-danger mt-2">
                @foreach ($errors->updatePassword->get('current_password') as $error)
                    <span class="error">{{ $error }}</span>
                @endforeach
                </div>
            @endif
        </div>

        <div class="mb-3 col-md-12">
            <label for="password" class="form-label">{{__('New Password')}}</label>
            <input class="form-control" id="password" name="password" type="password" autocomplete="new-password" />
            @if (!empty($errors->updatePassword->get('password')))
                <div class="alert alert-danger mt-2">
                    @foreach ($errors->updatePassword->get('password') as $error)
                        <span class="error">{{ $error }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mb-3 col-md-12">
            <label for="password_confirmation" class="form-label">{{__('Confirm Password')}}</label>
            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
            @if (!empty($errors->updatePassword->get('password_confirmation')))
                <div class="alert alert-danger mt-2">
                    @foreach ($errors->updatePassword->get('password_confirmation') as $error)
                        <span class="error">{{ $error }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 mt-4">
            <button type="submit" class="btn btn-primary me-2">{{ __('Enregistrer') }}</button>
            @if (session('status') === 'password-updated')
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
