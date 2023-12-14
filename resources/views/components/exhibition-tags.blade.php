@props(['tagsCsv'])

@php
    #remove string 'keywords'
    $tagsArray = explode(',', preg_replace('/\s*keywords:\s*/', '', $tagsCsv));
    #remove all the quotes 
    $cleanedKeywords = array_map(function($keyword) {
        return preg_replace('/[\'"]/', '', $keyword);
    }, $tagsArray);
    #convert into small case and trim the tags
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

</ul>