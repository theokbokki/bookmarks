<x-layouts.app :title="__('home.pageTitle')">
    <header class="hero content">
        <h1 class="hero__title">{{ __('home.title') }}</h1>
        <p class="hero__subtitle">{{ __('home.intro') }}</p>
    </header>
    <main class="main content">
        <div class="filters">
            <form action="{{ request('url') }}"
                class="filters__form"
            >
                <fieldset class="filters__item filters__search">
                    <input type="search"
                        name="search"
                        id="search"
                        placeholder="{{ __('home.filters.searchEmpty') }}"
                        class="filters__input"
                    >
                </fieldset>
                <fieldset class="filters__item">
                    <input type="checkbox"
                        class="filters__toggle sro"
                        name="checkbox-toggle"
                        id="checkbox-toggle"
                    >
                    <label for="checkbox-toggle"
                        class="filters__input"
                    >
                        {{ __('home.filters.tagEmpty') }}
                    </label>
                    <div class="filters__dropdown dropdown">
                        @foreach($tags as $tag)
                            <div class="dropdown__item">
                                <input
                                    type="checkbox"
                                    id="{{ $tag->slug }}"
                                    name="tags[]"
                                    value="{{ $tag->slug }}"
                                    class="dropdown__input sro"
                                >
                                <label for="{{ $tag->slug }}"
                                    class="dropdown__label"
                                >{{ $tag->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
                <button type="submit"
                    class="filters__submit"
                >
                    {{ __('home.filters.submit')}}
                </button>
           </form>
        </div>
        <div class="bookmarks">
        @fragment('bookmarks')
        @foreach($bookmarks as $bookmark)
            <x-bookmark
                :title="$bookmark->title"
                :link="$bookmark->link"
                :description="$bookmark->description"
                :date="$bookmark->created_at"
                :tags="$bookmark->tags"
            />
        @endforeach
        @endfragment
        </div>
    </main>
</x-layouts.app>
