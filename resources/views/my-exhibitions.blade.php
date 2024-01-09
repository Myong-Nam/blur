<x-app-layout>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 max-w-xs overflow-hidden">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Location
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Start Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        End Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created at
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Manage
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exhibitions as $exhibition)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white max-w-xs overflow-hidden">
                        {{$exhibition->title}}
                    </th>
                    <td class="px-6 py-4">
                        {{$exhibition->location}}
                    </td>
                    <td class="px-6 py-4">
                        {{$exhibition->start_date}}
                    </td>
                    <td class="px-6 py-4">
                        {{$exhibition->end_date}}
                    </td>
                    <td class="px-6 py-4">
                        {{$exhibition->created_at}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('exhibition.edit', $exhibition->id) }}">
                            <button type="button" class="text-purple-700 hover:text-white border border-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-purple-400 dark:text-purple-400 dark:hover:text-white dark:hover:bg-purple-500 dark:focus:ring-purple-900">
                              Edit
                            </button>
                        </a>
                        <form method="POST" action="{{ route('exhibition.destroy', $exhibition->id) }}" >
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-white border border-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-gray-400 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-500 dark:focus:ring-gray-900">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>






</x-app-layout>