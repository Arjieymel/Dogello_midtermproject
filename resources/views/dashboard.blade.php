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


                    <form action="{{ route('pigs.store') }}" method="POST" class="grid gap-4 md:grid-cols-3">
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

                        <div class="md:col-span-3">
                            <button type="submit"
                                class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-medium text-white hover:bg-blue-700">
                                Add Pig
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Pig List Table -->
                <div class="flex-1 overflow-auto">
                    <h2
                        class="mt-6 mb-4 text-center text-2xl font-serif font-semibold text-neutral-900 dark:text-neutral-100">
                        Pig List
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full">
                            <thead>
                                <tr
                                    class="border-b border-neutral-200 bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-900/50">
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Id</th>
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
                                        <td class="px-4 py-3 text-sm">{{ $pig->weight }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->status }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->type }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->purpose }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->feed ? $pig->feed->feeds_name : 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">{{ $pig->price }}</td>
                                        <td class="px-4 py-3 text-sm flex gap-2">
                                            <a href="{{ route('pigs.edit', $pig->id) }}"
                                                class="text-blue-600 hover:text-blue-700">Edit</a>

                                            <form action="{{ route('pigs.destroy', $pig->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this pig?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600 hover:text-red-700">Delete</button>
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
