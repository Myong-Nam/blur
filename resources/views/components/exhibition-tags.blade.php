@props(['tagsCsv'])

@php
    $tagsArray = explode(',', preg_replace('/\s*keywords:\s*/', '', $tagsCsv));
    $cleanedKeywords = array_map(function($keyword) {
        return preg_replace('/[\'"]/', '', $keyword);
    }, $tagsArray);
    
    $tags = array_map('strtolower', array_map('trim', $cleanedKeywords));

@endphp
<ul>
    @for ($i = 0; $i < 3; $i++)
        @isset($tags[$i])
        <li class="text-gray-600 text-xs font-medium mr-2 px-2.5">
            <a class="hover:text-purple-600" href="/?tag={{$tags[$i]}}">#{{$tags[$i]}}</a>
        </li>
        @endisset
    @endfor

    {{-- <li
        class="bg-black text-white rounded-xl px-3 py-1 mr-2"
    >
        <a href="/?tag={{$tag}}">{{$tag}}</a>
    </li> --}}
</ul>