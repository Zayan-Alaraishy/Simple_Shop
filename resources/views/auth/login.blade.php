<x-layout>
    <form class="bg0 p-t-75 p-b-85"  method="POST" action={{ route('login') }}>
        @csrf
		<div class="container">
				<div class="dis-flex flex-col flex-m bor12 p-t-15 p-b-30">
							<div class="size-210 p-r-18 p-r-0-sm w-full-ssm">
                                <h4 class="mtext-105 cl2 js-name-detail p-b-14 txt-center">
                                    Login
                                </h4>
                                <!-- old read from the old session data -->
                                @if (session('status'))
                                    {{ session('status') }}
                                @endif
								<div class="p-t-15">
									<div class="bor8 bg0 m-b-12">
										<x-input type="text" id="login" name="login" placeholder="Username or Email" />
                                        @error('login')
                                            <div>{{ $message }}</div>
                                        @enderror
									</div>

									<div class="bor8 bg0 m-b-22">
                                        <x-input type="password" id="password" name="password" placeholder="Password" />
                                        @error('login')
                                            <div>{{ $message }}</div>
                                        @enderror
									</div>
								</div>
                                <x-button>Login</x-button>
							</div>
						</div>
				</div>
	</form>


    {{-- <form method="POST" action={{ route('login') }}>
        @csrf
        <!-- old read from the old session data -->
        @if (session('status'))
            {{ session('status') }}
        @endif
        <label for="login">Email or Username</label>
        <input type="text" id="login" name="login">
        @error('login')
        <div>{{ $message }}</div>
    @enderror
        <input type="password" id="password" name="password">
        @error('login')
        <div>{{ $password }}</div>
    @enderror
        <button type="submit"> submit </button>

        <!-- Other form fields and submit button -->
    </form> --}}

</x-layout>


