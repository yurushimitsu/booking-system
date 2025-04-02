@extends('layouts.master')

<body class="bg-[#F0F8FF]">
    <div class="flex items-center justify-center min-h-screen p-5 lg:p-4">
        <div class="w-4xl bg-white rounded-2xl shadow-lg">
            <div class="flex flex-col lg:flex-row relative min-h-120">
                <!-- Agent Section -->
                <div class="lg:w-2/4 relative bg-[#0F0564] rounded-t-2xl lg:rounded-l-2xl pt-80 lg:pt-35 border-0 shadow-md lg:shadow-2xl">
                    <div class="absolute top-4 left-1/2 transform -translate-x-1/2">
                        <img src="{{ asset('img/fil-global-white-logo.png') }}" class="h-20 lg:w-full" alt="Fil-Global Logo">
                    </div>
                    <div class="absolute bottom-0 w-full">
                        <div class="flex justify-center">
                            <img src="{{ asset('agent-pics/'.$row->profile_picture) }}" class="object-cover h-40 lg:h-70 rounded-t-lg md:rounded-l-lg md:rounded-t-none" alt="profile_picture">
                        </div>
                        <div class="w-full text-center lg:rounded-bl-2xl bg-white py-2">
                            <div class="text-lg font-medium">{{$row->agent_name}}</div>
                            <div class="text-sm text-blue-500">{{$row->agent_email}}</div>
                        </div>
                    </div>
                </div>
    
                <!-- Form Section -->
                <div  class="p-6 lg:w-3/4 flex flex-col">
                    <form class="p-3" id="bookAppointment" action="{{ route('postAppointmentRequest') }}" method="POST">
                        @csrf
                        {{-- First Form --}}
                        <div id="form-section-1">
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="text-center text-lg font-bold">
                                    Fill Up the Form
                                </div>
                            </div>
                            <input type="hidden" name="agent_account_no" id="agent_account_no" value="{{ $agent_no }}" required />
                            <div class="relative z-0 w-full mb-9 group">
                                <input type="text" name="fullname" id="fullname" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" required />
                                <label for="fullname" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fullname <span class="text-red-500">*</span></label>
                            </div>
                            <div class="relative z-0 w-full mb-9 group">
                                <input type="text" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" required />
                                <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email <span class="text-red-500">*</span></label>
                            </div>
                            <div class="relative z-0 w-full mb-9 group">
                                <input type="text" name="contact" id="contact" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" required />
                                <label for="contact" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Contact Number (Ex. 09123456789) <span class="text-red-500">*</span></label>
                            </div>
                            <div class="relative z-0 w-full mb-20 lg:mb-9 group">
                                <label for="appointment_type" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Appointment Type <span class="text-red-500">*</span></label>
                                <select id="appointment_type" name="appointment_type" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer" required>
                                    <option value="" selected>Select Appointment Type</option>
                                    <option class="text-gray-900" value="Financial Requirement">Appointment for financial requirement</option>
                                    <option class="text-gray-900" value="Counsultation">Consultation</option>
                                    <option class="text-gray-900" value="Counselling Members">Counselling Members</option>
                                    <option class="text-gray-900" value="Documentation Evaluation">Documentation Evaluation</option>
                                    <option class="text-gray-900" value="Pre-Departure Orientation">Pre-Departure Orientation Seminar</option>
                                    <option class="text-gray-900" value="Timelining">Timelining</option>
                                    <option class="text-gray-900" value="Visa Lodging Orientation">Visa Lodging Orientation</option>
                                    <option class="text-gray-900" value="SOP/GTE Writing">SOP/GTE Writing</option>
                                    <option class="text-gray-900" value="Others">Others</option>
                                </select>
                            </div>
                            {{-- <div class="relative"> --}}
                                <div class="flex justify-end gap-2 absolute bottom-10 right-10">
                                    <a href="{{ route('agents') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-25 py-2.5 text-center">Cancel</a>
                                    <button id="next-button" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-25 py-2.5 text-center">Next</button>
                                </div>
                            {{-- </div> --}}
                        </div>

                        {{-- Second Form --}}
                        <div id="form-section-2" class="hidden">
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="text-center text-lg font-bold">
                                    Appointment: <span id="appointment_title" class="text-blue-500"></span>
                                </div>
                            </div>
                            <div class="relative z-0 w-full mb-9 group">
                                <input type="date" name="appointment_date" id="appointment_date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="appointment_date" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Choose Date</label>
                            </div>
                            <div class="relative z-0 w-full mb-9 group">
                                <label for="appointment_time" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Choose Time</label>
                                <select name="appointment_time" id="appointment_time" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option selected="">Select time</option>
                                    <option class="text-gray-900" value="08:00:00">8:00 AM</option>
                                    <option class="text-gray-900" value="09:00:00">9:00 AM</option>
                                    <option class="text-gray-900" value="10:00:00">10:00 AM</option>
                                    <option class="text-gray-900" value="11:00:00">11:00 AM</option>
                                    <option class="text-gray-900" value="13:00:00">1:00 PM</option>
                                    <option class="text-gray-900" value="14:00:00">2:00 PM</option>
                                    <option class="text-gray-900" value="15:00:00">3:00 PM</option>
                                    <option class="text-gray-900" value="16:00:00">4:00 PM</option>
                                </select>
                            </div>
                            <div class="relative z-0 w-full mb-15 lg:mb-9 group">
                                <label for="notes" class="block mb-2 text-sm text-gray-900">Please share anything that will help prepare for our meeting <br>(Optional)</label>
                                <textarea name="notes" id="notes" rows="1" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder=""></textarea>
                            </div>
                            <div class="flex justify-end gap-2 absolute bottom-10 right-10">
                                <button id="back-button" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-25 py-2.5 text-center">Back</a>
                                <button id="submit-button" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-25 py-2.5 text-center">
                                    Submit
                                </button>
                                <button id="loading-button" disabled type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-25 py-2.5 text-center hidden">
                                    <svg aria-hidden="true" role="status" class="inline w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                    </svg>
                                    Loading...
                                </button>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('appointment_date');
        const timeSelect = document.getElementById('appointment_time');

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
                // timeSelect.disabled = true; // Disable time select when date is cleared
            }
        });

        document.getElementById('appointment_date').addEventListener('change', function() {
            let selectedDate = this.value;
            let agentAccountNo = {{ $agent_no }}; // Set your agent account number here

            // Choose date first to enable time select
            if (dateInput.value) {
                // timeSelect.disabled = false;
                timeSelect.selectedIndex = 0;
            } else {
                // timeSelect.disabled = true;
                timeSelect.selectedIndex = 0;
            }

            // Send an AJAX request to get appointments for the selected date
            fetch(`/appointment/getAppointmentsForDate?date=${selectedDate}&agent_account_no=${agentAccountNo}`)
                .then(response => response.json())
                .then(data => {
                    let appointmentTimes = data; // Array of appointment times
                    let timeSelect = document.getElementById('appointment_time');

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
    
    document.getElementById("next-button").addEventListener("click", function(event) {
        var fullname = document.getElementById("fullname").value;
        var email = document.getElementById("email").value;
        var contact = document.getElementById("contact").value;
        var appointmentType = document.getElementById("appointment_type").value;

        document.getElementById("appointment_title").textContent = appointmentType;

        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        var contactPattern = /^(09|\+639)\d{9}$/;

        if (!fullname || !email || !contact || !appointmentType) {
            Swal.fire({
                icon: 'warning',
                title: 'Please fill out all the fields',
            });
            return;
        }

        if (!emailPattern.test(email)) {
            Swal.fire({
                icon: 'warning',
                title: 'Please enter a valid email address',
            });
            return;
        }

        if (!contactPattern.test(contact)) {
            Swal.fire({
                icon: 'warning',
                title: 'Please enter a valid contact number',
            });
            return;
        }

        document.getElementById("form-section-1").classList.add("hidden");
        document.getElementById("form-section-2").classList.remove("hidden");
    });

    document.getElementById("back-button").addEventListener("click", function() {
        document.getElementById("form-section-2").classList.add("hidden");
        document.getElementById("form-section-1").classList.remove("hidden");
    }); 

    document.getElementById('bookAppointment').addEventListener('submit', function(event) {
        event.preventDefault();

        document.getElementById('submit-button').classList.add('hidden');
        document.getElementById('loading-button').classList.remove('hidden');

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
                    title: 'Success!',
                    text: data.message,
                }).then(() => {
                    window.location.href = "{{ route('agents') }}";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                });
                document.getElementById('submit-button').classList.remove('hidden');
                document.getElementById('loading-button').classList.add('hidden');
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
            document.getElementById('submit-button').classList.remove('hidden');
            document.getElementById('loading-button').classList.add('hidden');
        });
    });
</script>