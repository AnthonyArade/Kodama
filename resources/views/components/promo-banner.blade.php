@if ($promos)
    <div class="relative w-full overflow-hidden">
        <div class="flex w-fit animate-slide gap-6 py-2">
            @foreach ($promos as $promo)
                <div class="flex-none">
                    <div
                        class="relative isolate flex items-center gap-x-6 overflow-hidden bg-{{ $promo->type }} px-6 py-2.5 rounded-xl">
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
                            <p class="text-sm text-gray-100">
                                <strong class="font-semibold">{{ $promo->title }}</strong>
                                <svg viewBox="0 0 2 2" aria-hidden="true" class="mx-2 inline size-0.5 fill-current">
                                    <circle r="1" cx="1" cy="1" />
                                </svg>
                                {{ $promo->content }}
                                @if ($promo->title == 'Maintenance')
                                    {{ $promo->start_date->format('H:i') }} à {{ $promo->end_date->format('H:i') }}
                                @else
                                    {{ $promo->end_date->format('d/m/Y') }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
