<x-layout>
    <div class="bg0 p-t-75 p-b-85"  method="POST" action={{ route('login') }}>
        @csrf
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
                        @if (Auth::check() && Auth::user()->id === $userId && ! $isPublic)
                            <p><strong>Username:</strong> {{ $username }}</p>
                        @endif
                
                    <p><strong>Email:</strong> {{ $email }}</p>
                    <div class="p-t-15">
                        <form action="{{ route('updateEmail') }}" method="POST" class="m-b-22">
                            @csrf
                            @method('PUT')
                            <div class="bg0 m-b-22">
                                <x-input type="email" name="email" placeholder="Enter your new email" />
                                @error('username')
                                    <x-error>{{ $message }}</x-error>
                                @enderror
                            </div>
                            <x-button type="submit">Update Email</x-button>
                        </form>
                        <form action="{{ route('updateUsername') }}" method="POST" class="m-b-22">
                            @csrf
                            @method('PUT')
                            <div class="m-b-22">
                                <x-input type="text" name="username" placeholder="Enter your new username" />
                                @error('username')
                                    <x-error>{{ $message }}</x-error>
                                @enderror
                            </div>
                            <x-button type="submit">Update Username</x-button>
                        </form>
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
