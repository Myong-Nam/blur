
<section class="text-gray-700 body-font overflow-hidden bg-white">
    <div class="container px-5 py-12 mx-auto">
        <div class="lg:w-4/5 mx-auto flex flex-wrap flex-col">
            <h1 class="text-2xl font-extrabold">Edit Exhibition</h1>
            <p>Please edit exhibition information.</p>

    <form class="mt-12 w-2/3" wire:submit.prevent="updateExhibition()">
    @csrf
    {{-- Category --}}
    <div class="mb-6">
        <label for="form.type_id" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
          Category
        </label>
          <select 
            id="form.type_id" 
            name="form.type_id"
            wire:model="form.type_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500">
            <option>Choose a category</option>
            @foreach($types as $type)
            @if ($type->id === $form->type_id)
            <option value={{$type->id}} selected>{{$type->name}}</option>
            @else
            <option value={{$type->id}}>{{$type->name}}</option>
            @endif
            
            @endforeach
          </select>
        @error('form.type_id')
        <x-warning-message :message=$message />
        @enderror
    </div>

    {{-- Title --}}
    <div class="mb-6">
      <label for="form.title" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Title</label>
      <input 
        value="{{$form->title}}" 
        wire:model="form.title" 
        type="text" 
        id="form.title" 
        name="title" 
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" 
        placeholder="Title of the exhibition"
      >
      @error('form.title')
      <x-warning-message :message=$message />
      @enderror
    </div>

    {{-- Description
    <div class="mb-6">
      <label for="description" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Description</label>
      <textarea id="description" name="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500">
        {{$exhibition->description}}
      </textarea>
      @error('description')
      <x-warning-message :message=$message />      
      @enderror
    </div>

    {{-- thumbnail image --}}
    {{-- <div class="mb-6">
        <label for="thumbnail_image" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Poster Image</label>
        @if ($exhibition->thumbnail_image != null)
        <img class="mb-3 lg:w-1/2 w-full object-cover object-center rounded border border-gray-200" src="{{  asset('storage/'.$exhibition->thumbnail_image) }}" >
        @endif
        <input id="thumbnail_image" name="thumbnail_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file">
        {{-- <div class="mt-1 text-sm text-gray-500 dark:text-gray-300">A profile picture is useful to confirm your are logged into your account</div> --}}    
        {{-- @error('thumbnail_image')
        <x-warning-message :message=$message />      
        @enderror
    </div>  --}}

    {{-- dates --}}
    {{-- <div class="mb-6">
        <label for="start_date" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Date</label>
        <div date-rangepicker class="flex items-center">
            <div class="relative">
                <input value="{{$exhibition->start_date}}" name="start_date" id="start_date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" placeholder="Select date start">
            </div>
            <span class="mx-4 text-gray-500">to</span>
            <div class="relative">
                <input value="{{$exhibition->end_date}}" name="end_date" id="end_date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" placeholder="Select date end">
            </div>
        </div>
        @error('start_date')
        <x-warning-message :message=$message />
        @enderror
        @error('end_date')
        <x-warning-message :message=$message />
        @enderror
    </div> --}}

    {{-- location--}}
    {{-- <div class="mb-6">
        <label for="location" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Location</label>
        <input value="{{$exhibition->location}}" type="text" id="location" name="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" placeholder="Location of the exhibition">
        @error('location')
        <x-warning-message :message=$message />
        @enderror
    </div> --}}

    {{-- tags--}}
    {{-- <div class="mb-6">
        <label for="tags" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Tags</label>
        <input value="{{$exhibition->tags}}" type="text" id="tags" name="tags" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" placeholder="Comma seperated">
        @error('tags')
        <x-warning-message :message=$message />
        @enderror
    </div> --}}

      <button
      type="submit"
      class="mt-4 text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800"
      >
          Save
      </button>
    </form>

  </div>
    </div>
</section>

<script>
  document.querySelector('#form.type_id').addEventListener('change', function(e) {
    alert(e.target.value);
});
</script>