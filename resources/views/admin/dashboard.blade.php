<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        
                        
                        <!-- Cards Row -->
                        <div class="row my-4">
                            <!-- Card 1: Total Users -->
                            <div class="col-md-4">
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Users</h5>
                                        <p class="card-text display-4">5</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2: Total Orders -->
                            <div class="col-md-4">
                                <div class="card text-white bg-success mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Orders</h5>
                                        <p class="card-text display-4">10</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3: Pending Tasks -->
                            <div class="col-md-4">
                                <div class="card text-white bg-warning mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Pending Tasks</h5>
                                        <p class="card-text display-4">20</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cards Row 2 -->
                        <div class="row my-4">
                            <!-- Card 4: Total Revenue -->
                            <div class="col-md-4">
                                <div class="card text-white bg-info mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Revenue</h5>
                                        <p class="card-text display-4">$2000</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 5: Active Subscriptions -->
                            <div class="col-md-4">
                                <div class="card text-white bg-danger mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Active Subscriptions</h5>
                                        <p class="card-text display-4">300</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 6: Support Tickets -->
                            <div class="col-md-4">
                                <div class="card text-white bg-secondary mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Support Tickets</h5>
                                        <p class="card-text display-4">2</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
