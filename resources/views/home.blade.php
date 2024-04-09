<x-layouts.app :title="__('home.pageTitle')">
    <header>
        <h1>{{ __('home.title') }}</h1>
        <p>{{ __('home.intro') }}</p>
    </header>
    <main>
        <div>
           <form action="{{ request('url') }}">
                <input type="search" name="search" id="search" placeholder="{{ __('home.filters.searchEmpty') }}">
                <fieldset>
                <legend>{{ __('home.filters.tagEmpty') }}</legend>
                @foreach($tags as $tag)
                    <div>
                        <input type="checkbox" id="{{ $tag->slug }}" name="tags[]" value="{{ $tag->slug }}">
                        <label for="{{ $tag->slug }}">{{ $tag->name }}</label>
                    </div>
                @endforeach
                </fieldset>
                <button type="submit">{{ __('home.filters.submit')}}</button>
           </form>
        </div>
        <div>
        @foreach($bookmarks as $bookmark)
            <x-bookmark
                :title="$bookmark->title"
                :link="$bookmark->link"
                :description="$bookmark->description"
                :date="$bookmark->created_at"
                :tags="$bookmark->tags"
            />
        @endforeach
        </div>
    </main>
</x-layouts.app>
