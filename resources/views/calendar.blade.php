<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- tailwind css --}}
    @vite('resources/css/app.css')

    {{-- flowbite --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    {{-- fullcalendar --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
              <form method="POST" data-action="" class="p-4 md:p-5">
                  <div class="grid gap-4 mb-4 grid-cols-2">
                      <input type="hidden" name="appointmentDate" id="appointmentDate">
                      <input type="hidden" name="agentAccountNo" id="agentAccountNo">
                      <div class="col-span-2">
                          <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Fullname</label>
                          <input type="text" name="name" id="name" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type fullname" required="">
                      </div>
                      <div class="col-span-2 sm:col-span-1">
                          <label for="agent" class="block mb-2 text-sm font-medium text-gray-900">Agent</label>
                          <input type="text" name="agent" id="agent" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ $agentName->agent_name }}" readonly placeholder="Type agent" required="">
                      </div>
                      <div class="col-span-2 sm:col-span-1">
                          <label for="time" class="block mb-2 text-sm font-medium text-gray-900">Time</label>
                          <select id="time" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                              <option selected="">Select time</option>
                              <option value="9">9:00 AM</option>
                              <option value="10">10:00 AM</option>
                              <option value="11">11:00 AM</option>
                              <option value="12">12:00 PM</option>
                          </select>
                      </div>
                      <div class="col-span-2">
                          <label for="notes" class="block mb-2 text-sm font-medium text-gray-900">Notes</label>
                          <textarea id="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write other notes here"></textarea>                    
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
  // document.addEventListener('DOMContentLoaded', function() {
  //   var modal = document.getElementById('crud-modal');
  //   var modalContent = modal.querySelector('.relative.bg-white');

  //   var calendarEl = document.getElementById('calendar');
  //   var calendar = new FullCalendar.Calendar(calendarEl, {
  //     initialView: 'dayGridMonth',
  //     weekends: false,
  //     // selectable range to only 1 year
  //     validRange: function(nowDate) {
  //       var endDay = nowDate.setMonth(nowDate.getMonth() + 12);
  //       var today = nowDate.setMonth(nowDate.getMonth() - 12);

  //       return {
  //           start: today,
  //           end: endDay,
  //       };
  //     },
      
  //     // On date click
  //     dateClick: function(info) {
  //         // Get the clicked date
  //         var date = info.dateStr;

  //         // Format the date into a more readable format (e.g., 'March 14, 2025')
  //         var formattedDate = new Date(date);
  //         var options = { year: 'numeric', month: 'long', day: 'numeric' };
  //         var formattedDateString = formattedDate.toLocaleDateString('en-US', options); 

  //         $('#modal-title').html('Set booking on: ' + formattedDateString); // Set the header text with the formatted date
  //         document.getElementById('appointmentDate').value = date; // Set the value of the hidden input with id "appointmentDate" to the selected date
  //         document.getElementById('agentAccountNo').value = {{ $agentName->account_no }}; // Set the value of the id "agentAccountNo" to the agent's account number

  //         // Show the modal when a date is clicked
  //         document.getElementById('crud-modal').classList.remove('hidden');
  //         document.getElementById('crud-modal').classList.add('block');       
  //     }
  //   });

  //   // Close modal if user clicks outside of modal content
  //   modal.addEventListener('click', function (e) {
  //       // Check if the click is outside the modal content
  //       if (!modalContent.contains(e.target)) {
  //           modal.classList.add('hidden'); // Hide the modal
  //       }
  //   });

  //   document.querySelector('[data-modal-toggle="crud-modal"]').addEventListener('click', function() {
  //     document.getElementById('crud-modal').classList.remove('block');
  //     document.getElementById('crud-modal').classList.add('hidden');
  //   });

  //   document.getElementById('cancel').addEventListener('click', function() {
  //     document.getElementById('crud-modal').classList.remove('block');
  //     document.getElementById('crud-modal').classList.add('hidden');
  //   });

  //   calendar.render();
  // });

  document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('crud-modal');
    var modalContent = modal.querySelector('.relative.bg-white');

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        weekends: false,
        validRange: function(nowDate) {
            var endDay = nowDate.setMonth(nowDate.getMonth() + 12);
            var today = nowDate.setMonth(nowDate.getMonth() - 12);
            return {
                start: today,
                end: endDay,
            };
        },
        dateClick: function(info) {
            var date = info.dateStr;

            var formattedDate = new Date(date);
            var options = { year: 'numeric', month: 'long', day: 'numeric' };
            var formattedDateString = formattedDate.toLocaleDateString('en-US', options); 

            $('#modal-title').html('Set booking on: ' + formattedDateString); // Set the header text
            document.getElementById('appointmentDate').value = date; // Set hidden input value
            document.getElementById('agentAccountNo').value = {{ $agentName->account_no }}; // Set agent account number

            // Show the modal
            document.getElementById('crud-modal').classList.remove('hidden');
            document.getElementById('crud-modal').classList.add('block');       

            // Fetch the existing appointments for the selected date and disable those times
            fetchAppointmentsForDate(date, {{ $agentName->account_no }});
        }
    });

    // Fetch the appointments for a given date
    function fetchAppointmentsForDate(date, agentAccountNo) {
        // Disable all time options first
        var timeSelect = document.getElementById('time');
        var options = timeSelect.querySelectorAll('option');
        options.forEach(function(option) {
            option.disabled = false;
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
</script>