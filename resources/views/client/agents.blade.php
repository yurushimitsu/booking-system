@extends('layouts.master')

@section('body')

@include('layouts.navbar')

<body class="bg-[#F0F8FF]">
    <header id="hero" class="bg-fixed bg-no-repeat bg-center bg-cover relative">
        <div class="h-120 bg-opacity-50 bg-black flex items-center justify-center bg-cover bg-center" style="background-image: url({{ asset('img/hero-section.png') }});">
            <div class="mx-2 text-center">
                <h1 class="text-gray-100 font-extrabold text-5xl">Book Your <br>Pathway Consultant</h1>
            </div>
        </div>
    </header>
    <div class="py-10 px-5">
        <div class="text-center">
            <h1 class="text-black font-extrabold text-2xl pb-10">Pathway Consultants</h1>
            <div class="flex justify-center text-[#06064E] font-medium text-md pb-10">
                <div class="w-150">
                    Stay informed and inspired with our latest blog posts! From expert insights to
                    industry trends, we bring you valuable content to enhance your knowledge and
                    keep you updated. Read now and stay ahead!
                </div>
                
            </div>
            <div class="pb-10">
                <form class="max-w-lg mx-auto" id="searchForm">
                    <div class="flex shadow-lg">
                        <label for="dropdown-button" class="mb-2 text-sm font-medium text-gray-900 sr-only">Country</label>
                        <button id="dropdown-button" data-dropdown-toggle="dropdownCountry" class="shrink-0 z-10 inline-flex items-center justify-center py-2.5 px-3 text-sm font-medium text-center text-white bg-[#06064E] border border-gray-300 rounded-s-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" type="button">
                            <div id="country-label" class="hidden md:block">Country</div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 block md:hidden">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                            </svg>

                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <div id="dropdownCountry" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
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
            <div class="flex flex-wrap justify-center pt-10" id="agentsList">
                @foreach ($allAgents as $row)
                <div class="p-10 relative">
                    <div class="min-w-40 max-w-50 bg-transparent rounded-lg ">
                        <div class="flex justify-center bg-[#0F0564] shadow-xl rounded-xl relative">
                            <img class="-mt-12 -mx-8 h-90 min-w-50 object-cover" src="{{ asset('agent-pics/'.$row->profile_picture) }}" alt="agent picture" />
                        </div>
                        <h5 class="py-3 text-md font-medium tracking-tight text-gray-900">{{ $row->agent_name }}</h5>
                        <a href="/form?agent={{ $row->agent_id }}" class="inline-flex w-full text-center justify-center py-2 text-sm font-medium text-center text-white bg-gradient-to-r from-blue-500 to-blue-900 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Book
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            fetch_customer_data();

            // ajax search start
            function fetch_customer_data(query = '') {
                $.ajax({
                    url: "{{ route('searchAgent') }}",
                    method: 'GET',
                    data: {query: query},
                    dataType: 'json',
                    success: function(data) {
                        // Clear existing agents list
                        $('#agentsList').html('');

                        // Check if data contains agents
                        if(data.length > 0) {
                            data.forEach(function(agent) {
                                // Append each agent to the agents list
                                $('#agentsList').append(`
                                    <div class="p-10 relative">
                                        <div class="min-w-40 max-w-50 bg-transparent rounded-lg ">
                                            <div class="flex justify-center bg-[#0F0564] shadow-xl rounded-xl relative">
                                                <img class="-mt-12 -mx-8 h-90 min-w-50 object-cover" src="/agent-pics/${agent.profile_picture}" alt="agent picture" />
                                            </div>
                                            <h5 class="py-3 text-md font-medium tracking-tight text-gray-900">${agent.agent_name}</h5>
                                            <a href="/form?agent=${agent.agent_id}" class="inline-flex w-full text-center justify-center py-2 text-sm font-medium text-center text-white bg-gradient-to-r from-blue-500 to-blue-900 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                Book
                                            </a>
                                        </div>
                                    </div>
                                `);
                            });
                        } else {
                            $('#agentsList').html('<p class="text-black font-extrabold text-3xl">No agent found.</p>');
                        }
                    }
                })
            }

            $(document).on('keyup', '#search', function(){
                var query = $(this).val();
                fetch_customer_data(query);
            });


            // Filter Start
            // Fetch countries for the dropdown
            fetch_countries();

            // Function to fetch countries
            function fetch_countries() {
                $.ajax({
                    url: "{{ route('getCountries') }}",  // Add the route to fetch countries
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Populate dropdown with country options
                        $('#dropdownCountry ul').html('');
                        $('#dropdownCountry ul').append(`
                            <li>
                                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100" data-country-name="All">All</button>
                            </li>
                        `);
                        
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(function(country) {
                                $('#dropdownCountry ul').append(`
                                    <li>
                                        <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100" data-country-name="${country.country}">
                                            ${country.country}
                                        </button>
                                    </li>
                                `);
                            });
                        }
                    }
                });
            }

            // Fetch agents by selected country
            $(document).on('click', '#dropdownCountry button', function(){
                var countryName = $(this).data('country-name');

                // Update button text
                $('#country-label').text(countryName);

                if (countryName === 'all') {
                    fetch_agents_for_all_countries();
                } else {
                    // Fetch agents for the selected country
                    fetch_agents_by_country(countryName);
                }
            });

            // Fetch agents for all countries
            function fetch_agents_for_all_countries() {
                $.ajax({
                    url: "{{ route('searchAgentByCountry') }}",  // Add route to search agents by country
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Update agents list
                        $('#agentsList').html('');
                        if (data.length > 0) {
                            data.forEach(function(agent) {
                                $('#agentsList').append(`
                                    <div class="p-10 relative">
                                        <div class="min-w-40 max-w-50 bg-transparent rounded-lg ">
                                            <div class="flex justify-center bg-[#0F0564] shadow-xl rounded-xl relative">
                                                <img class="-mt-12 -mx-8 h-90 min-w-50 object-cover" src="/agent-pics/${agent.profile_picture}" alt="agent picture" />
                                            </div>
                                            <h5 class="py-3 text-md font-medium tracking-tight text-gray-900">${agent.agent_name}</h5>
                                            <a href="/form?agent=${agent.agent_id}" class="inline-flex w-full text-center justify-center py-2 text-sm font-medium text-center text-white bg-gradient-to-r from-blue-500 to-blue-900 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                Book
                                            </a>
                                        </div>
                                    </div>
                                `);
                            });
                        } else {
                            $('#agentsList').html('<p class="text-black font-extrabold text-3xl">No agents found.</p>');
                        }
                    }
                });
            }

            // Fetch agents based on selected country
            function fetch_agents_by_country(countryName) {
                $.ajax({
                    url: "{{ route('searchAgentByCountry') }}",  // Add route to search agents by country
                    method: 'GET',
                    data: {country_name: countryName},
                    dataType: 'json',
                    success: function(data) {
                        // Update agents list
                        $('#agentsList').html('');
                        if (data.length > 0) {
                            data.forEach(function(agent) {
                                $('#agentsList').append(`
                                    <div class="p-10 relative">
                                        <div class="min-w-40 max-w-50 bg-transparent rounded-lg ">
                                            <div class="flex justify-center bg-[#0F0564] shadow-xl rounded-xl relative">
                                                <img class="-mt-12 -mx-8 h-90 min-w-50 object-cover" src="/agent-pics/${agent.profile_picture}" alt="agent picture" />
                                            </div>
                                            <h5 class="py-3 text-md font-medium tracking-tight text-gray-900">${agent.agent_name}</h5>
                                            <a href="/form?agent=${agent.agent_id}" class="inline-flex w-full text-center justify-center py-2 text-sm font-medium text-center text-white bg-gradient-to-r from-blue-500 to-blue-900 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                Book
                                            </a>
                                        </div>
                                    </div>
                                `);
                            });
                        } else {
                            $('#agentsList').html('<p class="text-black font-extrabold text-3xl">No agents found in this country.</p>');
                        }
                    }
                });
            }
        });
    </script>
</body>

@endsection