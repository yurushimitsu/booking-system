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
    <div class="pt-10">
        <form class="max-w-md mx-auto">
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="date" name="appointment_date" id="appointment_date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="appointment_date" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Choose Date</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="time_select" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Choose Time</label>
                    <select id="time_select" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option selected="">Select time</option>
                        <option class="text-gray-900" value="09:00:00">9:00 AM</option>
                        <option class="text-gray-900" value="10:00:00">10:00 AM</option>
                        <option class="text-gray-900" value="11:00:00">11:00 AM</option>
                        <option class="text-gray-900" value="12:00:00">12:00 PM</option>
                    </select>
                </div>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" value="{{ $agentName->agent_name }}" readonly required />
                <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Agent</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="floating_email" id="floating_fullname" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" required />
                <label for="floating_fullname" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fullname</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" required />
                <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
            </div>
            
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="floating_phone" id="floating_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone number (123-456-7890)</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_company" id="floating_company" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_company" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Company (Ex. Google)</label>
                </div>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
        </form>
        <a class="underline text-blue-500 hover:text-blue-700 ps-5" href="/agents">Go Back</a>
    </div>
</body>
</html>

<script>
    // Function to disable past dates and weekends (Saturday and Sunday)
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('appointment_date');
        const timeSelect = document.getElementById('time_select');

        timeSelect.addEventListener('change', function(event) {
            // Check if a date has been selected
            if (!dateInput.value) {
                // Show an alert if no date has been selected
                Swal.fire({
                    icon: 'warning',
                    title: 'Please select a date first.',
                    text: 'You need to select a valid date before choosing a time slot.',
                });
                timeSelect.selectedIndex = 0;
            }
        });

        // Initially disable the select dropdown
        // timeSelect.disabled = true;

        // timeSelect.addEventListener('click', function () {
        //     if (timeSelect.disabled) {
        //         alert('Please select a date first.');
        //     }
        // });
        
        // Get today's date and set it as the min value for the date picker 
        let today = new Date();
        let yyyy = today.getFullYear();
        let mm = today.getMonth() + 1; // Month is zero-indexed
        let dd = today.getDate();

        if (mm < 10) mm = '0' + mm;  // Add leading zero if necessary
        if (dd < 10) dd = '0' + dd;  // Add leading zero if necessary
        
        let todayDate = `${yyyy}-${mm}-${dd}`;
        dateInput.setAttribute('min', todayDate);
        
        // Function to validate the selected date (to disable Saturdays and Sundays)
        dateInput.addEventListener('input', function() {
            let selectedDate = new Date(dateInput.value);
            let day = selectedDate.getDay();
            
            // If the selected date is Saturday (6) or Sunday (0), reset the input field
            if (day === 6 || day === 0) {
                // alert("You cannot select a Saturday or Sunday.");
                Swal.fire({
                    icon: 'warning',
                    title: 'We are not available on weekends',
                    text: 'Please select another date.',
                });
                dateInput.value = ''; // Clear the input field if the date is invalid
                timeSelect.disabled = true; // Disable time select when date is cleared
            }
        });

        document.getElementById('appointment_date').addEventListener('change', function() {
            let selectedDate = this.value;
            let agentAccountNo = {{ $agentName->account_no }}; // Set your agent account number here

            // Choose date first to enable time select
            if (dateInput.value) {
                // timeSelect.disabled = false;
                timeSelect.selectedIndex = 0;
            } else {
                // timeSelect.disabled = true;
                timeSelect.selectedIndex = 0;
            }

            // Send an AJAX request to get appointments for the selected date
            fetch(`/appointments/getAppointmentsForDate?date=${selectedDate}&agent_account_no=${agentAccountNo}`)
                .then(response => response.json())
                .then(data => {
                    let appointmentTimes = data; // Array of appointment times
                    let timeSelect = document.getElementById('time_select');

                    // Enable all times first
                    for (let option of timeSelect.options) {
                        option.disabled = false;
                        option.classList.remove('text-red-600');
                    }

                    // Disable the times that are already booked
                    for (let time of appointmentTimes) {
                        for (let option of timeSelect.options) {
                            if (option.value === time) {
                                option.disabled = true;
                                option.classList.add('text-red-600');
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Error fetching appointments:', error);
                });
        });       
    });
</script>