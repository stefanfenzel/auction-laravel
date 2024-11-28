@if (isset($success))
    <div class="py-1 pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="alert alert-danger">
                    <ul>
                        <li>
                            <div class="p-4 mb-1 text-sm text-green-600 rounded-lg bg-green-50" role="alert">
                                {{ $success }}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
