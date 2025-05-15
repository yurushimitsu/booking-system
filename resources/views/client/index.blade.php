@extends('layouts.master')

@section('title', 'Booking | Home')

@section('body')

@include('layouts.navbar')

<body style="background-image: url('{{ asset('img/homepage-bg.png') }}');" class="bg-cover bg-center bg-no-repeat">
     <div class="flex flex-col justify-center items-center min-h-screen">
        <div class="text-2xl md:text-5xl text-[#0F0564] text-center font-bold mb-10">
            Schedule with ease - <br>
            Book your appointment now!
        </div>
        
        <a href="{{ route('agents') }}" class="inline-flex w-40 text-center justify-center py-2 text-md font-medium text-center text-white bg-gradient-to-r from-blue-500 to-blue-900 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            Book
        </a>
    </div>
</body>

@endsection