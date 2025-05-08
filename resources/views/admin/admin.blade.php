@extends('layouts.master')

@section('body')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

<style>
    #dt-length-0 {
        padding-right: 2rem
    }
</style>

<body>

<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
</button>
 
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-[#F0F8FF]">
        <a href="#" class="flex justify-center items-center ps-2.5">
            <img src="{{ asset('img/fil-global-dark-logo.png') }}" class="h-20" alt="Flowbite Logo" />
        </a>
        <div class="flex justify-center mb-3">
            <div class="relative w-25 h-25 overflow-hidden bg-gray-100 rounded-full">
                <img src="{{ asset('agent-pics/'.$agent->profile_picture) }}" alt="">
            </div>
        </div>
        <div class="flex justify-center">
            <div class="text-xl font-medium">
                {{ $agent->agent_name }}
            </div>
        </div>
        <div class="flex justify-center mb-5">
            <div class="text-sm font-medium text-gray-500">
                Pathway Consultant
            </div>
        </div>
        <div class="flex justify-center mb-3">
            <a href="{{ route('adminLogout') }}" class="text-[#3B82F6] bg-transparent border hover:bg-blue-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-300 rounded-full text-xs px-6 py-1 text-center">Logout</a>
        </div>

        <div class="flex justify-between mt-8 mb-4">
            <div class="text-xs font-medium">
                Confirmed Meetings
            </div>
            <a class="text-xs font-light cursor-pointer text-gray-600">
                View All
            </a>
        </div>

        <div id="confirmedMeetings"></div>
    </div>
</aside>
 
<div class="p-10 sm:ml-64">
    <div class="flex-row text-2xl text-center font-bold my-3">
        Appointments
    </div>
    <div class="pb-10">
        <form class="max-w-lg mx-auto" id="searchForm">
            <div class="flex shadow-lg">
                <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only">Country</label>
                <button id="dropdown-button" data-dropdown-toggle="dropdown" class="w-30 shrink-0 z-10 inline-flex items-center justify-center py-2.5 px-2 text-sm font-medium text-center text-white bg-[#06064E] border border-gray-300 rounded-s-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" type="button">
                    <div id="country-label">Country</div>
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-button">
                        
                    </ul>
                </div>
                <div class="relative w-full">
                    <input type="search" id="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300" placeholder="Search..." required />
                    <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-[#06064E] rounded-e-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="flex flex-row pb-10">
        <div class="w-full bg-white rounded-2xl shadow-xl border border-gray-100">
            <div class="p-10">
                <div class="flex flex-row justify-between items-end pb-3">
                    <div class="text-2xl font-bold">
                        Your appointments
                    </div>
                    <a href="#" class="text-sm text-blue-700">
                        Archives
                    </a>
                </div>
                <div class="">
                    <table id="pendingAppointmentsTable" class="display whitespace-nowrap">
                        <thead class="bg-[#E2DFFF] text-sm">
                            <tr class="text-sm">
                                <th>No.</th>
                                <th>Client Name</th>
                                <th>Date and Time</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Purpose</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                        </tbody>
                    </table>
                    <!-- Accept Appointment Modal -->
                    <div id="acceptAppointentModal" class="fixed z-60 inset-0 flex backdrop-blur-xs items-center justify-center hidden">
                        <form id="acceptAppointmentModalForm" method="POST" action="{{ route('approveAppointment') }}">
                            @csrf
                            <div class="bg-white p-6 rounded-3xl shadow-lg w-100">
                                <div id="acceptModalHeader" class="flex items-center justify-between pb-3">
                                    <h2 class="text-lg font-bold">Approve Booking</h2>
                                    <div>
                                        <button id="closeAcceptAppointmentModal" type="button" class="text-gray-400 bg-transparent cursor-pointer hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                </div>
                                <div id="modalAcceptFormContent" class="pb-3"></div>
                                <div class="flex justify-end gap-3">
                                    <button id="cancelAcceptAppointmentModal" type="button" class="w-30 bg-white border border-[#06064E] hover:bg-gray-100 cursor-pointer text-[#06064E] font-medium  px-4 py-2 rounded-full">CANCEL</button>
                                    <button id="approveAppointmentModal" type="submit" class="w-30 bg-green-600 hover:bg-green-800 cursor-pointer text-white font-medium px-4 py-2 rounded-full">APPROVE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Reject Appointment Modal -->
                    <div id="rejectAppointentModal" class="fixed z-60 inset-0 flex backdrop-blur-xs items-center justify-center hidden">
                        <form id="appointmentModalForm" method="POST" action="{{ route('rejectAppointment') }}">
                            @csrf
                            <div class="bg-white p-6 rounded-3xl shadow-lg w-100">
                                <div id="acceptModalHeader" class="flex items-center justify-between pb-3">
                                    <h2 class="text-lg font-bold">Reject Booking</h2>
                                    <div>
                                        <button id="closeAppointmentModal" type="button" class="text-gray-400 bg-transparent cursor-pointer hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                </div>
                                <div id="modalRejectFormContent" class="pb-3"></div>
                                <div class="flex justify-end gap-3">
                                    <button id="cancelRejectAppointmentModal" type="button" class="w-30 bg-white border border-[#06064E] hover:bg-gray-100 cursor-pointer text-[#06064E] font-medium  px-4 py-2 rounded-full">CANCEL</button>
                                    <button id="approveAppointmentModal" type="submit" class="w-30 bg-green-600 hover:bg-green-800 cursor-pointer text-white font-medium px-4 py-2 rounded-full">APPROVE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-row pb-20">
        <div class="w-full bg-white rounded-2xl shadow-xl border border-gray-100">
            <div class="p-10">
                <h2 class="text-2xl font-bold mb-4">Calendar</h2>
                <div class="flex flex-col lg:flex-row">
                    {{-- Side Calendar --}}
                    <div class="p-4 border-r border-gray-200 flex justify-center lg:block">
                        <div class="w-64 bg-white p-4 rounded-lg shadow-md">
                            <div class="flex justify-between items-center mb-4">
                                <h3 id="monthYear" class="text-lg font-semibold"></h3>
                                <div>
                                    <button id="prevMonth" class="px-2 py-1 text-gray-600 cursor-pointer">
                                        <svg class="w-3 h-3 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
                                        </svg>
                                    </button>
                                    <button id="nextMonth" class="px-2 py-1 text-gray-600 cursor-pointer">
                                        <svg class="w-3 h-3 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 13 5.7-5.326a.909.909 0 0 0 0-1.348L1 1"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="grid grid-cols-5 text-center text-gray-500 font-semibold mb-2">
                            </div>
                            <div id="calendarDays" class="grid grid-cols-5 gap-2 text-center"></div>
                        </div>
                    </div>

                    {{-- Calendar Modal --}}
                    <div id="calendarModal" class="fixed z-80 inset-0 flex backdrop-blur-xs items-center justify-center hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg md:w-120 m-5">
                            <div class="flex items-center justify-between pb-3">
                                <h2 id="calendarTitle" class="text-2xl font-bold">Block your schedule</h2>
                                <button id="closeCalendarModal" type="button" class="text-gray-400 bg-transparent cursor-pointer hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <div class="mt-4">
                                <div class="flex flex-row mb-3">
                                    <div class="w-1/4">
                                        Date Format:
                                    </div>
                                    <div class="w-3/4">
                                        <input id="singleDayRadio" type="radio" checked name="default-radio" class="w-4 h-4 text-blue-900 bg-gray-100 border-gray-300 focus:ring-blue-900" onclick="toggleForm('singleDay')">
                                        <label for="singleDayRadio" class="text-sm text-gray-900 pe-2">Single Day</label>
                                        <input id="dateRangeRadio" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-900 bg-gray-100 border-gray-300 focus:ring-blue-900" onclick="toggleForm('dateRange')">
                                        <label for="dateRangeRadio" class="text-sm text-gray-900">Date Range</label>
                                    </div>                                            
                                </div>

                                {{-- Single Day Form --}}
                                <form id="singleDayForm" class="singleDayForm" method="POST" action="{{ route('singleDayBlock') }}">
                                    @csrf
                                    <div class="flex flex-row mb-3">
                                        <div class="w-1/4">
                                            Date:
                                        </div>
                                        <div class="w-3/4">
                                            <input type="date" name="calendar-date" id="calendar-date" class="block text-sm text-gray-900 bg-transparent p-1 rounded-lg border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />                            
                                        </div>                                            
                                    </div>
                                    <div class="flex flex-row mb-3">
                                        <div class="w-1/4">
                                            Time:
                                        </div>
                                        <div class="w-3/4">
                                            <div class="flex flex-wrap gap-2">
                                                <div>
                                                    <input id="s-checkbox-8am" type="checkbox" value="08:00:00" name="times[]" class="hidden peer s-time-checkbox">
                                                    <label for="s-checkbox-8am" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        8:00 AM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="s-checkbox-9am" type="checkbox" value="09:00:00" name="times[]" class="hidden peer s-time-checkbox">
                                                    <label for="s-checkbox-9am" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        9:00 AM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="s-checkbox-10am" type="checkbox" value="10:00:00" name="times[]" class="hidden peer s-time-checkbox">
                                                    <label for="s-checkbox-10am" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        10:00 AM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="s-checkbox-11am" type="checkbox" value="11:00:00" name="times[]" class="hidden peer s-time-checkbox">
                                                    <label for="s-checkbox-11am" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        11:00 AM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="s-checkbox-1pm" type="checkbox" value="13:00:00" name="times[]" class="hidden peer s-time-checkbox">
                                                    <label for="s-checkbox-1pm" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        1:00 PM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="s-checkbox-2pm" type="checkbox" value="14:00:00" name="times[]" class="hidden peer s-time-checkbox">
                                                    <label for="s-checkbox-2pm" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        2:00 PM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="s-checkbox-3pm" type="checkbox" value="15:00:00" name="times[]" class="hidden peer s-time-checkbox">
                                                    <label for="s-checkbox-3pm" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        3:00 PM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="s-checkbox-4pm" type="checkbox" value="16:00:00" name="times[]" class="hidden peer s-time-checkbox">
                                                    <label for="s-checkbox-4pm" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        4:00 PM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="s-select-all" type="checkbox" value="s-select-all" name="times[]" class="hidden peer s-time-checkbox">
                                                    <label for="s-select-all" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        SELECT ALL
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-row mb-3">
                                        <div class="w-1/4">
                                            Reason:
                                        </div>
                                        <div class="w-3/4">
                                            <textarea id="s-reason" name="s-reason" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-900 focus:border-blue-900" placeholder="Write your reason here..." required></textarea>
                                        </div>                                            
                                    </div>
                                    <div class="flex">
                                        <button id="block-single-day" type="submit" class="text-white bg-red-700 cursor-pointer hover:bg-red-900 focus:ring-2 focus:outline-none focus:ring-blue-900 font-medium rounded-full text-xs w-35 py-3 text-center">
                                            BLOCK SCHEDULE
                                        </button>
                                    </div>
                                </form>

                                {{-- Date Range Form --}}
                                <form id="dateRangeForm" class="dateRangeForm hidden" method="POST" action="{{ route('rangeBlock') }}">
                                    @csrf
                                    <div class="flex flex-row mb-3">
                                        <div class="w-1/4">
                                            Start Date:
                                        </div>
                                        <div class="w-3/4">
                                            <input type="date" name="start-date" id="start-date" class="block text-sm text-gray-900 bg-transparent p-1 rounded-lg border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                        </div>
                                    </div>
                                    <div class="flex flex-row mb-3">
                                        <div class="w-1/4">
                                            End Date:
                                        </div>
                                        <div class="w-3/4">
                                            <input type="date" name="end-date" id="end-date" class="block text-sm text-gray-900 bg-transparent p-1 rounded-lg border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                        </div>
                                    </div>
                                    <div class="flex flex-row mb-3">
                                        <div class="w-1/4">
                                            Time:
                                        </div>
                                        <div class="w-3/4">
                                            <div class="flex flex-wrap gap-2">
                                                <div>
                                                    <input id="r-checkbox-8am" type="checkbox" value="08:00:00" name="times[]" class="hidden peer r-time-checkbox">
                                                    <label for="r-checkbox-8am" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        8:00 AM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="r-checkbox-9am" type="checkbox" value="09:00:00" name="times[]" class="hidden peer r-time-checkbox">
                                                    <label for="r-checkbox-9am" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        9:00 AM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="r-checkbox-10am" type="checkbox" value="10:00:00" name="times[]" class="hidden peer r-time-checkbox">
                                                    <label for="r-checkbox-10am" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        10:00 AM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="r-checkbox-11am" type="checkbox" value="11:00:00" name="times[]" class="hidden peer r-time-checkbox">
                                                    <label for="r-checkbox-11am" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        11:00 AM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="r-checkbox-1pm" type="checkbox" value="13:00:00" name="times[]" class="hidden peer r-time-checkbox">
                                                    <label for="r-checkbox-1pm" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        1:00 PM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="r-checkbox-2pm" type="checkbox" value="14:00:00" name="times[]" class="hidden peer r-time-checkbox">
                                                    <label for="r-checkbox-2pm" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        2:00 PM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="r-checkbox-3pm" type="checkbox" value="15:00:00" name="times[]" class="hidden peer r-time-checkbox">
                                                    <label for="r-checkbox-3pm" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        3:00 PM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="r-checkbox-4pm" type="checkbox" value="16:00:00" name="times[]" class="hidden peer r-time-checkbox">
                                                    <label for="r-checkbox-4pm" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        4:00 PM
                                                    </label>
                                                </div>
                                                <div>
                                                    <input id="r-select-all" type="checkbox" value="r-select-all" name="times[]" class="hidden peer r-time-checkbox">
                                                    <label for="r-select-all" class="flex items-center justify-center p-2 bg-gray-100 rounded-lg text-xs font-medium text-gray-900 cursor-pointer transition-all duration-300 peer-checked:border-gray-300 peer-checked:bg-blue-900 peer-checked:text-white">
                                                        SELECT ALL
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-row mb-3">
                                        <div class="w-1/4">
                                            Reason:
                                        </div>
                                        <div class="w-3/4">
                                            <textarea id="r-reason" name="r-reason" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-900 focus:border-blue-900" placeholder="Write your reason here..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <button id="block-range" type="submit" class="text-white bg-red-700 cursor-pointer hover:bg-red-900 focus:ring-2 focus:outline-none focus:ring-blue-900 font-medium rounded-full text-xs w-35 py-3 text-center">
                                            BLOCK SCHEDULE
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Weekly Schedules --}}
                    <div class="w-full overflow-x-auto ps-3">
                        <div class="min-w-max">
                            <div class="flex flex-row w-full justify-between items-center">
                                <button id="prevWeek" class="cursor-pointer">
                                    <svg class="w-3 h-3 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
                                    </svg>
                                </button>
                                <div class="grid grid-cols-5 gap-4 text-center font-bold w-full" id="weekDays"></div>
                                <button id="nextWeek" class="cursor-pointer">
                                    <svg class="w-3 h-3 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 13 5.7-5.326a.909.909 0 0 0 0-1.348L1 1"/>
                                    </svg>
                                </button> 
                            </div>
                            <div class="grid grid-cols-5 gap-4 px-3" id="scheduleGrid"></div>
                        </div>
                    </div>

                    {{-- Timeslot Modal --}}
                    <div id="timeslotModal" class="fixed z-60 inset-0 flex backdrop-blur-xs items-center justify-center hidden">
                        <div class="bg-white p-6 rounded-3xl shadow-lg w-100">           
                            <div id="timeslotHeader" class="flex items-center justify-between pb-3">
                                <h2 id="timeslotDate" class="text-lg font-bold"></h2>
                                <div id="buttons" class="flex flex-row gap-1">
                                    <div id="headerDeleteButton" class="hidden">
                                        <button id="deleteBlockedSlotButton" class="text-white bg-red-600 cursor-pointer hover:bg-red-800 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            <span class="sr-only">Delete blocked timeslot</span>
                                        </button>
                                    </div>
                                    <div id="headerEditButton" class="hidden">
                                        <button id="editTimeslotButton" class="text-white bg-[#06064E] cursor-pointer hover:bg-blue-800 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>                                              
                                            <span class="sr-only">Edit timeslot</span>
                                        </button>
                                    </div>
                                    <div>
                                        <button id="closeTimeslotModal" type="button" class="text-gray-400 bg-transparent cursor-pointer hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="timeslotTitle"></div>
                            <div id="timeslotBody" class="p-3"></div>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div id="deleteConfirmationModal" class="fixed z-70 inset-0 flex backdrop-blur-xs items-center justify-center hidden">
                        <form id="deleteBlockedSlotForm" class="hidden" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="bg-white p-6 rounded-3xl shadow-lg w-100">
                                <h2 class="text-lg font-bold mb-4">Delete Blocked Schedule</h2>
                                <p class="mb-4">Are you sure you want to delete this blocked schedule?</p>
                                <div class="flex justify-center gap-5">
                                    <button id="cancelDelete" type="button" class="w-30 bg-white border border-[#06064E] hover:bg-gray-100 cursor-pointer text-gray-900 text-gray-800 px-4 py-2 rounded-full">NO</button>
                                    <button id="confirmDelete" type="submit" class="w-30 bg-[#06064E] hover:bg-blue-800 cursor-pointer text-white px-4 py-2 rounded-full">YES</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
