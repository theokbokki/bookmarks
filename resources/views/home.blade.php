<x-layouts.app :title="__('home.pageTitle')">
    <header class="hero">
        <h1 class="hero__title">{{ __('home.title') }}</h1>
        <p class="hero__subtitle">{{ __('home.intro') }}</p>
    </header>
    <main class="main">
        <div class="filters">
            <form action="{{ request('url') }}"
                class="filters__form"
            >
                <fieldset class="filters__item filters__item--search">
                    <input type="search"
                        name="search"
                        id="search"
                        placeholder="{{ __('home.filters.searchEmpty') }}"
                        class="filters__input filters__input--search"
                    >
                </fieldset>
                <fieldset class="filters__item filters__item--tags">
                    <input type="checkbox"
                        class="filters__toggle sro"
                        name="checkbox-toggle"
                        id="checkbox-toggle"
                    >
                    <label for="checkbox-toggle"
                        class="filters__input filters__input--tags"
                    >
                        <span class="filters__input--placeholder">{{ __('home.filters.tagEmpty') }}</span>
                        <div>
                        @foreach($tags as $tag)
                        <span class="tag tag--close"
                            style="background: var(--{{ $tag->color }}-100); color: var(--{{ $tag->color }}-600);"
                            id="{{ $tag->slug }}-close"
                            data-name="{{ $tag->slug }}"
                        >
                            {{ $tag->name }}
                            <span class="tag--close-icon"
                                style="color: var(--{{ $tag->color }}-600);"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                            </span>

                        </span>
                        @endforeach
                        </div>
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
                                >
                                    {{ $tag->name }}
                                </label>
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
