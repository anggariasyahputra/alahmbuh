<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Leaderboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <select class="p-3 w-full text-sm leading-5 rounded border-0 shadow text-slate-600"
                        wire:model="quiz_id">
                        <option value="0">All quizzes</option>
                        @foreach ($quizzes as $quiz)
                            <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                        @endforeach
                    </select>
                    <table class="table mt-4 w-full table-view">
                        <thead>
                            <tr>
                                <th class="bg-blue-100 px-6 py-3 text-left w-9"></th>
                                <th class="bg-blue-200 px-6 py-3 text-left w-1/2">
                                    <span
                                        class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Username</span>
                                </th>
                                <th class="bg-blue-300 px-6 py-3 text-left">
                                    <span
                                        class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Badge</span>
                                </th>
                                <th class="bg-blue-200 px-6 py-3 text-left">
                                    <span
                                        class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Quiz</span>
                                </th>
                                <th class="bg-blue-100 px-6 py-3 text-left">
                                    <span
                                        class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Correct
                                        answers</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tests as $test)
                                <tr @class([
                                    // Variasi warna biru muda/tua berdasarkan urutan
                                    'bg-blue-50' => $loop->iteration % 2 == 1,
                                    'bg-blue-200' => $loop->iteration % 2 == 0,
                                    'bg-blue-400' => auth()->check() && $test->user->name == auth()->user()->name,
                                ])>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        {{ $test->user->name }}
                                     </td>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
    @if ($loop->iteration == 1)
        <img src="{{ asset('images/badge_gold.png') }}" alt="Gold Badge" class="w-6 h-6">
    @elseif ($loop->iteration == 2)
        <img src="{{ asset('images/badge_silver.png') }}" alt="Silver Badge" class="w-6 h-6">
    @elseif ($loop->iteration == 3)
        <img src="{{ asset('images/badge_bronze.png') }}" alt="Bronze Badge" class="w-6 h-6">
    @else
        <p class="text-gray-500"></p>
    @endif
</td>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        {{ $test->quiz->title }}
                                    </td>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        {{ $test->result }} /
                                        {{ $test->quiz->questions_count }}
                                        (time:
                                        {{ sprintf('%.2f', $test->time_spent / 60) }}
                                        minutes)
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No results.</td>
                                </tr>
                            @endforelse
                            {{-- @forelse ($users as $user)
                                @foreach ($user->tests as $test)
                                    <tr @class([
                                        'bg-gray-100' => auth()->check() && $user->name == auth()->user()->name,
                                    ])>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $user->name }}
                                        </td>

                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $test->quiz->title }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $test->result }} /
                                            {{ $test->quiz->questions_count }}
                                            (time:
                                            {{ sprintf('%.2f', $test->time_spent / 60) }}
                                            minutes)
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="3">No results.</td>
                                </tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
