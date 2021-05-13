<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="overflow-x-auto max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded-md shadow-md"><h2 class="text-lg text-gray-700 font-semibold capitalize">
                    Product </h2>
                <form action="{{ route($action) }}" method="{{ $method }}">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                        <div><label class="text-gray-700" for="username">Name</label><input
                                class="w-full mt-2 rounded-md focus:border-indigo-600" type="text" name="name"
                                value="{{ old('name') }}"></div>
                        <div><label class="text-gray-700" for="emailAddress">Articul</label><input
                                class="w-full mt-2 rounded-md focus:border-indigo-600" type="text" name="art"
                                value="{{ old('art') }}"></div>
                        <div><label class="text-gray-700" for="password">Status</label>
                            <select class="appearance-none w-full mt-2 rounded-md focus:border-indigo-600"
                                    name="status">
                                @foreach($status as $option)
                                    <option value="{{ $option }}">{{ ucfirst($option) }}</option>
                                @endforeach
                            </select></div>
                        <div><label class="text-gray-700" for="passwordConfirmation">Data</label><input
                                class="w-full mt-2 rounded-md focus:border-indigo-600" type="password"></div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button
                            class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
