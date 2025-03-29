@extends('layouts.master')

@section('body')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

<body>
    
<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
</button>
 
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-[#F0F8FF]">
        <a href="https://flowbite.com/" class="flex justify-center items-center ps-2.5">
            <img src="{{ asset('img/fil-global-dark-logo.png') }}" class="h-20" alt="Flowbite Logo" />
        </a>
        <div class="flex justify-center mb-3">
            <div class="relative w-25 h-25 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <svg class="absolute w-20 h-20 text-gray-400 right-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="text-xl font-medium">
                Name
            </div>
        </div>
        <div class="flex justify-center mb-5">
            <div class="text-sm font-medium text-gray-500">
                Pathway Consultant
            </div>
        </div>
        <div class="flex justify-center mb-3">
            <button type="button" class="text-[#3B82F6] bg-transparent border hover:bg-blue-800  focus:outline-none focus:ring-4 focus:ring-blue-300 rounded-full text-xs px-6 py-1 text-center">Logout</button>
        </div>

        <ul class="space-y-2 font-medium">
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Kanban</span>
                    <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full">Pro</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                    <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">3</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                    <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                </a>
            </li>
        </ul>
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
                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Date and Time</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Purpose</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sample 1</td>
                                <td>Sample 2</td>
                                <td>Sample 3</td>
                                <td>Sample 4</td>
                                <td>Sample 5</td>
                                <td>Sample 6</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-row pb-20">
        <div class="w-full bg-white rounded-2xl shadow-xl border border-gray-100">
            <div class="p-10">
                <h2 class="text-2xl font-bold mb-4">Calendar</h2>
                <div class="flex flex-col lg:flex-row">
                    <!-- Side Calendar -->
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

                    <!-- Modal -->
                    <div id="appointmentModal" class="fixed z-60 inset-0 flex items-center justify-center hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-100">           
                            <div class="flex items-center justify-between pb-3">
                                <h2 id="modalDate" class="text-lg font-bold"></h2>
                                <button id="closeModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <div id="modalTitle"></div>
                            <div id="modalBody" class="p-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
</body>

<script>    
    $(document).ready(function() {
        $('#example').DataTable();
    });

    document.addEventListener("DOMContentLoaded", function() {
    let currentWeekOffset = 0;
    const weekDays = document.getElementById("weekDays");
    const scheduleGrid = document.getElementById("scheduleGrid");

    // Modal elements
    const modal = document.getElementById("appointmentModal");
    const modalTitle = document.getElementById("modalTitle");
    const modalDate = document.getElementById("modalDate");
    const modalBody = document.getElementById("modalBody");
    const closeModal = document.getElementById("closeModal");

    function fetchAppointments(offset) {
        currentWeekOffset = offset;
        fetch(`/admin/appointments?week=${offset}`)
            .then(response => response.json())
            .then(data => updateWeekView(data))
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
                    modal.classList.remove("hidden"); // Open modal

                    if (appointment) {
                        if (appointment.status === "accepted") {
                            modalDate.textContent = `${readableDate}`;
                            modalTitle.innerHTML = `
                                <div class="flex flex-row justify-between w-full p-2 rounded-lg mt-2 text-center font-semibold border border-orange-400 text-orange-400">
                                    <div>${appointment.appointment_type}</div>
                                    <div>${formatTime(time)}</div>
                                </div>
                            
                            `;
                            modalBody.innerHTML = `
                                <div class="grid grid-cols-2">
                                    <div>Name:</div>
                                    <div class="break-words">${appointment.client_name}</div>
                                    <div>Email:</div>
                                    <div class="break-words">${appointment.client_email}</div>
                                    <div>Purpose:</div>
                                    <div class="break-words">${appointment.appointment_type}</div>
                                    <div>Status:</div>
                                    <div class="break-words">${appointment.status}</div>
                                </div>
                            `;
                        } else if (appointment.status === "blocked") {
                            modalDate.textContent = `${readableDate}`;
                            modalTitle.innerHTML = `
                                <div class="flex flex-row justify-between w-full p-2 rounded-lg mt-2 text-center font-semibold border border-red-600 text-red-600">
                                    <div>${appointment.appointment_type}</div>
                                    <div>${formatTime(time)}</div>
                                </div>
                            `;
                            modalBody.innerHTML = `
                                <div class="grid grid-cols-2">
                                    <div>Purpose:</div>
                                    <div class="break-words">${appointment.client_notes}</div>
                                </div>
                            `;
                        } else {
                            modalDate.textContent = `${readableDate}`;
                            modalTitle.innerHTML = `
                                <div class="flex flex-row justify-between w-full p-2 rounded-lg mt-2 text-center font-semibold border border-green-500 text-green-500">
                                    <div>Available</div>
                                    <div>${formatTime(time)}</div>
                                </div>
                            `;
                        }
                    } else {
                        modalDate.textContent = `${readableDate}`;
                        modalTitle.innerHTML = `
                            <div class="flex flex-row justify-between w-full p-2 rounded-lg mt-2 text-center font-semibold border border-green-500 text-green-500">
                                <div>Available</div>
                                <div>${formatTime(time)}</div>
                            </div>
                        `;
                        modalBody.innerHTML = `
                            <p>This is a time slot that's currently open on your schedule. If you're available, other employees may book this time to schedule an appointment with you.</p>
                        `;
                    }
                });

                scheduleColumn.appendChild(timeSlot);
            });

            scheduleGrid.appendChild(scheduleColumn);
        }
    }

    // Close modal when button is clicked
    closeModal.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    // Close modal when clicking outside
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.add("hidden");
        }
    });

    document.getElementById("prevWeek").addEventListener("click", () => fetchAppointments(currentWeekOffset - 1));
    document.getElementById("nextWeek").addEventListener("click", () => fetchAppointments(currentWeekOffset + 1));

    fetchAppointments(0); // Load current week on page load
});

    // Side Calendar
    function generateCalendar(year, month) {
        const calendarDays = document.getElementById('calendarDays');
        const monthYear = document.getElementById('monthYear');
        
        // First day of the month and total days in the month
        const firstDay = new Date(year, month, 1).getDay(); // 0 = Sun, 1 = Mon, ..., 6 = Sat
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Get today's date
        const today = new Date();
        const isCurrentMonth = today.getFullYear() === year && today.getMonth() === month;
        const todayDate = today.getDate();

        // Update the month-year label
        monthYear.textContent = new Date(year, month).toLocaleString('default', { month: 'long', year: 'numeric' });

        calendarDays.innerHTML = '';

        // Find the correct weekday index (Mon-Fri)
        let offset = firstDay === 0 ? 6 : firstDay - 1; // Convert Sunday (0) to Saturday (6) and shift accordingly
        if (offset >= 5) offset = 0; // Skip weekends

        // Create empty divs for alignment
        for (let i = 0; i < offset; i++) {
            calendarDays.innerHTML += '<div></div>';
        }

        // Loop through the days and add only Monday-Friday
        for (let day = 1; day <= daysInMonth; day++) {
            let currentDay = new Date(year, month, day).getDay(); // Get day of the week (0-6)
            if (currentDay >= 1 && currentDay <= 5) { // Only add Monday-Friday
                let isToday = isCurrentMonth && day === todayDate;
                let bgColor = isToday ? "bg-purple-300" : "bg-purple-100";

                calendarDays.innerHTML += `<div class='w-8 h-8 flex items-center justify-center text-black ${bgColor} rounded-full cursor-pointer'>${day}</div>`;
            }
        }
    }

    // Automatically set the calendar to the current month
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
</script>
    
@endsection