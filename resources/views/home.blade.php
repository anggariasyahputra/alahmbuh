<x-app-layout>
    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h6 class="text-xl font-bold">Public quizzes</h6>

                    @forelse($public_quizzes as $quiz)
                        <div class="px-4 py-2 w-full lg:w-6/12 xl:w-3/12">
                            <div
                                class="flex relative flex-col mb-6 min-w-0 break-words bg-white rounded shadow-lg xl:mb-0">
                                <div class="flex-auto p-4">
                                    <a href="{{ route('quiz.show', $quiz->slug) }}">{{ $quiz->title }}</a>
                                    <p class="text-sm">Questions: <span>{{ $quiz->questions_count }}</span></p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="mt-2">No public quizzes found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div> -->

    <div class="py-12 bg-[#005da4] min-h-screen"> <!-- Warna latar belakang utama -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-[#bdd2e2] overflow-hidden shadow-sm sm:rounded-lg"> <!-- Warna kontainer -->
            <div class="p-6 text-gray-900">
                <h6 class="text-xl font-bold">Quizzes for Registered Users</h6>

                <div class="flex flex-wrap">
                    @forelse($registered_only_quizzes as $quiz)
                        <div class="px-4 py-2 w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
                            <div class="flex flex-col mb-6 min-w-0 break-words rounded shadow
                                        {{ $loop->first ? 'bg-[#6dc0d5]' : 'bg-[#e5e9ee]' }}">
                                <div class="flex-auto p-4">
                                    <a href="{{ route('quiz.show', $quiz->slug) }}" class="font-semibold block text-center">
                                        {{ $quiz->title }}
                                    </a>
                                    <p class="text-sm text-center">Questions: <span>{{ $quiz->questions_count }}</span></p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="mt-2 text-white">No quizzes for registered users found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
