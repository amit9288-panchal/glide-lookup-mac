@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Registered MAC Addresses</h1>

        <form method="GET" action="{{ route('macs.index') }}" class="mb-4">
            <input
                type="text"
                name="search"
                placeholder="Search by MAC address (eg: 5c:e9:1e:8f:8c:72)"
                value="{{ $search }}"
                class="border p-2 rounded w-full"
            />
        </form>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-100 text-left text-sm font-semibold">
                <tr>
                    <th class="p-4">Assigned MAC</th>
                    <th class="p-4">Organization Name</th>
                    <th class="p-4">Registered AT</th>
                </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                @forelse ($macs as $mac)
                    <tr class="border-b">
                        <td class="p-4">{{ $mac->assignment }}</td>
                        <td class="p-4">{{ $mac->organization_name }}</td>
                        <td class="p-4">{{ $mac->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">No results found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $macs->links() }}
        </div>
    </div>
@endsection
