<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Auction details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold">{{ $auction->title }}</h2>

                    @if ($auction->isFinished())
                        <p class="text-sm text-gray-500">Finished</p>
                    @endif

                    <p class="text-sm text-gray-500 pt-1">Description:</p>
                    <p class="text-sm text-gray-500 pb-3">{{ $auction->description }}</p>
                    <hr class="my-4 pb-3">
                    <p class="text-sm text-gray-500">End date: {{ $auction->end_date->format('d.m.Y H:i') }}</p>
                    <p class="text-sm text-gray-500">Starting price: {{ $auction->start_price }} €</p>
                    <p class="text-sm text-gray-500">Highest bid: {{ $auction->highestOffer() ?: '-' }} €</p>
                    <p class="text-sm text-gray-500">Created by: {{ $auction->user->name }}</p>
                    <p class="text-sm text-gray-500">Created at: {{ $auction->created_at->format('d.m.Y H:i') }}</p>
                    <p class="text-sm text-gray-500">Updated at: {{ $auction->updated_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 pt-1">
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
