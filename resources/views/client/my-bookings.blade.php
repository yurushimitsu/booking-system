@extends('layouts.master')

@section('body')

@include('layouts.navbar')

<body style="background: linear-gradient(to right, #F9F8FF, #B3D6FD);">
    <div class="flex flex-col md:flex-row w-full min-h-90 justify-center text-center mt-30 mb-10 md:mt-40">
        <div class="md:w-1/2 border-r-[1.5px] border-gray-400">
            <div class="text-xl font-bold mb-5">
                Pending Appointments
            </div>
            <div class="flex flex-col items-center mb-10"> <!-- Center the loop content -->
                @forelse ($pendingBookings as $pending)
                    <div class="flex flex-row items-center bg-white md:w-90 px-5 py-3 rounded-3xl shadow-lg mb-5">
                        <div class="items-center justify-between">
                            <div class="bg-yellow-100 font-bold h-15 w-15 text-sm text-center flex items-center justify-center border-0 px-4 rounded-2xl shadow-xl border border-gray-100">
                                {{ \Carbon\Carbon::parse($pending->appointment_date)->format('M j') }}
                            </div>
                        </div>
                        <div class="ms-3 text-start">
                            <div class="text-sm">{{ \Carbon\Carbon::parse($pending->appointment_time)->format('g:i A') }}</div>
                            <div class="text-sm">Meeting with PC {{ $pending->agent_name }}</div>
                        </div>
                    </div>
                @empty
                    <p>No pending appointments</p>
                @endforelse
            </div>

            <div class="text-xl font-bold mb-5">
                Rejected Appointments
            </div>
            <div class="flex flex-col items-center mb-10"> <!-- Center the loop content -->
                @forelse ($rejectedBookings as $rejected)
                    <div class="flex flex-row items-center bg-white md:w-90 px-5 py-3 rounded-3xl shadow-lg mb-5">
                        <div class="items-center justify-between">
                            <div class="bg-red-100 font-bold h-15 w-15 text-sm text-center flex items-center justify-center border-0 px-4 rounded-2xl shadow-xl border border-gray-100">
                                {{ \Carbon\Carbon::parse($rejected->appointment_date)->format('M j') }}
                            </div>
                        </div>
                        <div class="ms-3 text-start">
                            <div class="text-sm">{{ \Carbon\Carbon::parse($rejected->appointment_time)->format('g:i A') }}</div>
                            <div class="text-sm">Meeting with PC {{ $rejected->agent_name }}</div>
                            <div class="text-sm">Reason: {{ $rejected->notes }}</div>
                        </div>
                    </div>
                @empty
                    <p>No rejected appointments</p>
                @endforelse
            </div>
        </div>
        <div class="md:w-1/2">
            <div class="text-xl font-bold mb-5">
                Approved Appointments
            </div>
            <div class="flex flex-col items-center"> <!-- Center the loop content -->
                @forelse ($approvedBookings as $approved)
                    <div class="flex flex-row items-center bg-white md:w-90 px-5 py-3 rounded-3xl shadow-lg mb-5">
                        <div class="items-center justify-between">
                            <div class="bg-green-200 font-bold h-15 w-15 text-sm text-center flex items-center justify-center border-0 px-4 rounded-2xl shadow-xl border border-gray-100">
                                {{ \Carbon\Carbon::parse($approved->appointment_date)->format('M j') }}
                            </div>
                        </div>
                        <div class="ms-3 text-start">
                            <div class="text-sm">{{ \Carbon\Carbon::parse($approved->appointment_time)->format('g:i A') }}</div>
                            <div class="text-sm">Meeting with PC {{ $approved->agent_name }}</div>
                            <div class="text-sm">Meeting Link: <a href="{{ $approved->meeting_link }}" target="_blank" class="text-blue-600 hover:text-blue-800 cursor-pointer underline break-words">{{ $approved->meeting_link }}</a></div>
                        </div>
                    </div>
                @empty
                    <p>No approved appointments</p>
                @endforelse
            </div>
        </div>
    </div>
</body>

@endsection