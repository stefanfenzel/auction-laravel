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
                <h2 class="text-lg font-semibold">{{ $auction->title }}</h2>
            </td>
            <th class="border px-4 py-2">
                <p class="text-sm text-gray-500">{{ strlen($auction->description) > 50 ? substr($auction->description, 0, 50) . '...' : $auction->description }}</p>
            </th>
            <th class="border px-4 py-2">
                <p class="text-sm text-gray-500">{{ $auction->end_date->format('d.m.Y H:i') }}</p>
            </th>
            <th class="border px-4 py-2">
                <p class="text-sm text-gray-500">{{ $auction->highestOffer() ?: '-' }} €</p>
            </th>
            <th class="border px-4 py-2">
                <p class="text-sm text-gray-500">
                    <a href="{{ route('auctions.show', $auction->id) }}" class="text-blue-500">View</a>
                </p>
            </th>
        </tr>
    @endforeach
    </tbody>
</table>
