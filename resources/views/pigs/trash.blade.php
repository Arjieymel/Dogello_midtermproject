<x-layouts.app :title="__('Pig Trash')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">Pig Trash</h1>
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                ← Back to Dashboard
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded-lg shadow-sm border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        <!-- Trash List -->
        <div
            class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800 shadow-[0_4px_15px_rgba(59,130,246,0.5)]">
            <div class="flex h-full flex-col p-6">
                <h2 class="mb-4 text-2xl font-semibold text-neutral-900 font-serif dark:text-neutral-100 text-center">
                    Deleted Pigs
                </h2>

                @if ($trashedPigs->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full">
                            <thead>
                                <tr
                                    class="border-b border-neutral-200 bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-900/50">
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Id</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Photo</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Weight (kg)</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Type</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Purpose</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Feeds</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Deleted At</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trashedPigs as $pig)
                                    <tr class="transition-colors hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                                        <td class="px-4 py-3 text-sm">{{ $pig->id }}</td>
                                        <td class="px-4 py-3">
                                            @if ($pig->photo)
                                                <img src="{{ asset('storage/' . $pig->photo) }}"
                                                    class="h-10 w-10 rounded-full object-cover border opacity-50">
                                            @else
                                                <div
                                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 text-white text-sm font-semibold opacity-50">
                                                    {{ strtoupper(substr($pig->type, 0, 2)) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->weight }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->status }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->type }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->purpose }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $pig->feed ? $pig->feed->feeds_name : 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->deleted_at->format('M d, Y H:i') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm flex gap-2">
                                            <form action="{{ route('pigs.restore', $pig->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="text-green-600 hover:text-green-700 font-medium">Restore</button>
                                            </form>
                                            <form action="{{ route('pigs.force-delete', $pig->id) }}" method="POST"
                                                onsubmit="return confirm('Permanently delete this pig? This action cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-700 font-medium">Delete
                                                    Forever</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-lg text-gray-500">No deleted pigs found.</p>
                        <p class="text-sm mt-2 text-gray-400">Deleted pigs will appear here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
