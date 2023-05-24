<x-layout>
    <div style="margin-top: 10%; margin-bottom: 10%; text-align: center;">
        <h3 style="font-size: 24px; margin-bottom: 10px;">
            Please check your email now!
        </h3>
        <p style="font-size: 14px; margin-bottom: 20px;">
            You haven't received an email yet
        </p>
        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button type="submit"
                style="padding: 10px 20px; background-color: #4287f5; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
                Resend Email again
            </button>
        </form>
        <p style="margin-top: 10px; color:#4287f5">
            @if (session('message'))
                {{ session('message') }}
            @endif
        </p>

    </div>
    <p>

</x-layout>
