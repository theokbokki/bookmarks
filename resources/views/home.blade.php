<x-layouts.app :title="__('home.pageTitle')">
    <header>
        <h1>{{ __('home.title') }}</h1>
        <p>{{ __('home.intro') }}</p>
    </header>
    <main>
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
