<article>
    <h4>
        <a href="{{ $link }}"
            target="_blank"
        >
            {{ $title }}
        </a>
    </h4>
    <p>{{ $date->diffForHumans() }}</p>
    <p>{{ $description }}</p>
    @if(count($tags))
    <div>
        @foreach($tags as $tag)
        <x-tag>{{ $tag->name }}</x-tag>
        @endforeach
    </div>
    @endif
</article>
