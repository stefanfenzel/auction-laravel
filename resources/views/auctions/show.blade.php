<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Auction details') }}
        </h2>
    </x-slot>

    @include('components.error-alerts')

    @include('components.success-alerts')

    @if ($auction->isFinished())
        <div class="py-1 pb-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="p-6 text-gray-900">
                        <p class="text-2xl text-red-600">{{ __('Finished') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold">{{ $auction->title }}</h2>

                    <p class="text-sm text-gray-500 pt-1">{{ __('Description') }}:</p>
                    <p class="text-sm text-gray-500 pb-3">{{ $auction->description }}</p>
                    <hr class="my-4 pb-3">
                    <span class="text-sm text-gray-500 pl-3 pr-3">
                        {{ __('End date') }}: {{ $auction->end_date->format('d.m.Y') }} {{ __('at') }} {{ $auction->end_date->format('H:s') }} {{ __('o\'Clock') }}
                    </span> |
                    <span class="text-sm text-gray-500 pl-3 pr-3">{{ __('Starting price') }}: {{ $auction->start_price }} €</span> |
                    <span class="text-sm text-gray-500 pl-3 pr-3">{{ __('Highest bid') }}: {{ $auction->highestOffer() ?: '-' }} €</span> |
                    <span class="text-sm text-gray-500 pl-3 pr-3">{{ __('Created at') }}
                        {{ $auction->created_at->format('d.m.Y') }} {{ __('by') }} {{ $auction->user->name }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    @if (!$auction->isFinished())
        <form method="POST" action="{{ route('offers.place-bid', $auction->id) }}">
            @csrf
            <div class="py-1">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="d-flex justify-content-between">
                                <h2 class="text-2xl font-semibold">Place a bid</h2>

                                <div class="py-2">
                                    <label for="price" class="block text-sm/6 font-medium text-gray-900">Price</label>
                                    <div class="inline-flex relative mt-2 rounded-md shadow-sm">
                                        <div
                                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <span class="text-gray-500 sm:text-sm">€</span>
                                        </div>
                                        <input
                                            type="text"
                                            name="price"
                                            id="price"
                                            class="inline-flex w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                                            placeholder="{{ $auction->highestOffer() ?: $auction->start_price }}"
                                            min="{{ $auction->highestOffer() ?: $auction->start_price }}">
                                    </div>

                                    <div class="inline-flex pl-3">
                                        <x-primary-button>
                                            {{ __('Give a bit') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold">Bids</h3>
                    @if ($auction->offers->count() > 0)
                        <table class="table-auto w-full">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">Bidder</th>
                                <th class="px-4 py-2">Amount</th>
                                <th class="px-4 py-2">Created at</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- todo order offers by bid_time --}}
                            @foreach ($auction->offers as $bid)
                                <tr>
                                    <td class="border px-4 py-2">{{ $bid->user->name }}</td>
                                    <td class="border px-4 py-2">{{ $bid->bid_amount }} €</td>
                                    <td class="border px-4 py-2">{{ $bid->bid_time->format('d.m.Y H:i') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-sm text-gray-500">No bids yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
