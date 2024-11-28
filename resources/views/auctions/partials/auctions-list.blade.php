<table class="table-auto w-full">
    <thead>
    <tr>
        <th class="px-4 py-2">Title</th>
        <th class="px-4 py-2">Description</th>
        <th class="px-4 py-2">End date</th>
        <th class="px-4 py-2">Current bid</th>
        <th class="px-4 py-2">Actions</th>
    </tr>
    <tbody>
    @foreach ($auctions as $auction)
        <tr>
            <td class="border px-4 py-2">
                <h2 class="text-lg font-semibold">{{ $auction->getTitle() }}</h2>
            </td>
            <th class="border px-4 py-2">
                <p class="text-sm text-gray-500">
                    {{ strlen($auction->getDescription()) > 50 ? substr($auction->getDescription(), 0, 50) . '...' : $auction->getDescription() }}
                </p>
            </th>
            <th class="border px-4 py-2">
                <p class="text-sm text-gray-500">{{ $auction->end_date->format('d.m.Y H:i') }}</p>
            </th>
            <th class="border px-4 py-2">
                <p class="text-sm text-gray-500">{{ $auction->highestOffer() ?: '-' }} €</p>
            </th>
            <th class="border px-4 py-2">
                <p class="text-sm text-gray-500">
                    @if ($auction->user_id === auth()->id())
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
                                <x-dropdown-link :href="route('auctions.show', $auction->id)">
                                    {{ __('View') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('auctions.edit', $auction->id)">
                                    {{ __('Edit') }}
                                </x-dropdown-link>

                                <form action="{{ route('auctions.delete', $auction->id) }}" method="POST">
                                    @csrf

                                    <x-dropdown-link :href="route('auctions.delete', $auction->id)"
                                                     onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Delete') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <a href="{{ route('auctions.show', $auction->id) }}" class="text-blue-500">{{ __('View') }}</a>
                    @endif
                </p>
            </th>
        </tr>
    @endforeach
    </tbody>
</table>
