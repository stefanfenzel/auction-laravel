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
                    <div>
                        <div class="inline-flex"><h2 class="text-2xl font-semibold max-w-5xl">
                                {{ $auction->getTitle() }}
                            </h2></div>

                        @if ($auction->user_id === auth()->id())
                            <div class="inline-flex float-right">
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-3 py-2 text-blue-500">
                                            <div>{{ __('Actions') }}</div>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        @if (!$auction->isFinished())
                                            <x-dropdown-link :href="route('auctions.edit', $auction->id)">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                        @endif

                                        <form action="{{ route('auctions.delete', $auction->id) }}" method="POST">
                                            @csrf

                                            <x-dropdown-link :href="route('auctions.delete', $auction->id)"
                                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @endif
                    </div>

                    <p class="text-sm text-gray-500 pt-1">{{ __('Description') }}:</p>
                    <p class="text-sm text-gray-500 pb-3">{{ $auction->getDescription() }}</p>
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

    @auth
        @if (!$auction->isFinished())
            @include('auctions.partials.new-bid')
       @endif
    @endauth

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
