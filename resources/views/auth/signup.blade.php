<x-layout>
    <form class="bg0 p-t-75 p-b-85" action={{ route('signup') }} method="Post">
        @csrf
        <div class="container">
            <div class="dis-flex flex-col flex-m bor12 p-t-15 p-b-30">
                <div class="size-210 p-r-18 p-r-0-sm w-full-ssm">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14 txt-center">
                        Signup
                    </h4>
                    <div class="p-t-15">
                        <div class="bg0 m-b-12">
                            <x-input type="text" name="email" placeholder="Email" value="{{ old('email') }}" />
                            @error('email')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div class="bg0 m-b-12">
                            <x-input type="text" name="username" placeholder="Username"
                                value="{{ old('username') }}" />
                            @error('username')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div class="bg0 m-b-12">
                            <x-input type="password" name="password" placeholder="Password" />
                            @error('password')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>

                        <div class="bg0 m-b-22">
                            <x-input type="password" name="password_confirmation" placeholder="Confrim Password" />
                        </div>
                    </div>
                    <x-button>Signup</x-button>
                    <x-error>
                        @if (session('status'))
                            {{ session('status') }}
                        @endif
                    </x-error>
                </div>
            </div>
        </div>
    </form>
</x-layout>
