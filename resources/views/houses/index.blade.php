@extends('layout')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-orange-600 leading-tight">
            {{ __('Houses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-orange-600">Houses</h1>
                <a href="{{ route('houses.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded-lg shadow hover:bg-orange-700">
                    Add New House
                </a>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="table-auto w-full text-left border-collapse">
                    <thead class="bg-orange-500 text-white">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($houses as $house)
                            <tr class="border-b hover:bg-orange-100">
                                <td class="px-4 py-2 text-gray-800">{{ $house->id }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $house->houseName }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route('houses.edit', $house->id) }}" 
                                           class="bg-orange-400 text-white px-3 py-1 rounded-lg hover:bg-orange-500">
                                            Edit
                                        </a>
                                        <!-- Delete Button -->
                                        <form action="{{ route('houses.destroy', $house->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')" 
                                                    class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- No Houses Found -->
            @if($houses->isEmpty())
                <p class="text-center text-gray-500 mt-6">No houses found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
@endsection
