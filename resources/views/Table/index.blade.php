<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teams and Games!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container flex justify-center mx-auto">
                        <div class="flex flex-col">
                            <div class="w-full">
                                @foreach($weeklyTables as $week)
                                <div class="border-b border-gray-200 shadow">
                                    <h1 class="">Leauge Table</h1>
                                    <br>
                                    <table>
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-2 py-2 text-xs text-gray-500">
                                                #
                                            </th>
                                            <th class="px-8 py-2 text-xs text-gray-500">
                                                Teams
                                            </th>
                                            <th class="px-2 py-2 text-xs text-gray-500">
                                                PTS
                                            </th>
                                            <th class="px-2 py-2 text-xs text-gray-500">
                                                P
                                            </th>
                                            <th class="px-2 py-2 text-xs text-gray-500">
                                                W
                                            </th>
                                            <th class="px-2 py-2 text-xs text-gray-500">
                                                D
                                            </th>
                                            <th class="px-2 py-2 text-xs text-gray-500">
                                                L
                                            </th>
                                            <th class="px-2 py-2 text-xs text-gray-500">
                                                GD
                                            </th>
                                        </tr>
                                        </thead>
                                        @foreach($week as $table)
                                        <tbody class="bg-white">
                                            <tr class="whitespace-nowrap">
                                                <td class="px-2 py-4 text-sm text-gray-500">
                                                    {{$table->team_id}}
                                                </td>
                                                <td class="px-8 py-4">
                                                    <div class="text-sm text-gray-900">
                                                        {{$table->team_name}}
                                                    </div>
                                                </td>
                                                <td class="px-2 py-4">
                                                    <div class="text-sm text-gray-500">
                                                        {{ $table->pts }}
                                                    </div>
                                                </td>
                                                <td class="px-2 py-4">
                                                    <div class="text-sm text-gray-500">
                                                        {{ $table->p }}
                                                    </div>
                                                </td>
                                                <td class="px-2 py-4">
                                                    <div class="text-sm text-gray-500">
                                                        {{ $table->w }}
                                                    </div>
                                                </td>
                                                <td class="px-2 py-4">
                                                    <div class="text-sm text-gray-500">
                                                        {{ $table->d }}
                                                    </div>
                                                </td>
                                                <td class="px-2 py-4">
                                                    <div class="text-sm text-gray-500">
                                                        {{ $table->l }}
                                                    </div>
                                                </td>
                                                <td class="px-2 py-4">
                                                    <div class="text-sm text-gray-500">
                                                        {{ $table->gd }}
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="px-5 py-4 ml-4">
                            @foreach($weeklyFixtures as $week)
                                <h1>Fixtures: </h1>
                                @foreach($week as $fixture)
                                    <h3>{{$fixture->week}}. Week</h3>
                            <table>
                                <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        {{$fixture->home_team_name}}
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        {{$fixture->home_score}} - {{$fixture->away_score}}
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        {{$fixture->away_team_name}}
                                    </th>
                                </tr>

                                </thead>
                                @endforeach
                            </table>

                            @endforeach
                        </div>
                    </div>

                    <a href="{{route('teams.next_week')}}" class="px-4 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                        Play Next Week
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
