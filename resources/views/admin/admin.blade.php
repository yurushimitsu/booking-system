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
                <div class="flex flex-row justify-between items-end">
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
                <div class="pt-5 border-gray-200 flex sm:flex-row flex-col sm:space-x-5 rtl:space-x-reverse">
                    <div class="flex flex-col">
                        <div class="text-2xl font-bold pb-5">
                            Calendar
                        </div>
                        <div inline-datepicker datepicker-buttons datepicker-autoselect-today class="mx-auto sm:mx-0"></div>
                    </div>
                    
                    <div class="sm:ms-7 sm:ps-5 sm:border-s border-gray-200 w-full sm:max-w-[15rem] mt-5 sm:mt-0">
                       <h3 class="text-gray-900 text-base font-medium mb-3 text-center">Wednesday 30 June 2024</h3>
                       <button type="button" data-collapse-toggle="timetable" class="inline-flex items-center w-full py-2 px-5 me-2 justify-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">
                          <svg class="w-4 h-4 text-gray-800 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                             <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                          </svg>
                          Pick a time
                       </button>
                       <label class="sr-only">
                       Pick a time
                       </label>
                       <ul id="timetable" class="grid w-full grid-cols-2 gap-2 mt-5">
                          <li>
                             <input type="radio" id="10-am" value="" class="hidden peer" name="timetable">
                             <label for="10-am"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-600  peer-checked:text-white ">
                             10:00 AM
                             </label>
                          </li>
                          <li>
                             <input type="radio" id="10-30-am" value="" class="hidden peer" name="timetable">
                             <label for="10-30-am"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-600  peer-checked:text-white  ">
                             10:30 AM
                             </label>
                          </li>
                          <li>
                             <input type="radio" id="11-am" value="" class="hidden peer" name="timetable">
                             <label for="11-am"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-600  peer-checked:text-white  ">
                             11:00 AM
                             </label>
                          </li>
                          <li>
                             <input type="radio" id="11-30-am" value="" class="hidden peer" name="timetable">
                             <label for="11-30-am"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-600  peer-checked:text-white  ">
                             11:30 AM
                             </label>
                          </li>
                          <li>
                             <input type="radio" id="12-am" value="" class="hidden peer" name="timetable" checked>
                             <label for="12-am"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-600  peer-checked:text-white  ">
                             12:00 AM
                             </label>
                          </li>
                          <li>
                             <input type="radio" id="12-30-pm" value="" class="hidden peer" name="timetable">
                             <label for="12-30-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-600  peer-checked:text-white  ">
                             12:30 PM
                             </label>
                          </li>
                          <li>
                             <input type="radio" id="1-pm" value="" class="hidden peer" name="timetable">
                             <label for="1-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-600  peer-checked:text-white  ">
                             01:00 PM
                             </label>
                          </li>
                          <li>
                             <input type="radio" id="1-30-pm" value="" class="hidden peer" name="timetable">
                             <label for="1-30-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-600  peer-checked:text-white  ">
                             01:30 PM
                             </label>
                          </li>
                          <li>
                             <input type="radio" id="2-pm" value="" class="hidden peer" name="timetable">
                             <label for="2-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-600  peer-checked:text-white  ">
                             02:00 PM
                             </label>
                          </li>
                          <li>
                             <input type="radio" id="2-30-pm" value="" class="hidden peer" name="timetable">
                             <label for="2-30-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-600  peer-checked:text-white  ">
                             02:30 PM
                             </label>
                          </li>
                          <li>
                             <input type="radio" id="3-pm" value="" class="hidden peer" name="timetable">
                             <label for="3-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-600  peer-checked:text-white  ">
                             03:00 PM
                             </label>
                          </li>
                          <li>
                             <input type="radio" id="3-30-pm" value="" class="hidden peer" name="timetable">
                             <label for="3-30-pm"
                                class="inline-flex items-center justify-center w-full p-2 text-sm font-medium text-center bg-white border rounded-lg cursor-pointer text-blue-600 border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-600  peer-checked:text-white  ">
                             03:30 PM
                             </label>
                          </li>
                       </ul>
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
</script>
    
@endsection