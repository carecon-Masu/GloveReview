<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight py-4">
            {{ __('レビュー編集') }}
        </h2>
    </x-slot>

    <div class="flex justify-center">
        <div class="w-3/4 py-8">
            <form action="{{ route('comments.update', $comment) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($comment->image)
                    <div class="mb-4 flex">
                        <label class="font-bold dark:text-slate-50 w-36">現在の画像:</label>
                        <img src="{{ asset('storage/images/comments/' . $comment->image) }}" alt="Current Image" class="w-40 h-auto">
                    </div>
                @endif
                <div class="mb-4 flex">
                    <label for="image" class="font-bold dark:text-slate-50 w-36">グローブ画像:</label>
                    <input type="file" name="image" id="image" class="dark:text-slate-50 flex-1">
                </div>

                <div class="mb-4 flex">
                    <label for="manufacturer" class="font-bold dark:text-slate-50 w-36">メーカー:</label>
                    <input type="text" name="manufacturer" id="manufacturer" class="dark:text-gray-900 flex-1" value="{{ $comment->manufacturer }}">
                </div>

                <div class="mb-4 flex">
                    <label class="font-bold dark:text-slate-50 w-36">硬式・軟式:</label>
                    <div class="flex flex-1 items-center">
                        <div class="flex items-center">
                            <label for="event-0" class="mr-2 flex items-center">
                                <input type="radio" name="event" id="event-0" value="0" class="text-blue-500" {{ $comment->event == 0 ? 'checked' : '' }}>
                                <span class="dark:text-white">軟式</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label for="event-1" class="mr-2 flex items-center">
                                <input type="radio" name="event" id="event-1" value="1" class="text-blue-500" {{ $comment->event == 1 ? 'checked' : '' }}>
                                <span class="dark:text-white">硬式</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-4 flex">
                    <label class="font-bold dark:text-slate-50 w-36">左右利き手:</label>
                    <div class="flex flex-1 items-center">
                        <div class="flex items-center">
                            <label for="dominant_hand-0" class="mr-2">
                                <input type="radio" name="dominant_hand" id="dominant_hand-0" value="0" class="text-blue-500" {{ $comment->dominant_hand == 0 ? 'checked' : '' }}>
                                <span class="dark:text-white">右利き用</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label for="dominant_hand-1">
                                <input type="radio" name="dominant_hand" id="dominant_hand-1" value="1" class="text-blue-500" {{ $comment->dominant_hand == 1 ? 'checked' : '' }}>
                                <span class="dark:text-white">左利き用</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-4 flex">
                    <label for="model" class="font-bold dark:text-slate-50 w-36">モデル:</label>
                    <input type="text" name="model" id="model" class="dark:text-gray-900 flex-1"  value="{{ $comment->model }}">
                </div>

                <div class="mb-4 flex">
                    <label class="font-bold dark:text-slate-50 w-36">高校野球対応:</label>
                    <div class="flex flex-1">
                        <div class="flex items-center">
                            <label for="available-0" class="mr-2">
                                <input type="radio" name="available" id="available-0" value="0" class="text-blue-500" {{ $comment->available == 0 ? 'checked' : '' }}>
                                <span class="dark:text-white">非対応</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label for="available-1">
                                <input type="radio" name="available" id="available-1" value="1" class="dark:text-blue-500" {{ $comment->available == 1 ? 'checked' : '' }}>
                                <span class="dark:text-white">対応</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-4 flex">
                    <label class="font-bold dark:text-slate-50 w-36">現在販売:</label>
                    <div class="flex flex-1">
                        <div class="flex items-center">
                            <label for="sale-0" class="mr-2">
                                <input type="radio" name="sale" id="sale-0" value="0" class="dark:text-blue-500" {{ $comment->sale == 0 ? 'checked' : '' }}>
                                <span class="dark:text-white">販売停止</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <label for="sale-1">
                                <input type="radio" name="sale" id="sale-1" value="1" class="dark:text-blue-500" {{ $comment->sale == 1 ? 'checked' : '' }}>
                                <span class="dark:text-white">販売中</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-4 flex">
                    <label for="similar_products" class="font-bold dark:text-slate-50 w-36">類似品:</label>
                    <input type="text" name="similar_products" id="similar_products" class="dark:text-gray-900 flex-1"  value="{{ $comment->similar_products }}">
                </div>

                <div class="mb-4 flex">
                    <label for="store" class="font-bold dark:text-slate-50 w-36">購入場所:</label>
                    <input type="text" name="store" id="store" class="dark:text-gray-900 flex-1"  value="{{ $comment->store }}">
                </div>

                <div class="mb-4 flex">
                    <label class="font-bold dark:text-slate-50 w-36">オススメ:</label>
                    <div class="flex flex-1">
                        <input type="radio" name="recommends" id="recommends-1" value="1" class="hidden" {{ $comment->recommends == 1 ? 'checked' : '' }}>
                        <label for="recommends-1" class="star-label cursor-pointer text-3xl text-gray-400 dark:text-gray-600 {{ $comment->recommends >= 1 ? 'text-yellow-500' : 'text-gray-400' }} dark:{{ $comment->recommends >= 1 ? 'text-yellow-300' : 'text-gray-600' }}">&#9733;</label>
                        <input type="radio" name="recommends" id="recommends-2" value="2" class="hidden" {{ $comment->recommends == 2 ? 'checked' : '' }}>
                        <label for="recommends-2" class="star-label cursor-pointer text-3xl text-gray-400 dark:text-gray-600 {{ $comment->recommends >= 2 ? 'text-yellow-500' : 'text-gray-400' }} dark:{{ $comment->recommends >= 1 ? 'text-yellow-300' : 'text-gray-600' }}">&#9733;</label>
                        <input type="radio" name="recommends" id="recommends-3" value="3" class="hidden" {{ $comment->recommends == 3 ? 'checked' : '' }}>
                        <label for="recommends-3" class="star-label cursor-pointer text-3xl text-gray-400 dark:text-gray-600 {{ $comment->recommends >= 3 ? 'text-yellow-500' : 'text-gray-400' }} dark:{{ $comment->recommends >= 1 ? 'text-yellow-300' : 'text-gray-600' }}">&#9733;</label>
                        <input type="radio" name="recommends" id="recommends-4" value="4" class="hidden" {{ $comment->recommends == 4 ? 'checked' : '' }}>
                        <label for="recommends-4" class="star-label cursor-pointer text-3xl text-gray-400 dark:text-gray-600 {{ $comment->recommends >= 4 ? 'text-yellow-500' : 'text-gray-400' }} dark:{{ $comment->recommends >= 1 ? 'text-yellow-300' : 'text-gray-600' }}">&#9733;</label>
                        <input type="radio" name="recommends" id="recommends-5" value="5" class="hidden" {{ $comment->recommends == 5 ? 'checked' : '' }}>
                        <label for="recommends-5" class="star-label cursor-pointer text-3xl text-gray-400 dark:text-gray-600 {{ $comment->recommends >= 5 ? 'text-yellow-500' : 'text-gray-400' }} dark:{{ $comment->recommends >= 1 ? 'text-yellow-300' : 'text-gray-600' }}">&#9733;</label>
                    </div>
                </div>

                <div class="mb-4 flex">
                    <label for="free_review" class="font-bold dark:text-slate-50 w-36">フリーレビュー:</label>
                    <textarea name="free_review" id="free_review" class="dark:text-gray-900 flex-1 h-40 resize-y">{{ $comment->free_review }}</textarea>
                </div>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('comments.show', ['comment' => $comment]) }}" class="hover:bg-gray-600 hover:text-slate-50 text-gray-900 font-bold py-2 px-4 rounded shadow-md mr-4">
                    戻る
                </a>
                <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow-md mr-4" onclick="openModal()">
                    {{ __('レビュー削除') }}
                </button>
                <button type="submit" class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded shadow-md">
                    更新
                </button>
            </div>
            </form>
        </div>
    </div>
    <!-- モーダル -->
    <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="fixed inset-0 bg-gray-900 opacity-50"></div>
        <div class="bg-white rounded-lg p-8 z-0">
            <h2 class="text-xl font-semibold mb-4">{{ __('削除の確認') }}</h2>
            <p class="mb-8">{{ __('本当に削除しますか？') }}</p>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded shadow-md mr-4" onclick="closeModal()">
                    {{ __('キャンセル') }}
                </button>
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline-block">
                    @csrf
                    @method('POST')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow-md">
                        {{ __('削除') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>

    <script>
        const starLabels = document.querySelectorAll('.star-label');
        starLabels.forEach(label => {
            label.addEventListener('click', () => {
                const clickedValue = label.previousElementSibling.value;
                // クリックされた星より前の星に色を適用する
                starLabels.forEach(starLabel => {
                    const starValue = starLabel.previousElementSibling.value;
                    starLabel.classList.toggle('text-yellow-500', starValue <= clickedValue);
                    starLabel.classList.toggle('dark:text-yellow-300', starValue <= clickedValue);
                    starLabel.classList.toggle('text-gray-400', starValue > clickedValue);
                    starLabel.classList.toggle('dark:text-gray-600', starValue > clickedValue);
                });
            });
        });
    </script>
</x-app-layout>