</body>

<script>    
    $(document).ready(function() {
        $('#pendingAppointmentsTable').DataTable({
            processing: true,
            serverSide: false,
            scrollX: true,
            pagingType: 'simple_numbers',
            language: {
                paginate: {
                previous: `<svg class="w-3 h-3 cursor-pointer text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
                            </svg>`,  
                next: `<svg class="w-3 h-3 cursor-pointer text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 13 5.7-5.326a.909.909 0 0 0 0-1.348L1 1"/>
                        </svg>`,
                }
            },
            order: [
                [0, 'asc']
            ],
            ajax: {
                url: '{{ route("pendingAppointments") }}',
                dataSrc: function (json) {
                    return json;
                }
            },
            columns: [
                {
                    data: null,
                    type: 'string',
                    render: function (data, type, row, meta) {
                        return meta.row + 1; // Row number
                    }
                },
                { data: 'name' },
                { 
                    data: null,
                    render: function(data, type, row) {
                        // Format date (YYYY-MM-DD to DD-MM-YY)
                        let date = new Date(row.appointment_date);
                        let formattedDate = date.toLocaleDateString('en-GB', { 
                            day: '2-digit', month: '2-digit', year: '2-digit' 
                        });

                        // Format time (24-hour to 12-hour AM/PM)
                        let time = row.appointment_time;
                        let [hour, minute] = time.split(':');
                        let ampm = hour >= 12 ? 'PM' : 'AM';
                        hour = hour % 12 || 12; // Convert 24-hour to 12-hour format
                        let formattedTime = `${hour}:${minute} ${ampm}`;

                        return `${formattedDate} ${formattedTime}`;
                    }
                },
                { data: 'email' },
                { data: 'contact', type: 'string' },
                { data: 'appointment_type' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <button id="acceptPendingModal" class="rounded-full bg-green-300 cursor-pointer p-0.5" data-id="${row.id}" data-link="${row.meeting_link}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                            <button id="rejectPendingModal" class="rounded-full bg-red-300 cursor-pointer p-0.5" data-id="${row.id}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                        `;
                    }
                }
            ]
        });

        $(document).on('click', '#acceptPendingModal', function() {
            // Get data attributes of the clicked button
            let id = $(this).data('id');
            let meetingLink = $(this).data('link');

            // Populate the modal with the appointment data
            $('#modalAcceptFormContent').html(`
                <input type="hidden" id="appointmentId" name="appointmentId" value="${id}">
                <input type="text" id="meetingLink" name="meetingLink" value="${meetingLink}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Meeting Link" required />
            `);

            // Show the modal
            $('#acceptAppointentModal').removeClass('hidden');

            $('#closeAcceptAppointmentModal, #cancelAcceptAppointmentModal').on('click', function() {
                $('#acceptAppointentModal').addClass('hidden');
            });
        });

        $(document).on('click', function(event) {
            if ($(event.target).is('#acceptAppointentModal')) {
                $('#acceptAppointentModal').addClass('hidden');
            }
        });

        $(document).on('click', '#rejectPendingModal', function() {
            // Get data attributes of the clicked button
            let id = $(this).data('id');
            // let meetingLink = $(this).data('link');

            // Populate the modal with the appointment data
            $('#modalRejectFormContent').html(`
                <input type="hidden" id="appointmentId" name="appointmentId" value="${id}">
                <input type="text" id="reason" name="reason" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Reason" required />
            `);

            // Show the modal
            $('#rejectAppointentModal').removeClass('hidden');

            $('#closeAppointmentModal, #cancelRejectAppointmentModal').on('click', function() {
                $('#rejectAppointentModal').addClass('hidden');
            });
        });

        $(document).on('click', function(event) {
            if ($(event.target).is('#rejectAppointentModal')) {
                $('#rejectAppointentModal').addClass('hidden');
            }
        });
    });

    document.getElementById('acceptAppointmentModalForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        fetch(form.getAttribute('action'), {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        });
    });

    document.getElementById('appointmentModalForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        fetch(form.getAttribute('action'), {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Denied',
                    text: data.message,
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        });
    });

    document.getElementById('singleDayForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        fetch(form.getAttribute('action'), {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Timeslots Blocked!',
                    text: data.message,
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        });
    });

    document.getElementById('dateRangeForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        fetch(form.getAttribute('action'), {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Timeslots Blocked!',
                    text: data.message,
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        let currentWeekOffset = 0;
        const weekDays = document.getElementById("weekDays");
        const scheduleGrid = document.getElementById("scheduleGrid");

        // Modal elements
        const timeslotModal = document.getElementById("timeslotModal");
        const timeslotTitle = document.getElementById("timeslotTitle");
        const timeslotDate = document.getElementById("timeslotDate");
        const timeslotBody = document.getElementById("timeslotBody");
        const closeTimeslotModal = document.getElementById("closeTimeslotModal");

        const headerDeleteButton = document.getElementById("headerDeleteButton");
        const headerEditButton = document.getElementById("headerEditButton");
        const editTimeslotButton = document.getElementById("editTimeslotButton");

        function fetchAppointments(offset) {
            currentWeekOffset = offset;
            fetch(`/admin/appointments?week=${offset}`)
                .then(response => response.json())
                // .then(data => updateWeekView(data))
                .then(data => {
                    updateWeekView(data);
                    updateConfirmedMeetings(data); // Update the confirmed meetings section
                })
                .catch(error => console.error("Error fetching appointments:", error));
        }

        function formatTime(time) {
            let [hour, minute] = time.split(":");
            let ampm = hour >= 12 ? "PM" : "AM";
            hour = hour % 12 || 12;
            return `${hour}:${minute} ${ampm}`;
        }

        function updateWeekView(data) {
            const startOfWeek = new Date();
            startOfWeek.setDate(startOfWeek.getDate() - startOfWeek.getDay() + 1 + (currentWeekOffset * 7));

            weekDays.innerHTML = "";
            scheduleGrid.innerHTML = "";

            for (let i = 0; i < 5; i++) {
                let currentDate = new Date(startOfWeek);
                currentDate.setDate(currentDate.getDate() + i);
                let formattedDate = currentDate.toISOString().split("T")[0];
                let [year, month, day] = formattedDate.split("-");
                let yearNum = Number(year);
                let monthNum = Number(month) - 1;
                let dayNum = Number(day);
                let readableDate = new Date(formattedDate).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });

                let dayColumn = document.createElement("div");
                dayColumn.innerHTML = `<h4 class="font-semibold uppercase">${currentDate.toLocaleDateString('en-US', { weekday: 'short' })}</h4>
                                    <span class="text-gray-600">${currentDate.getDate()}</span>`;
                weekDays.appendChild(dayColumn);

                let scheduleColumn = document.createElement("div");
                let times = ["08:00:00", "09:00:00", "10:00:00", "11:00:00", "13:00:00", "14:00:00", "15:00:00", "16:00:00"];

                times.forEach(time => {
                    let appointment = data.find(app => app.appointment_date === formattedDate && app.appointment_time === time);
                    let timeSlot = document.createElement("div");
                    timeSlot.className = "p-2 rounded-lg mt-2 text-center cursor-pointer";

                    if (appointment) {
                        if (appointment.status === "accepted") {
                            timeSlot.classList.add("border", "border-orange-400", "text-orange-400", "font-medium");
                            timeSlot.innerHTML = `${formatTime(time)} <br> Meeting`;
                        } else if (appointment.status === "blocked") {
                            timeSlot.classList.add("border", "border-red-600", "text-red-600", "font-medium");
                            timeSlot.innerHTML = `${formatTime(time)} <br> Blocked`;
                        } else {
                            timeSlot.classList.add("border", "border-green-500", "text-green-500", "font-medium");
                            timeSlot.innerHTML = `${formatTime(time)} <br> Available`;
                        }
                    } else {
                        timeSlot.classList.add("border", "border-green-500", "text-green-500", "font-medium");
                        timeSlot.innerHTML = `${formatTime(time)} <br> Available`;
                    }

                    // Make sure every slot is clickable
                    timeSlot.addEventListener("click", () => {
                        timeslotModal.classList.remove("hidden"); // Open modal

                        if (appointment) {
                            if (appointment.status === "accepted") {
                                timeslotDate.textContent = `${readableDate}`;
                                timeslotTitle.innerHTML = `
                                    <div class="flex flex-row justify-between w-full p-2 rounded-lg mt-2 text-center font-semibold border border-orange-400 text-orange-400">
                                        <div>${appointment.appointment_type}</div>
                                        <div>${formatTime(time)}</div>
                                    </div>
                                
                                `;
                                timeslotBody.innerHTML = `
                                    <div class="grid grid-cols-2">
                                        <div>Name:</div>
                                        <div class="break-words">${appointment.name}</div>
                                        <div>Email:</div>
                                        <div class="break-words">${appointment.email}</div>
                                        <div>Purpose:</div>
                                        <div class="break-words">${appointment.appointment_type}</div>
                                        <div>Link:</div>
                                        <a href="${appointment.meeting_link}" target="_blank" class="underline text-blue-500 hover:text-blue-700 break-words">${appointment.meeting_link}</a>
                                        <div>Status:</div>
                                        <div class="break-words">${appointment.status}</div>
                                    </div>
                                `;
                            } else if (appointment.status === "blocked") {
                                timeslotDate.textContent = `${readableDate}`;
                                headerDeleteButton.classList.remove("hidden");
                                deleteBlockedSlotForm.action = `/admin/delete/${appointment.id}`;
                                
                                timeslotTitle.innerHTML = `
                                    <div class="flex flex-row justify-between w-full p-2 rounded-lg mt-2 text-center font-semibold border border-red-600 text-red-600">
                                        <div>Blocked</div>
                                        <div>${formatTime(time)}</div>
                                    </div>
                                `;
                                timeslotBody.innerHTML = `
                                    <div class="grid grid-cols-2">
                                        <div>Purpose:</div>
                                        <div class="break-words">${appointment.notes}</div>
                                    </div>
                                `;
                            } else {
                                timeslotDate.textContent = `${readableDate}`;
                                headerEditButton.classList.remove("hidden");
                                timeslotTitle.innerHTML = `
                                    <div class="flex flex-row justify-between w-full p-2 rounded-lg mt-2 text-center font-semibold border border-green-500 text-green-500">
                                        <div>Available</div>
                                        <div>${formatTime(time)}</div>
                                    </div>
                                `;
                            }
                        } else {
                            timeslotDate.textContent = `${readableDate}`;
                            headerEditButton.classList.remove("hidden");
                            headerEditButton.onclick = () => openModal(dayNum, monthNum, yearNum);
                            console.log(dayNum, monthNum, yearNum);
                            timeslotTitle.innerHTML = `
                                <div class="flex flex-row justify-between w-full p-2 rounded-lg mt-2 text-center font-semibold border border-green-500 text-green-500">
                                    <div>Available</div>
                                    <div>${formatTime(time)}</div>
                                </div>
                            `;
                            timeslotBody.innerHTML = `
                                <p>This is a time slot that's currently open on your schedule. If you're available, other employees may book this time to schedule an appointment with you.</p>
                            `;
                        }
                    });

                    scheduleColumn.appendChild(timeSlot);
                });

                scheduleGrid.appendChild(scheduleColumn);
            }
        }

        const deleteBlockedSlotButton = document.getElementById("deleteBlockedSlotButton");
        const deleteConfirmationModal = document.getElementById("deleteConfirmationModal");
        const deleteBlockedSlotForm = document.getElementById("deleteBlockedSlotForm");
        const cancelDelete = document.getElementById("cancelDelete");

        deleteBlockedSlotButton.addEventListener("click", function () {
            deleteConfirmationModal.classList.remove("hidden");
            deleteBlockedSlotForm.classList.remove("hidden");
        });

        cancelDelete.addEventListener("click", function () {
            deleteConfirmationModal.classList.add("hidden");
            deleteBlockedSlotForm.classList.add("hidden");
        });

        // Close modal when clicking outside
        deleteConfirmationModal.addEventListener("click", function (event) {
            if (event.target === deleteConfirmationModal) {
                deleteConfirmationModal.classList.add("hidden");
                deleteBlockedSlotForm.classList.add("hidden"); 
            }
        });

        // Close modal when button is clicked
        closeTimeslotModal.addEventListener("click", () => {
            timeslotModal.classList.add("hidden");
            headerDeleteButton.classList.add("hidden");
            headerEditButton.classList.add("hidden");
        });

        // Close modal when clicking outside
        timeslotModal.addEventListener("click", (e) => {
            if (e.target === timeslotModal) {
                timeslotModal.classList.add("hidden");
                headerDeleteButton.classList.add("hidden");
                headerEditButton.classList.add("hidden");
            }
        });

        document.getElementById("prevWeek").addEventListener("click", () => fetchAppointments(currentWeekOffset - 1));
        document.getElementById("nextWeek").addEventListener("click", () => fetchAppointments(currentWeekOffset + 1));

        fetchAppointments(0);

        function updateConfirmedMeetings(appointments) {
            const confirmedMeetingsContainer = document.getElementById("confirmedMeetings");
            confirmedMeetingsContainer.innerHTML = ''; // Clear current meetings

            const acceptedAppointments = appointments.filter(appointment => appointment.status === "accepted");

            if (acceptedAppointments.length === 0) {
                // If no accepted appointments, display a "No meeting for the week" message
                const noMeetingsMessage = document.createElement("div");
                noMeetingsMessage.className = "text-center text-gray-500";
                noMeetingsMessage.textContent = "No meeting for the week";
                confirmedMeetingsContainer.appendChild(noMeetingsMessage);
            } else {
                // If there are accepted appointments, display them
                acceptedAppointments.forEach(appointment => {
                    let meetingButton = document.createElement("button");
                    meetingButton.className = "flex flex-row px-2 items-center cursor-pointer hover:bg-[#E0FFFF] rounded-lg mb-3";
                    meetingButton.addEventListener("click", () => showConfirmedMeetingModal(appointment));

                    let date = new Date(appointment.appointment_date);
                    let formattedDate = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
                    formattedDate = formattedDate.replace(/^\w+/, (match) => match.toUpperCase());
                    let formattedTime = formatTime(appointment.appointment_time);

                    meetingButton.innerHTML = `
                        <div class="bg-green-200 font-bold h-20 w-13 text-sm text-center border-0 rounded-2xl shadow-xl border px-3 py-5 border-gray-100">
                            ${formattedDate}
                        </div>
                        <div class="ms-3 text-start">
                            <div class="text-sm">${formattedTime}</div>
                            <div class="text-sm">Meeting with ${appointment.name}</div>
                        </div>
                    `;

                    confirmedMeetingsContainer.appendChild(meetingButton);
                });
            }
        }

        function showConfirmedMeetingModal(appointment) {
            timeslotModal.classList.remove("hidden"); // Open the modal

            let readableDate = new Date(appointment.appointment_date).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });

            // Set modal content based on the appointment data
            timeslotDate.textContent = `${readableDate}`;
            timeslotTitle.innerHTML = `
                <div class="flex flex-row justify-between w-full p-2 rounded-lg mt-2 text-center font-semibold border border-orange-400 text-orange-400">
                    <div>${appointment.appointment_type}</div>
                    <div>${formatTime(appointment.appointment_time)}</div>
                </div>
            `;
            
            timeslotBody.innerHTML = `
                <div class="grid grid-cols-2">
                    <div>Name:</div>
                    <div class="break-words">${appointment.name}</div>
                    <div>Email:</div>
                    <div class="break-words">${appointment.email}</div>
                    <div>Purpose:</div>
                    <div class="break-words">${appointment.appointment_type}</div>
                    <div>Link:</div>
                    <div class="break-words">${appointment.meeting_link}</div>
                    <div>Status:</div>
                    <div class="break-words">${appointment.status}</div>
                </div>
            `;
        }
    });

    document.getElementById('deleteBlockedSlotForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        fetch(form.getAttribute('action'), {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted Blocked Schedule',
                    text: data.message,
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        });
    });

    // Side Calendar
    function generateCalendar(year, month) {
        const calendarDays = document.getElementById('calendarDays');
        const monthYear = document.getElementById('monthYear');

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        const today = new Date();
        const isCurrentMonth = today.getFullYear() === year && today.getMonth() === month;
        const todayDate = today.getDate();

        monthYear.textContent = new Date(year, month).toLocaleString('default', { month: 'long', year: 'numeric' });

        calendarDays.innerHTML = '';

        let offset = firstDay === 0 ? 6 : firstDay - 1;
        if (offset >= 5) offset = 0;

        for (let i = 0; i < offset; i++) {
            calendarDays.innerHTML += '<div></div>';
        }

        for (let day = 1; day <= daysInMonth; day++) {
            let currentDay = new Date(year, month, day).getDay();
            if (currentDay >= 1 && currentDay <= 5) {
                let isToday = isCurrentMonth && day === todayDate;
                let bgColor = isToday ? "bg-purple-300" : "bg-purple-100";

                calendarDays.innerHTML += `<div class='w-8 h-8 flex items-center justify-center text-black ${bgColor} rounded-full cursor-pointer' onclick='openModal(${day}, ${month}, ${year})'>${day}</div>`;
            }
        }
    }

    let today = new Date();
    let currentYear = today.getFullYear();
    let currentMonth = today.getMonth();

    generateCalendar(currentYear, currentMonth);

    document.getElementById('prevMonth').addEventListener('click', () => {
        if (currentMonth === 0) {
            currentMonth = 11;
            currentYear--;
        } else {
            currentMonth--;
        }
        generateCalendar(currentYear, currentMonth);
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        if (currentMonth === 11) {
            currentMonth = 0;
            currentYear++;
        } else {
            currentMonth++;
        }
        generateCalendar(currentYear, currentMonth);
    });

    function openModal(day, month, year) {
        const formattedMonth = String(month + 1).padStart(2, '0'); // month + 1 because months are 0-based
        const formattedDay = String(day).padStart(2, '0'); // pad day to two digits if needed
        document.getElementById("calendar-date").value = `${year}-${formattedMonth}-${formattedDay}`;
        document.getElementById("start-date").value = `${year}-${formattedMonth}-${formattedDay}`;
        document.getElementById("calendarModal").classList.remove("hidden");
    }

    document.getElementById("closeCalendarModal").addEventListener("click", () => {
        document.getElementById("calendarModal").classList.add("hidden");

        document.getElementById("singleDayForm").reset();
        document.getElementById("dateRangeForm").reset();
    });

    document.getElementById("calendarModal").addEventListener("click", (e) => {
        if (e.target === document.getElementById("calendarModal")) {
            document.getElementById("calendarModal").classList.add("hidden");

            document.getElementById("singleDayForm").reset();
            document.getElementById("dateRangeForm").reset();
        }
    });

    function toggleForm(formType) {
        // Hide both forms initially
        document.getElementById('singleDayForm').classList.add('hidden');
        document.getElementById('dateRangeForm').classList.add('hidden');

        // Show the selected form
        if (formType === 'singleDay') {
            document.getElementById('singleDayForm').classList.remove('hidden');
        } else if (formType === 'dateRange') {
            document.getElementById('dateRangeForm').classList.remove('hidden');
        }
    }

    // Ensure single day form is visible by default
    window.onload = function() {
        toggleForm('singleDay');
    };

    // Single Day
    const singleAllCheckbox = document.getElementById('s-select-all');
    const singleCheckboxes = document.querySelectorAll('.s-time-checkbox');

    singleAllCheckbox.addEventListener('change', (event) => {
        // Toggle all time checkboxes based on Select All checkbox state
        singleCheckboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });

    singleCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const singleAllChecked = [...singleCheckboxes].every(checkbox => checkbox.checked);
            singleAllCheckbox.checked = singleAllChecked;
        });
    });

    // Date Range
    const rangeAllCheckbox = document.getElementById('r-select-all');
    const rangeCheckboxes = document.querySelectorAll('.r-time-checkbox');

    rangeAllCheckbox.addEventListener('change', (event) => {
        // Toggle all time checkboxes based on Select All checkbox state
        rangeCheckboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });

    rangeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const rangeAllChecked = [...rangeCheckboxes].every(checkbox => checkbox.checked);
            rangeAllCheckbox.checked = rangeAllChecked;
        });
    });

    // Function to validate the date range
    function validateDateRange() {
        const startDate = document.getElementById("start-date").value;
        const endDate = document.getElementById("end-date").value;

        // Check if the end date is earlier than the start date
        if (startDate && endDate && new Date(endDate) < new Date(startDate)) {
            Swal.fire({
                icon: 'warning',
                title: 'End date cannot be before the start date.',
            });
            document.getElementById("end-date").value = "";
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }

    // Add event listener to the end date input field
    document.getElementById("end-date").addEventListener("change", function() {
        validateDateRange();
    });
</script>
    
@endsection