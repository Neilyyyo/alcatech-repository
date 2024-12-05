<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-orange-600 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card with white background and orange border -->
            <div class="bg-white border border-orange-500 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-xl">Welcome back, <span class="font-semibold text-orange-600">{{ auth()->user()->name }}</span>!</p>
                    <p class="mt-4 text-gray-700">You're logged in and ready to explore the features of your dashboard.</p>
                </div>
            </div>

            <!-- Optionally, you can add more sections below -->
            <div class="mt-8 bg-white border border-orange-500 rounded-lg p-6 shadow-lg">
                <h3 class="text-lg font-semibold text-orange-600 mb-4">Upcoming Tasks</h3>
                <ul class="list-disc list-inside text-gray-800">
                    <li>Task 1: Check notifications</li>
                    <li>Task 2: Review recent activity</li>
                    <li>Task 3: Explore the dashboard features</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
