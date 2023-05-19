<x-layout>
    <form class="bg0 p-t-75 p-b-85"  method="POST" action="{{ route('password.update') }}" >
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="container">
            <div class="dis-flex flex-col flex-m bor12 p-t-15 p-b-30">
                <div class="size-210 p-r-18 p-r-0-sm w-full-ssm">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14 txt-center">
                        Reset Password
                    </h4>
                    <div class="p-t-15">
                        <div class="bg0 m-b-12">
                            <x-input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" />
                            @error('email')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div class="bg0 m-b-12">
                            <x-input type="password" id="password" name="password" placeholder="Enter your new password" />
                            @error('password')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div class="bg0 m-b-12">
                            <x-input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" />
                            @error('password_confirmation')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                    </div>
                    <x-button>Reset Password</x-button>
                </div>
            </div>
        </div>
    </form>    
</x-layout>