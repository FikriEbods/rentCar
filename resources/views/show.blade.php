<x-landingpage-layout>
    @if (session()->has('status'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">Success alert!</span> {{ Session::get('status') }}
        </div>
    @endif
    @if (session()->has('alert'))
        <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400" role="alert">
            <span class="font-medium">Sorry!</span> {{ Session::get('alert') }}
        </div>
    @endif
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="flex flex-col md:flex-row -mx-4">
            <div class="md:flex-1 px-4">
                <div x-data="{ image: 1 }" x-cloak>
                    <div class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4">
                        <div x-show="image === 1" class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $car->image) }}" class="rounded-lg h-full w-full object-cover object-center lg:h-full lg:w-full">
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:flex-1 px-4">
                <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">{{ $car->title }}</h2>
                <p class="text-gray-500 text-sm">By <a href="#" class="text-blue-600 hover:underline">Admin</a></p>
        
                <div class="flex items-center my-4">
                    <div>
                        <div class="rounded-lg bg-gray-100 flex py-2 px-3">
                        <span class="text-blue-400 mr-1 mt-1">Rp</span>
                        <span class="font-bold text-blue-600 text-3xl">{{ number_format($car->price,2,',','.') }}</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-green-500 text-xl font-semibold">Save 12%</p>
                        <p class="text-gray-400 text-sm">Inclusive of all Taxes.</p>
                    </div>
                </div>
        
                <p class="text-gray-500">{{ $car->description }}</p>
        
                <div class="py-4">
                    <form action="{{ route('booking', [$car->id]) }}" method="POST">
                        @method('POST')
                        @csrf
                        <input type="date" name="start_at" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"> Sampai
                        <input type="date" name="end_at" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">        
                        <br>
                        <button class="px-6 py-2 font-semibold rounded-xl bg-blue-600 hover:bg-blue-500 text-white">
                            Booking Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">
            History Vehicle
        </h2>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Start At
                        </th>
                        <th scope="col" class="px-6 py-3">
                            End At
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ date('d-m-Y', strtotime($item->start_at)); }}
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ date('d-m-Y', strtotime($item->end_at)); }}
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-5 bg-slate-100">
                {{ $transaction->links() }}
            </div>
        </div>
    </div>
</x-landingpage-layout>