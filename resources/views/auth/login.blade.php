<x-layout>
    <form class="bg0 p-t-75 p-b-85" method="POST" action={{ route('login') }}>
        @csrf
        <div class="container">
            <div class="dis-flex flex-col flex-m bor12 p-t-15 p-b-30">
                <div class="size-210 p-r-18 p-r-0-sm w-full-ssm">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14 txt-center">
                        Login
                    </h4>
                    <div class="p-t-15">
                        <div class="bor8 bg0 m-b-12">
                            <x-input type="text" id="login" name="login" placeholder="Username or Email" />
                            @error('login')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>

                        <div class="bor8 bg0 m-b-22">
                            <x-input type="password" id="password" name="password" placeholder="Password" />
                            @error('login')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                    </div>
                    <x-button>Login</x-button>
                    <div class="flex-w flex-c-m p-t-18 p-b-15">
                        <div>
                            <a href="{{ route('forgot-password') }}" class="txt1">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </form>
</x-layout>