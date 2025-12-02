<x-layouts.app :title="__('Edit Feeds')">

    <div
        class="max-w-2xl mx-auto mt-10 rounded-xl border border-neutral-200 bg-indigo-50 p-8 shadow-lg dark:border-neutral-700 dark:bg-neutral-900/50">

        <h1 class="mb-6 text-2xl font-bold text-neutral-900 dark:text-neutral-100 text-center font-serif">
            Edit Feeds
        </h1>


        <form action="{{ route('feeds.update', $feed->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Feeds Name -->
            <div>
                <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300 text-center">
                    Feeds Name
                </label>
                <input type="text" name="feeds_name" value="{{ old('feeds_name', $feed->feeds_name) }}"
                    placeholder="Enter Feeds Name"
                    class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">

                @error('feeds_name')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300 text-center">
                    Description
                </label>
                <input type="text" name="description" value="{{ old('description', $feed->description) }}"
                    placeholder="Enter Description"
                    class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">

                @error('description')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center">
                <a href="{{ route('feeds.index') }}"
                    class="text-sm font-medium text-neutral-700 underline hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-neutral-200">
                    Back
                </a>

                <button type="submit"
                    class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                    Update Feeds
                </button>
            </div>

        </form>
    </div>

</x-layouts.app>
