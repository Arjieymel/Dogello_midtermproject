<x-layouts.app :title="__('Pig Feeds Management')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        @if (session('success'))
            <div id="success-message"
                class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow transition-opacity duration-500 opacity-100">
                {{ session('success') }}
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const msg = document.getElementById('success-message');

                    // Hide after 1 second
                    setTimeout(() => {
                        // Fade out using opacity
                        msg.classList.add('opacity-0');

                        // Remove from DOM after fade-out completes
                        setTimeout(() => {
                            msg.remove();
                        }, 500); // matches Tailwind's duration-500
                    }, 1000);
                });
            </script>
        @endif
        <!-- Add Feeds Form -->
        <div
            class="mb-6 rounded-lg border border-neutral-200 bg-indigo-50 p-6 dark:border-neutral-700 dark:bg-neutral-900/50">
            <h2 class="mb-4 text-lg font-serif font-semibold text-neutral-900 dark:text-neutral-100 text-center">
                Adding Feeds
            </h2>

            <form action="{{ route('feeds.store') }}" method="POST" class="grid gap-4 md:grid-cols-2">
                @csrf

                <!-- Feed Name -->
                <div>
                    <label
                        class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300 text-center">Feeds
                        Name</label>
                    <input type="text" name="feeds_name" value="{{ old('feeds_name') }}" placeholder="Name of Feeds"
                        class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                    @error('feeds_name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label
                        class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300 text-center">Description</label>
                    <input type="text" name="description" value="{{ old('description') }}"
                        placeholder="Description of Feeds"
                        class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                    @error('description')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="md:col-span-2 flex justify-center">
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                        Add Feeds
                    </button>
                </div>

            </form>
        </div>

        <!-- Feeds List Table -->
        <div class="flex-1 overflow-auto bg-indigo-50 pt-2">
            <h2 class="mb-4 text-lg font-semibold text-neutral-900 dark:text-neutral-100 text-center font-serif">Feeds
                List</h2>
            <div class="overflow-x-auto">
                <table class="w-full min-w-full">
                    <thead>
                        <tr
                            class="border-b border-neutral-200 bg-indigo-50 dark:border-neutral-700 dark:bg-neutral-900/50">
                            <th
                                class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                Id</th>
                            <th
                                class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                Feeds Name</th>
                            <th
                                class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                Description</th>
                            <th
                                class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feeds as $feed)
                            <tr class="transition-colors hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                                <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $feed->id }}
                                </td>
                                <td class="px-4 py-3 text-sm text-neutral-900 dark:text-neutral-100">
                                    {{ $feed->feeds_name }}</td>
                                <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">
                                    {{ $feed->description }}</td>
                                <td class="px-4 py-3 text-sm">

                                    <a href=" {{ route('feeds.edit', $feed->id) }} "
                                        class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">Edit</a>
                                    <span class="mx-1 text-neutral-400">|</span>

                                    <form action=" {{ route('feeds.destroy', $feed->id) }} " method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
