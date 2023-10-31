@props(['tagsCsv'])

@php
    $tags = explode(',', $tagsCsv);    
@endphp
<ul class="flex">
    @for ($i = 0; $i < 3; $i++)
        @isset($tags[$i])
        <li class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">
            {{$tags[$i]}}
        </li>
        @endisset
    @endfor

    {{-- <li
        class="bg-black text-white rounded-xl px-3 py-1 mr-2"
    >
        <a href="/?tag={{$tag}}">{{$tag}}</a>
    </li> --}}
</ul>