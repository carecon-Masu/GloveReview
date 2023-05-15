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
    </div>
</x-app-layout>
