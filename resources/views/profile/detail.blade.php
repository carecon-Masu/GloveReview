<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('マイページ') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('Profile') }}</h3>
                <a href="{{ route('profile.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('アカウント編集') }}</a>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg mb-8">
                <div class="p-6">
                    <div class="mb-4">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Name') }}</h4>
                        <p class="text-gray-700 dark:text-gray-300">{{ $user->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Email') }}</h4>
                        <p class="text-gray-700 dark:text-gray-300">{{ $user->email }}</p>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('性別') }}</h4>
                        <p class="text-gray-700 dark:text-gray-300">{{ $user->gender === 0 ? '男性' : '女性' }}</p>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('野球歴') }}</h4>
                        <p class="text-gray-700 dark:text-gray-300">{{ $user->experience }}</p>
                    </div>
 
                </div>
            </div>
        </div>    

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('自身のレビュー一覧') }}</h3>
                    @forelse ($comments as $comment)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg h-52">
                            <img src="{{ asset('storage/images/comments/' . $comment->image) }}" alt="{{ $comment->manufacturer }}" class="w-full h-32 object-cover">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $comment->manufacturer }}</h3>
                                <div>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $comment->recommends)
                                            <span class="text-yellow-500 dark:text-yellow-300" aria-hidden="true">&#9733;</span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-600" aria-hidden="true">&#9733;</span>
                                        @endif
                                    @endfor
                                </div>
                                <div class="flex items-center justify-between mt-4">
                                    @php
                                        $hasLiked = $comment->likes()->where('user_id', Auth::id())->exists();
                                    @endphp
                                    @if ($hasLiked)
                                        <form action="{{ route('comments.toggleLike', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            {{ __('Liked') }}
                                        </button>
                                        </form>
                                    @else
                                        <form action="{{ route('comments.toggleLike', $comment->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-gray-200 hover:bg-blue-700 hover:text-white font-bold py-2 px-4 rounded">
                                            {{ __('Like') }}
                                        </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('comments.show', $comment) }}" class="text-blue-600 hover:text-blue-700">
                                        {{ __('View Details') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>{{ __('レビューがありません') }}</p>
                    @endforelse
                    {{ $comments->links() }}
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('自身のいいね一覧') }}</h3>
                    <ul class="list-disc list-inside my-4">
                        @forelse ($likes as $like)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg h-52">
                            <img src="{{ asset('storage/images/comments/' . $comment->image) }}" alt="{{ $comment->manufacturer }}" class="w-full h-32 object-cover">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $comment->manufacturer }}</h3>
                                <div>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $comment->recommends)
                                            <span class="text-yellow-500 dark:text-yellow-300" aria-hidden="true">&#9733;</span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-600" aria-hidden="true">&#9733;</span>
                                        @endif
                                    @endfor
                                </div>
                            @if ($like->post)
                                <li>{{ $like->post->manufacturer}}</li>
                            @endif
                        @empty
                            <p>{{ __('いいねしたレビューがありません') }}</p>
                        @endforelse
                    </ul>
                    {{ $likes->links() }}
                </div>
            </div>
        </div>    
        <div class="mt-4">
            {{ $comments->links('pagination::tailwind') }}
        </div>
    </div>
</x-app-layout>
