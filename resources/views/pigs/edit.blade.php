<x-layouts.app :title="__('Pig Edit')">

    <div
        class="max-w-4xl mx-auto p-8 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-neutral-800 dark:to-neutral-900 shadow-xl rounded-2xl mt-10 border border-neutral-200 dark:border-neutral-700">

        <div class="flex justify-center mb-8">
            <h1 class="text-2xl font-bold text-black-700 font-serif dark:text-blue-300 tracking-wide">Edit Pig</h1>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded-lg shadow-sm border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 mb-4 rounded-lg shadow-sm border border-red-300">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pigs.update', $pig->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- GRID: 3 COLUMNS (TOP) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Weight --}}
                <div>
                    <label class="block text-sm font-semibold  dark:text-blue-300">Weight (kg)</label>
                    <input type="number" name="weight" value="{{ old('weight', $pig->weight) }}"
                        class="mt-1 w-full rounded-xl border border-blue-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-blue-600 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-100">
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-semibold  dark:text-blue-300">Status</label>
                    <select name="status"
                        class="mt-1 w-full rounded-xl border border-blue-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-blue-600 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-100">
                        <option value="Healthy" {{ $pig->status == 'Healthy' ? 'selected' : '' }}>Healthy</option>
                        <option value="Sick" {{ $pig->status == 'Sick' ? 'selected' : '' }}>Sick</option>
                        <option value="Sold" {{ $pig->status == 'Sold' ? 'selected' : '' }}>Sold</option>
                        <option value="Dead" {{ $pig->status == 'Dead' ? 'selected' : '' }}>Dead</option>
                    </select>
                </div>

                {{-- Type --}}
                <div>
                    <label class="block text-sm font-semibold  dark:text-blue-300">Type</label>
                    <select name="type"
                        class="mt-1 w-full rounded-xl border border-blue-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-blue-600 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-100">
                        <option value="Sow" {{ $pig->type == 'Sow' ? 'selected' : '' }}>Sow</option>
                        <option value="Boar" {{ $pig->type == 'Boar' ? 'selected' : '' }}>Boar</option>
                        <option value="Piglet" {{ $pig->type == 'Piglet' ? 'selected' : '' }}>Piglet</option>
                        <option value="Fattening Pig" {{ $pig->type == 'Fattening Pig' ? 'selected' : '' }}>Fattening
                            Pig</option>
                    </select>
                </div>
            </div>

            <!-- GRID: 3 COLUMNS (BOTTOM) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Purpose --}}
                <div>
                    <label class="block text-sm font-semibold  dark:text-blue-300">Purpose</label>
                    <select name="purpose"
                        class="mt-1 w-full rounded-xl border border-blue-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-blue-600 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-100">
                        <option value="Breeding pigs" {{ $pig->purpose == 'Breeding pigs' ? 'selected' : '' }}>Breeding
                            pigs</option>
                        <option value="Meat pigs" {{ $pig->purpose == 'Meat pigs' ? 'selected' : '' }}>Meat pigs
                        </option>
                        <option value="Show pigs" {{ $pig->purpose == 'Show pigs' ? 'selected' : '' }}>Show pigs
                        </option>
                    </select>
                </div>

                {{-- Feeds --}}
                <div>
                    <label class="block text-sm font-semibold  dark:text-blue-300">Feeds</label>
                    <select name="feed_id"
                        class="mt-1 w-full rounded-xl border border-blue-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-blue-600 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-100">
                        <option value="">Select Feeds</option>
                        @foreach ($feeds as $feed)
                            <option value="{{ $feed->id }}" {{ $pig->feed_id == $feed->id ? 'selected' : '' }}>
                                {{ $feed->feeds_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Price --}}
                <div>
                    <label class="block text-sm font-semibold  dark:text-blue-300">Price (₱)</label>
                    <input type="number" name="price" min="0" step="0.01"
                        value="{{ old('price', $pig->price) }}"
                        class="mt-1 w-full rounded-xl border border-blue-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-blue-600 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-100">
                </div>

            </div>

            {{-- Photo Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Current Photo --}}
                <div>
                    <label class="block text-sm font-semibold dark:text-blue-300">Current Photo</label>
                    <div class="mt-1 flex items-center">
                        @if ($pig->photo)
                            <img src="{{ asset('storage/' . $pig->photo) }}"
                                class="h-20 w-20 rounded-full object-cover border">
                        @else
                            <div
                                class="flex h-20 w-20 items-center justify-center rounded-full bg-blue-600 text-white text-lg font-semibold">
                                {{ strtoupper(substr($pig->type, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Upload New Photo --}}
                <div>
                    <label class="block text-sm font-semibold dark:text-blue-300">Upload New Photo (Optional)</label>
                    <input type="file" name="photo" accept="image/png,image/jpeg"
                        class="mt-1 w-full rounded-xl border border-blue-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-blue-600 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-100">
                    <p class="mt-1 text-xs text-neutral-500 dark:text-neutral-400">Leave empty to keep current photo.
                        Max 2MB, PNG or JPEG only.</p>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-between items-center pt-6">
                <a href="/dashboard"
                    class="text-neutral-700 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-200 underline text-sm transition font-medium">
                    Back
                </a>

                <button type="submit"
                    class="bg-blue-600 text-white px-8 py-3 rounded-xl font-semibold text-sm shadow hover:bg-blue-700 transition transform hover:scale-105">
                    Update Pig
                </button>
            </div>

        </form>

    </div>

</x-layouts.app>
