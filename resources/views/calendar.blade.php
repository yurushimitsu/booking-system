<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $agentName->agent_name }}'s Calendar</title>

    {{-- tailwind css --}}
    @vite('resources/css/app.css')

    {{-- flowbite --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    {{-- fullcalendar --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="flex items-center justify-center pt-10">
        <div class="text-2xl font-medium underline">
        {{ $agentName->agent_name }}'s Schedule
        </div>
    </div>
    <div class="m-10">
        <div id='calendar'></div>
        
        <!-- Main modal -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-[2px]">
            <div class="relative p-4 w-full max-w-xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                        <h3 id="modal-title" class="text-lg font-semibold text-gray-900"></h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center cursor-pointer" data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form id="bookAppointment" method="POST" data-action="{{ route('postAppointmentRequest') }}" class="p-4 md:p-5">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <input type="hidden" name="agentAccountNo" id="agentAccountNo">
                            <div class="col-span-2 sm:col-span-1">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Date</label>
                                <input type="date" name="appointmentDate" id="appointmentDate" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type fullname" readonly required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="appointmentTime" class="block mb-2 text-sm font-medium text-gray-900">Time</label>
                                <select name="appointmentTime" id="appointmentTime" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <option selected="">Select time</option>
                                    <option class="" value="09:00:00">9:00 AM</option>
                                    <option class="" value="10:00:00">10:00 AM</option>
                                    <option class="" value="11:00:00">11:00 AM</option>
                                    <option class="" value="12:00:00">12:00 PM</option>
                                </select>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Fullname</label>
                                <input type="text" name="name" id="name" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type fullname" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                <input type="email" name="email" id="email" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type email" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Contact Number</label>
                                <input type="text" name="contact" id="contact" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type contact number" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="agent" class="block mb-2 text-sm font-medium text-gray-900">Agent</label>
                                <input type="text" name="agent" id="agent" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ $agentName->agent_name }}" readonly placeholder="Type agent" required="">
                            </div>
                            <div class="col-span-2">
                                <label for="notes" class="block mb-2 text-sm font-medium text-gray-900">Notes</label>
                                <textarea name="notes" id="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write other notes here"></textarea>                    
                            </div>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button type="button" id="cancel" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 cursor-pointer">Cancel</button>
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var agentAccountNo = {{ $agentName->account_no }};
        var modal = document.getElementById('crud-modal');
        var modalContent = modal.querySelector('.relative.bg-white');

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'Asia/Manila',
            initialView: 'dayGridMonth',
            weekends: false,
            validRange: function(nowDate) {
                // var endDay = nowDate.setMonth(nowDate.getMonth() + 12);
                // var today = nowDate.setMonth(nowDate.getMonth() - 12);
                var tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1); // Only tomorrow's date is available for booking
                var endDay = new Date(); 
                endDay.setMonth(endDay.getMonth() + 6); // Limit calendar to 6 months 
                return {
                    start: tomorrow,
                    end: endDay,
                };
            },
            dateClick: function(info) {
                var date = info.dateStr;

                // Check if the selected date is fully booked before opening modal
                fetch(`/appointments/getAppointmentsForDate?date=${date}&agent_account_no=${agentAccountNo}`)
                    .then(response => response.json())
                    .then(appointments => {
                        if (appointments.length === 4) {
                            // If all 4 time slots (9-12) are booked, show an alert
                            Swal.fire({
                                icon: 'warning',
                                title: 'All time slots are booked',
                                text: 'Please select another date.',
                            });
                        } else {
                            // Proceed with booking modal if slots are available
                            var formattedDate = new Date(date);
                            var options = { year: 'numeric', month: 'long', day: 'numeric' };
                            var formattedDateString = formattedDate.toLocaleDateString('en-US', options);

                            $('#modal-title').html('Set booking on: ' + formattedDateString);
                            document.getElementById('appointmentDate').value = date;
                            document.getElementById('agentAccountNo').value = agentAccountNo;

                            document.getElementById('crud-modal').classList.remove('hidden');
                            document.getElementById('crud-modal').classList.add('block');

                            fetchAppointmentsForDate(date, agentAccountNo);
                        }
                    })
                    .catch(error => console.error('Error fetching appointments:', error));
            },
            events: function(fetchInfo, successCallback, failureCallback) {
                fetch(`/appointments/getFullyBookedDates?agent_account_no=${agentAccountNo}`)
                    .then(response => response.json())
                    .then(data => {
                        var events = data.map(date => ({
                            start: date, 
                            display: 'background',
                            backgroundColor: 'red'
                        }));
                        successCallback(events);
                    })
                    .catch(error => {
                        console.error('Error fetching fully booked dates:', error);
                        failureCallback(error);
                    });
            }
        });

        // Fetch the appointments for a given date
        function fetchAppointmentsForDate(date, agentAccountNo) {
            // Disable all time options first
            var timeSelect = document.getElementById('appointmentTime');
            var options = timeSelect.querySelectorAll('option');
            options.forEach(function(option) {
                option.disabled = false;
                option.classList.remove('text-red-600');
            });

            // Send AJAX request to backend to get the existing appointments
            fetch(`/appointments/getAppointmentsForDate?date=${date}&agent_account_no=${agentAccountNo}`)
                .then(response => response.json())
                .then(appointments => {
                    // Disable the corresponding time options based on the existing appointments
                    appointments.forEach(function(appointmentTime) {
                        var option = timeSelect.querySelector(`option[value="${appointmentTime}"]`);
                        if (option) {
                            option.disabled = true;
                            option.classList.add('text-red-600');
                        }
                    });
                })
                .catch(error => console.error('Error fetching appointments:', error));
        }

        // Close modal if user clicks outside of modal content
        modal.addEventListener('click', function (e) {
            if (!modalContent.contains(e.target)) {
                modal.classList.add('hidden');
            }
        });

        document.querySelector('[data-modal-toggle="crud-modal"]').addEventListener('click', function() {
            document.getElementById('crud-modal').classList.remove('block');
            document.getElementById('crud-modal').classList.add('hidden');
        });

        document.getElementById('cancel').addEventListener('click', function() {
            document.getElementById('crud-modal').classList.remove('block');
            document.getElementById('crud-modal').classList.add('hidden');
        });

        calendar.render();
    });

    document.getElementById('bookAppointment').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        fetch(form.getAttribute('data-action'), {
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
                    title: 'Success!',
                    text: data.message,
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
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
</script>