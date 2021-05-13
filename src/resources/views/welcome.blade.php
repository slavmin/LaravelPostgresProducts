<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (count($products) > 0)
        <div class="py-12">
            <div class="overflow-x-auto max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Articul
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Data
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach($products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-gray-100 rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 0 24 24"
                                                 width="48px" fill="#999999">
                                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                                <path
                                                    d="M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-4.86 8.86l-3 3.87L9 13.14 6 17h12l-3.86-5.14z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div
                                                class="text-sm leading-5 font-medium text-gray-900">{{ $product->name ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                    {{ $product->art ?? '' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    @if($product->data)
                                        @foreach($product->data as $dataKey => $dataVal)
                                            <div class="text-sm leading-5 text-gray-500">{{ $dataKey }}
                                                : {{ $dataVal }}</div>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200"><span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->status == 'unavailable' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">{{ $product->status }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
