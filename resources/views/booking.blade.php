<x-landingpage-layout>
    <div class="min-w-screen min-h-screen bg-gray-50 py-5">
        <div class="px-5">
            <div class="mb-2">
                <a href="{{ route('detail', [$car->id]) }}" class="focus:outline-none hover:underline text-gray-500 text-sm"><i class="mdi mdi-arrow-left text-gray-400"></i>Back</a>
            </div>
            <div class="mb-2">
                <h1 class="text-3xl md:text-5xl font-bold text-gray-600">Checkout.</h1>
            </div>
        </div>
        <div class="w-full bg-white border-t border-b border-gray-200 px-5 py-10 text-gray-800">
            <div class="w-full">
                <div class="-mx-3 md:flex items-start">
                    <div class="px-3 md:w-7/12 lg:pr-10">
                        <div class="w-full mx-auto text-gray-800 font-light mb-6 border-b border-gray-200 pb-6">
                            <div class="w-full items-center">
                                <img src="{{ asset('storage/' . $car->image) }}" class="rounded-lg h-full w-full object-cover object-center lg:h-full lg:w-full">
                                <div class="m-5">
                                    <p>{{ $car->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-3 md:w-5/12">
                        <div class="w-full mx-auto rounded-lg bg-white border border-gray-200 text-gray-800 font-light mb-6">
                            <div class="w-full p-3 border-b border-gray-200">
                                <div class="flex-grow pb-5">
                                    <h6 class="font-semibold uppercase text-gray-600">{{ $car->title }}</h6>
                                </div>
                                <div class="mb-6 pb-6 border-b border-gray-200 text-gray-800">
                                    <div class="w-full flex mb-3 items-center">
                                        <div class="flex-grow">
                                            <span class="text-gray-600">Rent Day</span>
                                        </div>
                                        <div class="pl-3">
                                            <span class="font-semibold">{{ $numberOfDays }}</span>
                                        </div>
                                    </div>
                                    <div class="w-full flex items-center">
                                        <div class="flex-grow">
                                            <span class="text-gray-600">Price per Day</span>
                                        </div>
                                        <div class="pl-3">
                                            <span class="font-semibold">Rp {{ number_format($car->price,2,',','.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-6 pb-6 border-b border-gray-200 md:border-none text-gray-800 text-xl">
                                    <div class="w-full flex items-center">
                                        <div class="flex-grow">
                                            <span class="text-gray-600">Total</span>
                                        </div>
                                        <div class="pl-3">
                                            <span class="font-semibold">Rp {{ number_format($rentalPrice,2,',','.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <form action="{{ route('payment',[$car->id, "rentalPrice" => $rentalPrice, 'start_at' => $start_at, 'end_at' => $end_at]) }}" method="post">
                                @csrf
                                {{-- <input type="hidden" name="" value=""> --}}
                                <button class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-2 font-semibold"><i class="mdi mdi-lock-outline mr-1"></i> PAY NOW</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-landingpage-layout>