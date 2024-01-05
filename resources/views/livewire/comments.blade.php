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
            @if($editingCommentId === $comment->id)
            <form class="mb-6" wire:submit.prevent="updateComment">
                @csrf
                <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <label for="CommentToEdit" class="sr-only">Your comment</label>
                    <textarea rows="6"
                        class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                        placeholder="Write a comment..." required
                        id="CommentToEdit" 
                        name="CommentToEdit"
                        wire:model="editingCommentBody"></textarea>
                </div>
                <p class="text-pink-500 text-x5 mt-2 font-semibold">@error('CommentToEdit') {{ $message }} @enderror</p>
                <button type="submit"
                    class="inline-flex items-center py-2.5 px-4 text-xs text-center font-semibold text-white bg-pink-600 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Update comment
                </button>
            </form>
            @else
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
                @auth
                    @if(auth()->user()->id == $comment->user->id)
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
                                    wire:click="deleteComment({{$comment->id}})"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                    Remove
                                </p>
                            </li>
                            <li>
                                <p href="#" 
                                    wire:click="editComment({{$comment->id}})"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                    Edit
                                </p>
                            </li>
                        </ul>
                    </div>
                    @endif
                @endauth
          </footer>
          <p class="text-gray-500 dark:text-gray-400">{{$comment->body}}</p>
          <div class="flex items-center mt-4 space-x-4">
      </article>
      @endif
      @endforeach

    </div>
</div>
</section>
