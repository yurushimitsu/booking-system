@extends('layouts.master')

@section('body')

@include('layouts.navbar')

<body style="background: linear-gradient(to right, #F9F8FF, #B3D6FD);">
    <div class="flex flex-col md:flex-row w-full min-h-90 justify-center text-center mt-30 mb-10 md:mt-40">
        <div class="w-full">
            <div class="text-xl font-bold mb-5">
                Past Bookings and Appointments
            </div>
            <div class="flex flex-col items-center"> <!-- Center the loop content -->
                @forelse ($approvedBookings as $approved)
                    <div class="flex flex-row items-center bg-white md:w-100 px-5 py-3 rounded-3xl shadow-lg mb-5">
                        <div class="items-center justify-between">
                            <div class="bg-green-200 font-bold h-15 w-15 text-sm text-center flex items-center justify-center border-0 px-4 rounded-2xl shadow-xl border border-gray-100">
                                {{ \Carbon\Carbon::parse($approved->appointment_date)->format('M j') }}
                            </div>
                        </div>
                        <div class="ms-3 text-start">
                            <div class="text-sm">{{ \Carbon\Carbon::parse($approved->appointment_time)->format('g:i A') }}</div>
                            <div class="text-sm">Meeting with PC {{ $approved->agent_name }}</div>
                            <a href="#" target="_blank" class="text-sm">Meeting Link: <span class="text-blue-600 hover:text-blue-800 cursor-pointer underline">{{ $approved->meeting_link }}</span></a>
                        </div>
                    </div>
                @empty
                    <!-- If no approved bookings, we proceed to check rejected bookings -->
                @endforelse

                @forelse ($rejectedBookings as $rejected)
                    <div class="flex flex-row items-center bg-white md:w-100 px-5 py-3 rounded-3xl shadow-lg mb-5">
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
                    <!-- If no rejected bookings, we proceed to the final check -->
                @endforelse

                <!-- Show the message if both approved and rejected bookings are empty -->
                @if($approvedBookings->isEmpty() && $rejectedBookings->isEmpty())
                    <p>No past bookings and appointments</p>
                @endif
            </div>
        </div>
    </div>
</body>

@endsection