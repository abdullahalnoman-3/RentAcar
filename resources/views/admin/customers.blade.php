<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer List') }}
        </h2>
   

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-200 px-4 py-2">Name</th>
                                <th class="border border-gray-200 px-4 py-2">Email</th>
                                <th class="border border-gray-200 px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td class="border border-gray-200 px-4 py-2">{{ $customer->name }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $customer->email }}</td>
                                    <td class="border border-gray-200 px-4 py-2">
                                        <button> <a class="btn btn-warning" href="">Edit</a></button> 
                                        <form action="" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </x-slot>
</x-app-layout>