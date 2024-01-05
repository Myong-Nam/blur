<section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
    <div class="max-w-2xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Comments ({{count($comments)}})</h2>
      </div>
      @auth
      <form class="mb-6" wire:submit.prevent="addComment; document.querySelector('#newComment').value=''; ">
        @csrf
          <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
              <label for="newComment" class="sr-only">Your comment</label>
              <textarea rows="6"
                  class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                  placeholder="Write a comment..." required
                  id="newComment" 
                  name="newComment" 
                  wire:model.live.lazy="newComment"></textarea>
          </div>
          <p class="text-pink-500 text-x5 mt-2 font-semibold">@error('newComment') {{ $message }} @enderror</p>
          <button type="submit"
              class="inline-flex items-center py-2.5 px-4 text-xs text-center font-semibold text-white bg-pink-600 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
              Post comment
          </button>
      </form>
      @endauth
      @foreach ($comments as $comment)
      <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900">
          <footer class="flex justify-between items-center mb-2 max-h-[20px]" 
          x-data="{ open: false }"
        class="relative"
          >
              <div class="flex items-center">
                  <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                    {{$comment->user->name}}</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400">
                    <time>{{$comment->created_at->diffForHumans()}}</time>
                 </p>
              </div>
              <button                     
                    x-on:click="open = true">
                  <svg x-show="!open" class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                      <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                  </svg>
                  <span class="sr-only">Comment settings</span>
              </button>
              <!-- Dropdown menu -->
              <div        
              x-show="open"
              x-on:click.away="open = false"
              class="flex flex-end"
                  >
                  <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                      <li>
                          <p href="#"
                          wire:click="remove({{$comment->id}})"
                              class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                      </li>
                  </ul>
              </div>
          </footer>
          <p class="text-gray-500 dark:text-gray-400">{{$comment->body}}</p>
          <div class="flex items-center mt-4 space-x-4">
              {{-- <button type="button"
                  class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                  <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                  </svg>
                  Reply
              </button>
          </div> --}}
      </article>
      @endforeach

    </div>
</div>
</section>
