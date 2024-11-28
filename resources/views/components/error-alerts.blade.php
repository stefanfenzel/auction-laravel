@if ($errors->any())
    <div class="py-1 pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <div class="p-4 mb-1 text-sm text-red-600 rounded-lg bg-red-50" role="alert">
                                    {{ $error }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
