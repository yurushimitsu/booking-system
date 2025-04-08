<nav class="p-10 absolute inset-x-0 top-0 z-10 bg-transparent">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
    <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="{{ Route::is('agents') ? asset('img/fil-global-white-logo.png') : asset('img/fil-global-dark-logo.png') }}" class="h-15" alt="Fil-Global Logo" />
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col {{ (Route::is('agents')) ? 'text-white' : 'text-[#06064E]' }} p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
        <li>
          <a href="{{ route('agents') }}" class="block py-2 px-3 rounded-sm md:border-0 md:p-0">Homepage</a>
        </li>
        <li>
          <a href="{{ route('myBookings') }}" class="block py-2 px-3 rounded-sm md:border-0 md:p-0 {{ (Route::is('myBookings')) ? 'text-red-500' : '' }}">
            My Bookings 

            @if (Session::has('user_role') && session('user_role') == 'client' && $bookingCount > 0)
                <span class="inline-flex items-center justify-center w-4 h-4 text-xs font-semibold text-white bg-red-600 rounded-full">
                    {{ $bookingCount }}
                </span>
            @endif
          </a>
        </li>
        <li>
          <a href="{{ route('pastBookings') }}" class="block py-2 px-3 rounded-sm md:border-0 md:p-0">Past Bookings</a>
        </li>
        @if (Session::has('user_role') && session('user_role') == 'client')
          <li>
            <a href="{{ route('clientLogout') }}" class="block py-2 px-3 rounded-sm md:border-0 md:p-0">Logout</a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>