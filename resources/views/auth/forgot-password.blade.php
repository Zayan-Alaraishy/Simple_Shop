<!-- form to forgot password -->
 <x-layout> 
    <form class="bg0 p-t-75 p-b-85" method="POST" action={{ route('password.email') }}>
        @csrf
		<div class="container">
			<div class="dis-flex flex-col flex-m bor12 p-t-15 p-b-30">
				<div class="size-210 p-r-18 p-r-0-sm w-full-ssm">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14 txt-center">
                        Forgot Password
                    </h4>
                    <div class="p-t-15">
                        <div class="bor8 bg0 m-b-12">
                            <x-input type="text" id="email" name="email" placeholder="Enter your email"/>
                            @error('email')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <x-button>Submit</x-button>
				</div>
			</div>
		</div>
	</form> 
</x-layout>



