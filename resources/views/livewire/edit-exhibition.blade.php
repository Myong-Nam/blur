
<section class="text-gray-700 body-font overflow-hidden bg-white">
    <div class="container px-5 py-12 mx-auto">
        <div class="lg:w-4/5 mx-auto flex flex-wrap flex-col">
            <h1 class="text-2xl font-extrabold">Edit Exhibition</h1>
            <p>Please edit exhibition information.</p>

    <form class="mt-12 w-2/3" wire:submit.prevent="updateExhibition()">
    @csrf
    {{-- Category --}}
    <div class="mb-6">
        <label 
          for="form.type_id" 
          class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white"
          >
          Category
        </label>
          <select 
            id="form.type_id" 
            name="form.type_id"
            wire:model.live="form.type_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500">
            <option value="">Choose a category</option>
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
        wire:model.live="form.title" 
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

    {{-- Description --}}
    <div class="mb-6">
      <label for="form.description" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Description</label>
      <textarea
        wire:model.live="form.description"  
        id="form.description" 
        name="form.description" 
        rows="4" 
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
      >
        {{$form->description}}
      </textarea>
      @error('form.description')
      <x-warning-message :message=$message />      
      @enderror
    </div>

    {{-- thumbnail image --}}
    <div class="mb-6">
        <label for="thumbnail_image" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Poster Image</label>

        @php
          $imageSource = (str_starts_with($form->thumbnail_image, 'https://')) 
          ? $form->thumbnail_image 
          : asset('storage/' . $form->thumbnail_image);
        @endphp


        <div
        x-data="{ uploading: false, progress: 0 }"
        x-on:livewire-upload-start="uploading = true"
        x-on:livewire-upload-finish="uploading = false"
        x-on:livewire-upload-error="uploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
        >
        @if ($form->uploaded_thumbnail_image)
          <img 
          class="mb-3 lg:w-1/2 w-full object-cover object-center rounded border border-gray-200" 
          src="{{ $form->uploaded_thumbnail_image->temporaryUrl() }}" />
        @elseif ($form->thumbnail_image != null)
        <img 
          class="mb-3 lg:w-1/2 w-full object-cover object-center rounded border border-gray-200" 
          src="{{  $imageSource  }}" />
        @endif
        <input 
          wire:model="form.uploaded_thumbnail_image"  
          id="form.uploaded_thumbnail_image" 
          name="form.uploaded_thumbnail_image" 
          class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file"
          />
          <div x-show="uploading">
            <progress max="100" x-bind:value="progress"></progress>
          </div>
        @error('form.thumbnail_image')
        <x-warning-message :message=$message />      
        @enderror
    </div> 

    {{-- dates --}}
    <div class="mb-6">
        <label for="form.start_date" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Date</label>
        <div date-rangepicker class="flex items-center">
            <div class="relative">
                <input 
                wire:model.live="form.start_date"  
                value="{{$form->start_date}}" 
                name="form.start_date" 
                id="form.start_date" 
                type="date" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" placeholder="Select date start"
                >
            </div>
            <span class="mx-4 text-gray-500">to</span>
            <div class="relative">
                <input 
                wire:model.live="form.end_date"  
                value="{{$form->end_date}}" 
                name="form.end_date"
                 id="form.end_date" 
                 type="date" 
                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" placeholder="Select date end">
            </div>
        </div>
        @error('form.start_date')
        <x-warning-message :message=$message />
        @enderror
        @error('form.end_date')
        <x-warning-message :message=$message />
        @enderror
    </div>

    {{-- location--}}
    <div class="mb-6">
        <label for="form.location" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Location</label>
        <input 
        wire:model.live="form.location"  
        value="{{$form->location}}" 
        type="text" 
        id="form.location" 
        name="form.location" 
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" placeholder="Location of the exhibition">
        @error('form.location')
        <x-warning-message :message=$message />
        @enderror
    </div>

    {{-- tags --}}
     <div class="mb-6">
        <label for="tags" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Tags</label>
        <input 
        wire:model.live="form.tags" 
        value="{{$form->tags}}" 
        type="text" 
        id="form.tags" 
        name="form.tags" 
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" placeholder="Comma seperated">
        @error('form.tags')
        <x-warning-message :message=$message />
        @enderror
    </div> 

      <button
      type="submit"
      class="mt-4 text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800"
      >
          Save
      </button>
    </form>

  </div>
  <div
  x-data="{ show: @entangle('showSuccessMessage') }"
  x-show="show"
  x-transition:enter="transition ease-out duration-300"
  x-transition:enter-start="opacity-0 transform scale-90"
  x-transition:enter-end="opacity-100 transform scale-100"
  x-transition:leave="transition ease-in duration-300"
  x-transition:leave-start="opacity-100 transform scale-100"
  x-transition:leave-end="opacity-0 transform scale-90"
  class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
  id="alert-border-3"
  role="alert"
  style="display: none;"
  >
  <div class="ms-3 text-sm font-medium">
    {{ $successMessage }} You can check <a href="/exhibition/{{$exhibitionId->id}}" class="font-semibold underline hover:no-underline">here</a>.
  </div>
  <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" @click="show = false" aria-label="Close">
    <span class="sr-only">Dismiss</span>
    <!-- 닫기 아이콘 -->
  </button>
  </div>
    </div>

</section>





<script>
  document.querySelector('#form.type_id').addEventListener('change', function(e) {
    alert(e.target.value);
});
</script>