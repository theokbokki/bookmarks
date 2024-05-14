<article class="bookmark">
    <h4 class="bookmark__title">
        <a href="{{ $link }}"
            target="_blank"
            class="bookmark__link"
        >
            {{ $title }}
        </a>
    </h4>
    <p class="bookmark__description">{{ $description }}</p>
    @if(count($tags))
    <div class="bookmark__tags">
       @foreach($tags as $tag)
        <x-tag
            :color="$tag->color"
        >
            {{ $tag->name }}
        </x-tag>
        @endforeach
    </div>
    @endif
</article>
