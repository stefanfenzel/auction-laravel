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

                            <input type="hidden" name="auction_id" value="{{ $auction->id }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
