<div>
@include('_partials._search')

<!-- component -->
<div class="flex items-center justify-center">
    <div class="container mx-auto p-4">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-4">
        
        @foreach ($exhibitions as $exhibition)

        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" wire:key={{ $exhibition->id }}>
            <a href="/exhibition/{{$exhibition->id}}">
                @php
                    $imageSource = (str_starts_with($exhibition->thumbnail_image, 'https://')) 
                    ? $exhibition->thumbnail_image 
                    : asset('storage/' . $exhibition->thumbnail_image);
                @endphp

                 <img class="rounded-t-lg h-auto w-96" 
                 src= {{  $imageSource  }}
                 alt="" />
            </a>
            <div class="p-5">
                <a href="/exhibition/{{$exhibition->id}}">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$exhibition->title}}</h5>
                </a>
                <p class="mb-3 text-sm text-gray-700 dark:text-gray-400 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                    </svg>                      
                    @if($exhibition->end_date)
                        {{$exhibition->start_date}} - {{$exhibition->end_date}}
                    @else
                        {{$exhibition->start_date}}
                    @endif
                </p>
                <p class="mb-3 text-sm text-gray-700 dark:text-gray-400 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                      </svg>
                      {{$exhibition->museum}}, {{$exhibition->location}}
                </p>
                <p>
                    <x-exhibition-tags :tagsCsv="$exhibition->tags" />
                </p>
            </div>
        </div>
        
        @endforeach
        <div x-data="{
            observe(){
                const observer = new IntersectionObserver((exhibitions) => {
                    exhibitions.forEach(exhibition => {
                        if(exhibition.isIntersecting){
                            @this.loadMore()
                        }
                    })
                })
                observer.observe(this.$el)
            }
        }" x-init="observe"></div>
      </div>
    </div>
  </div>
</div>