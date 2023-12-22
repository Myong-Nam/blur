<x-app-layout>
    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="container px-5 py-24 mx-auto">
          <div class="lg:w-4/5 mx-auto flex flex-wrap">

            @php
              $imageSource = (str_starts_with($exhibition->thumbnail_image, 'https://')) 
              ? $exhibition->thumbnail_image 
              : asset('storage/' . $exhibition->thumbnail_image);
            @endphp
            <img class="w-full h-auto object-cover object-center rounded border border-gray-200" src="{{  $imageSource  }}" >
            <div class="w-full lg:pl-10 mt-6 ">
    
              <h2 class="text-sm title-font text-gray-500 tracking-widest">{{$exhibition->type->name}}</h2>
              <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{$exhibition->title}}</h1>
              <div class="flex mb-3 ">
                <span class="flex items-center">
                  <span class="text-gray-600">
                    @if ($exhibition->end_date ?? false)
                    {{$exhibition->start_date}} - {{$exhibition->end_date}}
                    @else
                    {{$exhibition->start_date}} 
                    @endif
                  </span>
                </span>
                <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
                  {{$exhibition->museum}}, {{$exhibition->location}}
                </span>
    
              </div>
              <div class="mb-3">
                <x-exhibition-tags :tagsCsv="$exhibition->tags" class="mb-3"/>
                </div>
              <p class="leading-relaxed">{{$exhibition->description}}</p>
    
              <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
              </div>
              <div class="flex flex-col">
                {{-- <span class="title-font font-medium text-2xl text-gray-900">$58.00</span> --}}
                <p class="ml-auto text-gray-600 font-semibold">{{$exhibition->user->name}}</p>
                <p class="ml-auto text-gray-600 text-sm">{{$exhibition->created_at->diffForHumans()}}</p>
    
                {{-- <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                  <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                  </svg>
                </button> --}}
    
              </div>
    
            </div>
            
            @if ($exhibition->user_id === auth()->id())
            <div class="mt-5 w-full flex flex-row-reverse">
              <form method="POST" action="{{ route('exhibition.destroy', $exhibition->id) }}" >
                @method('DELETE')
                @csrf
                <button type="submit" class="text-gray-700 hover:text-white border border-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-gray-400 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-500 dark:focus:ring-gray-900">
                  Delete
                </button>
              </form>
    
              <a href="{{ route('exhibition.edit', $exhibition->id) }}">
                <button type="button" class="text-purple-700 hover:text-white border border-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-purple-400 dark:text-purple-400 dark:hover:text-white dark:hover:bg-purple-500 dark:focus:ring-purple-900">
                  Edit
                </button>
              </a>
            </div>
             @endif
          </div>
          </div>
    
        </div>
        
      </section>
    </x-app-layout>