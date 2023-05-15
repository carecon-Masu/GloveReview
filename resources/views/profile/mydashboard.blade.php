<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('自身のレビュー一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <form action="{{ route('comments.create') }}" method="GET">
                    @csrf
                    <button type="submit" class="bg-white hover:bg-blue-700 hover:text-white text-gray-900 font-semibold py-2 px-4 rounded shadow-md">
                        {{ __('レビュー投稿') }}
                    </button>
                </form>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($comments as $comment)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                        @php
                            $imagePath = $comment->image ? asset('storage/images/comments/' . $comment->image) : asset('storage/images/comments/noimage.jpeg');
                        @endphp
                        <img src="{{ $imagePath }}" alt="{{ $comment->manufacturer }}" class="w-full object-cover h-96">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $comment->manufacturer }}</h3>
                            <div>
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $comment->recommends ? 'text-yellow-500 dark:text-yellow-300' : 'text-gray-400 dark:text-gray-600' }}" aria-hidden="true">&#9733;</span>
                                @endfor
                            </div>
                            <div class="flex items-center justify-between mt-4">
                                @php
                                    $hasLiked = $comment->likes()->where('user_id', Auth::id())->exists();
                                    $likeButtonClass = $hasLiked ? 'text-indigo-700 hover:text-indigo-400' : 'text-gray-400 hover:text-gray-700';
                                @endphp

                                <button class="{{ $likeButtonClass }} toggle-like-button" data-comment-id="{{ $comment->id }}">
                                    @if ($hasLiked)
                                        <x-iconsax-bol-like-1 class="w-6 h-6" />
                                    @else
                                        <x-iconsax-bul-like-1 class="w-6 h-6" />
                                    @endif
                                </button>

                                <form action="{{ route('comments.show', $comment) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="bg-gray-200 hover:bg-blue-700 hover:text-white font-bold py-2 px-4 rounded">
                                        {{ __('レビュー詳細') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $comments->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    <!-- JavaScriptの記述 -->
    <script>
        // いいねボタンのクリックイベントを監視
        const toggleLikeButtons = document.querySelectorAll('.toggle-like-button');
        toggleLikeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const commentId = this.getAttribute('data-comment-id');
                toggleLike(commentId);
            });
        });

        // いいねの状態を切り替える関数
        function toggleLike(commentId) {
            fetch(`/comments/${commentId}/toggleLike`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRFトークンの追加
                },
                body: JSON.stringify({
                    commentId: commentId
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
                // いいねが追加または削除された後の処理を記述

                // ボタンの表示を更新
                const likeButton = document.querySelector(`.toggle-like-button[data-comment-id="${commentId}"]`);
                if (likeButton) {
                    likeButton.classList.toggle('text-indigo-700', data.liked);
                    likeButton.classList.toggle('text-gray-400', !data.liked);
                }
            })
            .catch(error => {
                console.error('エラーが発生しました', error);
            });
        }
    </script>
</x-app-layout>
