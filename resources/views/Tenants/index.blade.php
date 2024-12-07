@extends('layout')

@section('content')
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-4xl font-bold text-black">Tenants</h1>
            <input type="text" id="search" name="search" placeholder="Search by name" 
                   class="px-4 py-2 border border-purple-600 rounded-lg focus:ring-purple-600 focus:border-purple-600 w-1/2 bg-white text-black" 
                   value="{{ request()->get('search') }}">
            <a href="{{ route('tenants.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-500">
                Add Tenant
            </a>
        </div>

        <!-- Cards Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($tenants as $tenant)
                <!-- Card wrapper -->
                <div class="relative card border border-purple-600 rounded-lg shadow-lg overflow-hidden hover:scale-105 hover:shadow-2xl transition-all duration-300 ease-in-out">
                    <!-- Link wraps the card's content but not the action buttons -->
                    <a href="{{ route('tenants.balance', $tenant->id) }}" class="absolute inset-0 z-10"></a>

                    <div class="flex flex-col items-center p-4 bg-white relative z-0">
                        <!-- Tenant Image -->
                        <div class="w-32 h-32 mb-4">
                            @if($tenant->image)
                                <img src="{{ asset('storage/' . $tenant->image) }}" alt="Tenant Image" class="w-full h-full object-fill rounded-full">
                            @else
                                <span class="text-gray-500">No Image</span>
                            @endif
                        </div>

                        <!-- Tenant Info -->
                        <div class="text-center text-black">
                            <h3 class="text-xl font-bold">{{ $tenant->firstName }} {{ $tenant->lastName }}</h3>
                            <p class="text-sm">{{ $tenant->room->roomName ?? 'N/A' }}</p>
                            <p class="text-sm">{{ $tenant->email }}</p>
                            <p class="text-sm">{{ \Carbon\Carbon::parse($tenant->date_in)->format('F j, Y') }}</p> <!-- Format the date to show only the date -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- No Tenants Found -->
        @if($tenants->isEmpty())
            <p class="text-center text-gray-500 mt-6">No tenants found.</p>
        @endif
    </div>

    <script>
        // JavaScript for real-time search filtering
        document.getElementById('search').addEventListener('input', function() {
            let searchQuery = this.value.toLowerCase();
            let cards = document.querySelectorAll('.card');
            
            cards.forEach(card => {
                // Get the first name of the tenant (first letter only)
                let tenantFirstName = card.querySelector('h3').textContent.toLowerCase().split(' ')[0]; // Only compare the first name
                
                if (tenantFirstName.startsWith(searchQuery)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>
@endsection
