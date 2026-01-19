<x-layouts.app :title="__('Pig Inventory Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- Stats Cards -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-5">
            <div
                class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800
                shadow-[0_4px_15px_rgba(59,130,246,0.5)]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Pigs</p>
                        <h3 class="mt-2 text-3xl font-bold text-neutral-900 dark:text-neutral-100"> {{ $pigs->count() }}
                        </h3>
                    </div>
                    <div class="rounded-full bg-blue-100 p-3 dark:bg-blue-900/30">🐷</div>
                </div>
            </div>

            <div
                class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800
                shadow-[0_4px_15px_rgba(59,130,246,0.5)]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Active Feeds</p>
                        <h3 class="mt-2 text-3xl font-bold text-neutral-900 dark:text-neutral-100">
                            {{ $feeds->count() }}
                        </h3>
                    </div>
                    <div class="rounded-full bg-blue-100 p-3 dark:bg-blue-900/30">🐷</div>
                </div>
            </div>


            <div
                class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800
                shadow-[0_4px_15px_rgba(59,130,246,0.5)]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Dead</p>
                        <h3 class="mt-2 text-3xl font-bold text-neutral-900 dark:text-neutral-100">
                            {{ $totalDead }}
                        </h3>
                    </div>
                    <div class="rounded-full bg-blue-100 p-3 dark:bg-blue-900/30">🐷</div>
                </div>
            </div>

            <div
                class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800
                shadow-[0_4px_15px_rgba(59,130,246,0.5)]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Sold</p>
                        <h3 class="mt-2 text-3xl font-bold text-neutral-900 dark:text-neutral-100">
                            {{ $totalSold }}
                        </h3>
                    </div>
                    <div class="rounded-full bg-blue-100 p-3 dark:bg-blue-900/30">🐷</div>
                </div>
            </div>


            <div
                class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800
                 shadow-[0_4px_15px_rgba(59,130,246,0.5)]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600 dark:text-neutral-400">Total Sales</p>
                        <h3 class="mt-2 text-3xl font-bold text-neutral-900 dark:text-neutral-100">
                            {{ number_format($totalSales, 2) }}
                        </h3>
                    </div>

                </div>
            </div>
        </div>


        <!-- Pig Management Section -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('pigs.export.pdf', request()->query()) }}"
                class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700">
                📄 Export PDF
            </a>
        </div>

        <div
            class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800
           shadow-[0_4px_15px_rgba(59,130,246,0.5)]">
            <div class="flex h-full flex-col p-6">

                <!-- Add Pig Form -->
                <div
                    class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800
                    shadow-[0_4px_15px_rgba(59,130,246,0.5)]">
                    <h2
                        class="mb-4 text-2xl font-semibold text-neutral-900 font-serif dark:text-neutral-100 text-center">
                        Add New Pig
                    </h2>


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


                    <form action="{{ route('pigs.store') }}" method="POST" enctype="multipart/form-data"
                        class="grid gap-4 md:grid-cols-3">
                        @csrf

                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Weight
                                (kg)</label>
                            <input type="number" name="weight" required
                                class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-100">
                        </div>



                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Status</label>
                            <select name="status"
                                class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-100">
                                <option>Healthy</option>
                                <option>Sick</option>
                                <option>Sold</option>
                                <option>Dead</option>
                            </select>
                        </div>

                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Type</label>
                            <select name="type"
                                class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-100">
                                <option>Sow</option>
                                <option>Boar</option>
                                <option>Piglet</option>
                                <option>Fattening Pig</option>
                            </select>
                        </div>

                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Purpose</label>
                            <select name="purpose"
                                class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-100">
                                <option>Breeding pigs</option>
                                <option>Meat pigs</option>
                                <option>Show pigs</option>
                            </select>
                        </div>

                        <div>
                            <label
                                class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Feeds</label>
                            <select name="feed_id"
                                class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-100">
                                <option value="">Select Feeds</option>
                                @foreach ($feeds as $feed)
                                    <option value="{{ $feed->id }}">{{ $feed->feeds_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">
                                Price
                            </label>
                            <input type="number" name="price" min="0" step="0.01"
                                value="{{ old('price', $pig->price ?? '') }}"
                                class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-100">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">
                                Pig Photo
                            </label>

                            <input type="file" name="photo" accept="image/png,image/jpeg"
                                class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm
        dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-100">
                        </div>

                        <div class="md:col-span-3">
                            <button type="submit"
                                class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-medium text-white hover:bg-blue-700">
                                Add Pig
                            </button>
                        </div>



                    </form>
                </div>

                <!-- Pig List Table -->
                <form method="GET" action="{{ route('pigs.index') }}"
                    class="mt-8 mb-4 grid grid-cols-1 gap-3 md:grid-cols-4">


                    <!-- Search -->
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by ID, type, purpose, feed..."
                        class="rounded-lg border border-neutral-300 px-4 py-2 text-sm">


                    <!-- Status Filter -->
                    <select name="status"
                        class="rounded-lg border border-neutral-300 px-4 py-2 text-sm dark:bg-neutral-800 dark:border-neutral-600">
                        <option value="">All Status</option>
                        <option value="Healthy" {{ request('status') == 'Healthy' ? 'selected' : '' }}>Healthy</option>
                        <option value="Sick" {{ request('status') == 'Sick' ? 'selected' : '' }}>Sick</option>
                        <option value="Sold" {{ request('status') == 'Sold' ? 'selected' : '' }}>Sold</option>
                        <option value="Dead" {{ request('status') == 'Dead' ? 'selected' : '' }}>Dead</option>
                    </select>

                    <!-- Type Filter -->
                    <select name="type"
                        class="rounded-lg border border-neutral-300 px-4 py-2 text-sm dark:bg-neutral-800 dark:border-neutral-600">
                        <option value="">All Types</option>
                        <option value="Sow" {{ request('type') == 'Sow' ? 'selected' : '' }}>Sow</option>
                        <option value="Boar" {{ request('type') == 'Boar' ? 'selected' : '' }}>Boar</option>
                        <option value="Piglet" {{ request('type') == 'Piglet' ? 'selected' : '' }}>Piglet</option>
                        <option value="Fattening Pig" {{ request('type') == 'Fattening Pig' ? 'selected' : '' }}>
                            Fattening Pig</option>
                    </select>

                    <!-- Buttons -->
                    <div class="flex gap-2">
                        <button type="submit"
                            class="w-full rounded-lg bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                            Search
                        </button>

                        <a href="{{ route('pigs.index') }}"
                            class="w-full rounded-lg bg-gray-500 px-4 py-2 text-sm text-white text-center hover:bg-gray-600">
                            Clear
                        </a>
                    </div>
                </form>

                <div class="flex-1 overflow-auto">
                    <h2 class="mt-6 mb-4 text-center text-2xl font-semibold text-neutral-900 dark:text-neutral-100">
                        Pig List
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full">
                            <thead>
                            <tbody>

                                <tr
                                    class="border-b border-neutral-200 bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-900/50">
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Id</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Photo</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Weight (kg)</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Type</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Purpose</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Feeds</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Price</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Action</th>
                                </tr>
                                </thead>
                            <tbody>

                                @foreach ($pigs as $pig)
                                    <tr class="transition-colors hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                                        <td class="px-4 py-3 text-sm">{{ $pig->id }}</td>
                                        <td class="px-4 py-3">
                                            @if ($pig->photo)
                                                <img src="{{ asset('storage/' . $pig->photo) }}"
                                                    class="h-10 w-10 rounded-full object-cover border">
                                            @else
                                                <div
                                                    class="flex h-10 w-10 items-center justify-center rounded-full
                    bg-blue-600 text-white text-sm font-semibold">
                                                    {{ strtoupper(substr($pig->type, 0, 2)) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->weight }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->status }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->type }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->purpose }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $pig->feed ? $pig->feed->feeds_name : 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->price }}</td>
                                        <td class="px-4 py-3 text-sm flex gap-2">
                                            <a href="{{ route('pigs.edit', $pig->id) }}"
                                                class="text-blue-600 hover:text-blue-700">Edit</a>

                                            <form action="{{ route('pigs.destroy', $pig->id) }}" method="POST"
                                                onsubmit="return confirm('Move this pig to trash?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-orange-600 hover:text-orange-700">Trash</button>
                                            </form>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
