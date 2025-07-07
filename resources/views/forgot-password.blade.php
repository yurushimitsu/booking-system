@extends('layouts.master')

@section('title', 'Booking | Forgot Password')

@section('body')
<body>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
            <img class="w-auto h-25" src="{{ asset('img/fil-global-dark-logo.png') }}" alt="Fil-Global Logo">
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Forgot Password?
                    </h1>
                    <form class="space-y-4 md:space-y-6" id="forgotPasswordForm" action="{{ route('forgotPassword.submit') }}" method="POST">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required="">
                        </div>
                        <div class="flex items-center justify-end">
                            <a href="{{ route('login') }}" class="text-sm font-medium text-primary-600 hover:underline">Back to Login?</a>
                        </div>
                        <button type="submit" class="w-full text-white cursor-pointer bg-blue-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Send Email</button>
                        <p class="text-sm font-light text-gray-500">
                            Don’t have an appointment yet? <a href="{{ route('homepage') }}" class="font-medium text-primary-600 hover:underline">Book now</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    document.getElementById('forgotPasswordForm').addEventListener('submit', function(event) {
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
                    window.location.href = "{{ route('login') }}";
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
</script>
@endsection