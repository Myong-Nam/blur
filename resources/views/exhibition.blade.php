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
                <p class="ml-auto text-gray-600 font-semibold">{{$exhibition->user->name}}</p>
                <p class="ml-auto text-gray-600 text-sm">{{$exhibition->created_at->diffForHumans()}}</p>
                <div class="ml-auto flex items-center text-gray-600 text-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                      <path strokeLinecap="round" strokeLinejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                      <path strokeLinecap="round" strokeLinejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                  </svg>
                  {{$exhibition->views}}
              </div>
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
        <livewire:comments :exhibitionId="$exhibition->id" />
      </section>
    </x-app-layout>