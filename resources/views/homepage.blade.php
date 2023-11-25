<x-landingpage-layout>
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-10 lg:max-w-7xl lg:px-8">
            <div class="flex justify-between">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Pilihan Mobil Tersedia</h2>
                <div class="">Search</div>
            </div>
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($car as $item) 
                    <div class="group relative">
                        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                            <img src="{{ asset('storage/' . $item->image) }}" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                        </div>
                        <div class="mt-4">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href="{{ route('detail', ['car' => $item->id]) }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $item->title; }}
                                    </a>
                                </h3>
                            </div>
                            <div class="flex justify-between mt-4">
                                <p class="mt-1 text-sm text-gray-500">{{ $item->brand->brand_name }} | {{ $item->type->type_name }}</p>
                                <p class="text-sm font-medium text-gray-900">Rp {{ number_format($item->price,2,',','.') }} / Hari</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-landingpage-layout>


