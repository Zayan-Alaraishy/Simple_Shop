@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'bor8 stext-111 cl8 plh3 size-111 p-lr-15']) }}/>