<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My auctions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
                                    <td class="border px-4 py-2"><h2 class="text-lg font-semibold">{{ $auction->title }}</h2></td>
                                    <th class="border px-4 py-2"><p class="text-sm text-gray-500">{{ $auction->description }}</p></th>
                                    <th class="border px-4 py-2"><p class="text-sm text-gray-500">{{ $auction->end_date->format('d.m.Y H:i') }}</p></th>
                                    <th class="border px-4 py-2"><p class="text-sm text-gray-500">{{ $auction->current_bid ?: '-' }}</p></th>
                                    <th class="border px-4 py-2"><p class="text-sm text-gray-500"><a href="{{ route('auctions.show', $auction->id) }}" class="text-blue-500">View</a></p></th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
