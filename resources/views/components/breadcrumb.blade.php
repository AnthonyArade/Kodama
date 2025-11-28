<section class="bg-white py-4 border-b">
    <div class="container mx-auto px-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-gray-600" itemscope itemtype="https://schema.org/BreadcrumbList">

                @foreach ($items as $index => $item)
                    <li class="flex items-center" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        @if (!$loop->last && isset($item['url']))
                            <a href="{{ $item['url'] }}" class="hover:text-primary transition-colors" itemprop="item">
                                <span itemprop="name">{{ $item['name'] }}</span>
                            </a>
                        @else
                            <span class="text-primary font-medium" aria-current="page" itemprop="name">{{ $item['name'] }}</span>
                        @endif
                        <meta itemprop="position" content="{{ $index + 1 }}" />

                        @if (!$loop->last)
                            <!-- Separator -->
                            <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</section>
