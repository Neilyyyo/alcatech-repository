<x-app-layout>
    <div class="py-12">
        <!-- Cards Section -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Total Payments (Monthly) Card (Clickable) -->
            <a href="{{ route('payments.index') }}" class="bg-white border border-purple-600 overflow-hidden shadow-sm sm:rounded-lg hover:scale-105 hover:shadow-2xl transition-all duration-300 ease-in-out">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold text-purple-600">Total Monthly Payments</h3>
                    <p class="mt-4 text-xl font-semibold text-gray-800">
                        ₱{{ number_format($totalPaymentsMonthly, 2) }}
                    </p>
                </div>
            </a>

            <!-- Total Tenants Card (Clickable) -->
            <a href="{{ route('tenants.index') }}" class="bg-white border border-purple-600 overflow-hidden shadow-sm sm:rounded-lg hover:scale-105 hover:shadow-2xl transition-all duration-300 ease-in-out">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold text-purple-600">Total Tenants</h3>
                    <p class="mt-4 text-xl font-semibold text-gray-800">
                        {{ $totalTenants }}
                    </p>
                </div>
            </a>

            <!-- Total Rooms Card (Clickable) -->
            <a href="{{ route('rooms.index') }}" class="bg-white border border-purple-600 overflow-hidden shadow-sm sm:rounded-lg hover:scale-105 hover:shadow-2xl transition-all duration-300 ease-in-out">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold text-purple-600">Total Rooms</h3>
                    <p class="mt-4 text-xl font-semibold text-gray-800">
                        {{ $totalRooms }}
                    </p>
                </div>
            </a>
        </div>

        <!-- Chart Section (Side-by-side Layout) -->
        <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Tenant Chart -->
            <div class="w-full">
                <canvas id="tenantChart" style="max-width: 600px; height: 400px; margin: 0 auto; border: 1px solid #D1D5DB;"></canvas>
            </div>

            <!-- Payment Chart -->
            <div class="w-full">
                <canvas id="paymentChart" style="max-width: 600px; height: 400px; margin: 0 auto; border: 1px solid #D1D5DB;"></canvas>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Pass the variables from Laravel to JavaScript
        var roomNames = @json($roomNames); // Ensure this variable is correctly passed from the controller
        var tenantCounts = @json($tenantCounts); // Ensure tenant counts are also passed
        var months = @json($months); // Array of months
        var totalPaymentsPerMonth = @json($totalPaymentsPerMonth); // Array of total payments for each month

        // Tenant Chart
        var tenantCtx = document.getElementById('tenantChart').getContext('2d');
        var tenantChart = new Chart(tenantCtx, {
            type: 'bar',
            data: {
                labels: roomNames,
                datasets: [{
                    label: 'Tenants Count',
                    data: tenantCounts,
                    backgroundColor: 'rgba(168, 85, 247, 0.4)', 
                    borderColor: 'rgba(168, 85, 247, 1)', 
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#4B5563'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#4B5563'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#4B5563'
                        }
                    }
                }
            }
        });

        // Payment Chart
        var paymentCtx = document.getElementById('paymentChart').getContext('2d');
        var paymentChart = new Chart(paymentCtx, {
            type: 'line', // Change to 'line' chart for payments
            data: {
                labels: months, // Months as labels
                datasets: [{
                    label: 'Total Payments',
                    data: totalPaymentsPerMonth, // Total payments for each month
                    fill: false,
                    borderColor: 'rgba(255, 99, 132, 1)', 
                    tension: 0.1,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#4B5563'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#4B5563'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#4B5563'
                        }
                    }
                }
            }
        });
    });
    </script>
</x-app-layout>
