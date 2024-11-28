<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new auction') }}
        </h2>
    </x-slot>

    @include('components.error-alerts')

    @include('components.success-alerts')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('auctions.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
                            <input type="text" name="title" id="title" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('title') }}" />
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                            <textarea name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">{{ __('End date') }}</label>
                            <input type="datetime-local"
                                   name="end_date"
                                   id="end_date"
                                   class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('end_date') }}"
                                   min="{{ now()->format('Y-m-d\TH:i') }}"
                            />
                        </div>
                        <div class="mb-4">
                            <label for="starting_price" class="block text-sm font-medium text-gray-700">{{ __('Starting price') }}</label>
                            <input type="number" name="start_price" id="start_price" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('start_price') }}" />
                        </div>
                        <div class="mb-4">
                            <x-primary-button>{{ __('Create auction') }}</x-primary-button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
