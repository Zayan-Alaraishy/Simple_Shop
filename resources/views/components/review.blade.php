@props(['review'])

<div class="flex-w flex-t p-b-68">
    <a href={{route('profile', $review->user->id)}}>
        <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png" alt="AVATAR">
        </div>
    </a>
    <div class="size-207">
        <div class="flex-w flex-sb-m p-b-17">
            <a href={{route('profile', $review->user->id)}}>
            <span class="mtext-107 cl2 p-r-20">
                {{$review->user->username}}
            </span>
            </a>
            <span class="fs-18 cl11">
                @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $review->rating)
                  <i class="item-rating pointer zmdi zmdi-star"></i>
                @else
                  <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                @endif
              @endfor
            </span>
        </div>

        <p class="stext-102 cl6">
            {{ $review->comment }}
        </p>
    </div>
</div>