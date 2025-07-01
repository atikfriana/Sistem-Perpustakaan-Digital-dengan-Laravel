<section class="py-6 px-4 sm:px-6 md:px-10 flex flex-wrap gap-3 max-w-full overflow-x-auto">
    @foreach($categories as $category)
        <button class="flex-shrink-0 bg-blue-500 text-white text-xs font-semibold rounded-md px-4 py-1.5 whitespace-nowrap">
            {{ $category->name }}
        </button>
    @endforeach
</section>
