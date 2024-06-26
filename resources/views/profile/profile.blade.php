<x-layout>
    <div class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="dis-flex flex-col flex-m bor12 p-t-15 p-b-30">
                <div class="size-210 p-r-18 p-r-0-sm w-full-ssm">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14 txt-center">
                        Profile
                    </h4>
                    @if ($isPublic)
                    <p><strong>Username:</strong> {{ $username }}</p>
                    @else
                    <p><strong>Private Account</strong></p>
                    @endif

                    @if (Auth::check() && Auth::user()->id === $userId)
                    @if (Auth::check() && Auth::user()->id === $userId && !$isPublic)
                    <p><strong>Username:</strong> {{ $username }}</p>
                    @endif

                    <p><strong>Email:</strong> {{ $email }}</p>
                    <div class="p-t-15">
                        <form action="{{ route('updateProfile') }}" method="POST" class="m-b-22">
                            @csrf
                            @method('PUT')

                            <div class="bg0 m-b-22">
                                <label for="email" class="label">Email:</label>
                                <x-input type="email" name="email" id="email" placeholder="Enter your new email" value="{{ old('email', $user->email) }}" />
                                @error('email')
                                <x-error>{{ $message }}</x-error>
                                @enderror
                            </div>

                            <div class="m-b-22">
                                <label for="username" class="label">Username:</label>
                                <x-input type="text" name="username" id="username" placeholder="Enter your new username" value="{{ old('username', $user->username) }}" />
                                @error('username')
                                <x-error>{{ $message }}</x-error>
                                @enderror
                            </div>

                            <div class="m-b-22">
                                <label for="password" class="label">Password:</label>
                                <x-input type="password" name="password" id="password" placeholder="Enter your new password" />
                                @error('password')
                                <x-error>{{ $message }}</x-error>
                                @enderror

                                <div class="bg0 m-b-22">
                                    <label for="country" class="label">Country:</label>
                                    <x-input type="text" name="country" id="country" placeholder="Enter your country" value="{{ old('country', $user->country) }}" />
                                    @error('country')
                                    <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>

                                <div class="bg0 m-b-22">
                                    <label for="city" class="label">City:</label>
                                    <x-input type="text" name="city" id="city" placeholder="Enter your city" value="{{ old('city', $user->city) }}" />
                                    @error('city')
                                    <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>

                                <div class="bg0 m-b-22">
                                    <label for="street" class="label">Street:</label>
                                    <x-input type="text" name="street" id="street" placeholder="Enter your street" value="{{ old('street', $user->street) }}" />
                                    @error('street')
                                    <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>

                                <x-button type="submit">Update Profile</x-button>
                        </form>

                        <hr>
                        <form action="{{ route('toggleAccountPrivacy') }}" method="POST" class="m-b-22">
                            @csrf
                            <x-button>
                                @if ($isPublic)
                                Make Account Private
                                @else
                                Make Account Public
                                @endif
                            </x-button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>