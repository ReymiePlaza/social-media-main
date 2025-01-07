<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight bg-blue-600 py-4 text-center rounded-t-lg">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-sky-300 to-sky-500 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card for the post creation and display section -->
            <div class="bg-white shadow-2xl rounded-lg p-6 border-4 border-blue-400">

                <!-- Welcome message for the logged-in user -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-blue-400">Welcome, {{ Auth::user()->name }}!</h1>
                </div>

                <!-- Create a New Post Button -->
                <div class="text-center mb-8">
                    <a href="{{ url('posts/index.html') }}" class="px-8 py-4 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-full shadow-lg transform hover:scale-110 transition duration-300 ease-in-out">
                        CREATE YOUR NEW POST!!
                    </a>
                </div>

                <!-- Logout Button -->
                <div class="text-center mb-8">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-8 py-4 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-full shadow-lg transform hover:scale-110 transition duration-300 ease-in-out">
                            Logout
                        </button>
                    </form>
                </div>

                <!-- Your Posts Section Title -->
                <h3 class="text-2xl font-bold text-blue-400 mb-6 text-center">Your Posts</h3>

                <!-- Posts Display Section -->
                @if ($posts->isEmpty())
                    <p class="text-white text-center">No posts yet. Start sharing your thoughts!</p>
                @else
                    <div class="space-y-6">
                        @foreach ($posts as $post)
                            <!-- Post Card -->
                            <div class="bg-sky-400 p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out border-2 border-blue-400">
                                <div class="flex items-start">

                                    <!-- Post Content -->
                                    <div class="flex-1">
                                        <p class="text-white text-lg mb-2">{{ $post->content }}</p>
                                        <div class="text-blue-200 text-sm mb-2">
                                            <small>By <span class="font-bold">{{ $post->user->name }}</span> on {{ $post->created_at->format('d-m-Y H:i') }}</small>
                                        </div>

                                        <!-- Action Buttons (like, comment, etc.) -->
                                        <div class="flex items-center space-x-4 mt-2">
                                            <button class="px-4 py-2 bg-blue-500 text-white font-bold rounded-full shadow-md hover:bg-blue-600 hover:scale-110 transition duration-300 ease-in-out" title="Like">
                                                Like
                                            </button>

                                            <button class="px-4 py-2 bg-blue-500 text-white font-bold rounded-full shadow-md hover:bg-blue-600 hover:scale-110 transition duration-300 ease-in-out" title="Comment">
                                                Comment
                                            </button>

                                            <!-- Share Button -->
                                            <button class="px-4 py-2 bg-blue-500 text-white font-bold rounded-full shadow-md hover:bg-blue-600 hover:scale-110 transition duration-300 ease-in-out" title="Share">
                                                Share
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
