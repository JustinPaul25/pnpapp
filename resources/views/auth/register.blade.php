@extends('layouts.app')

@section('content')
<main class="sm:mx-auto sm:w-3/4 sm:mt-10">
    <div class="flex pb-20">
        <div class="w-full">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md">

                <header class="font-semibold bg-gray-900 text-gray-200 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    {{ __('Register') }}
                </header>

                <form class="w-full px-6 space-y-10 sm:px-10 sm:space-y-8" method="POST"
                    action="{{ route('register') }}">
                    @csrf

                    <div class="w-full flex">
                        <div class="w-1/2 mr-4">
                            <div class="flex flex-wrap mb-4">
                                <label for="first_name" class="block text-gray-700 text-sm font-bold">
                                    {{ __('First Name') }}:
                                </label>
        
                                <input id="first_name" type="text" class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('first_name') @enderror"
                                    name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
        
                                @error('first_name')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <div class="flex flex-wrap mb-4">
                                <label for="email" class="block text-gray-700 text-sm font-bold">
                                    {{ __('E-Mail Address') }}:
                                </label>
        
                                <input id="email" type="email"
                                    class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
        
                                @error('email')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            
                            <div class="flex flex-wrap mb-4">
                                <label for="rank_id" class="block text-gray-700 text-sm font-bold">
                                    {{ __('Rank') }}:
                                </label>
        
                                <select id="birth_date" type="text"
                                    class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('rank_id') @enderror" name="rank_id"
                                    value="{{ old('rank_id') }}" required autocomplete="birth_date">
                                    <option value="" selected disabled style="display:none">choose user rank</option>
                                    @foreach ($ranks as $rank)
                                        <option value="{{ $rank->id }}">{{ $rank->rank }}</option>
                                    @endforeach
                                </select>
        
                                @error('rank_id')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <div class="flex flex-wrap mb-4">
                                <label for="password" class="block text-gray-700 text-sm font-bold">
                                    {{ __('Password') }}:
                                </label>
        
                                <input id="password" type="password"
                                    class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') @enderror" name="password"
                                    required autocomplete="new-password">
        
                                @error('password')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                        <div class="w-1/2 ml-4">
                            <div class="flex flex-wrap mb-4">
                                <label for="last_name" class="block text-gray-700 text-sm font-bold">
                                    {{ __('Last Name') }}:
                                </label>
        
                                <input id="last_name" type="text" class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('last_name') @enderror"
                                    name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
        
                                @error('last_name')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <div class="flex flex-wrap mb-4">
                                <label for="mobile_no" class="block text-gray-700 text-sm font-bold">
                                    {{ __('Mobile No.') }}:
                                </label>
        
                                <input id="first_name" type="text" class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('mobile_no') @enderror"
                                    name="mobile_no" value="{{ old('mobile_no') }}" required autocomplete="first_name" autofocus>
        
                                @error('mobile_no')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <div class="flex flex-wrap mb-4">
                                <label for="birth_date" class="block text-gray-700 text-sm font-bold">
                                    {{ __('Birth Date') }}:
                                </label>
        
                                <input id="birth_date" type="date"
                                    class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('birth_date') @enderror" name="birth_date"
                                    value="{{ old('birth_date') }}" required autocomplete="birth_date">
        
                                @error('birth_date')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <div class="flex flex-wrap mb-4">
                                <label for="password-confirm" class="block text-gray-700 text-sm font-bold">
                                    {{ __('Confirm Password') }}:
                                </label>
        
                                <input id="password-confirm" type="password" class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div> 
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold">
                            {{ __('Short Description') }}:
                        </label>

                        <input id="description" type="text"
                            class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') @enderror" name="description"
                            value="{{ old('description') }}" required autocomplete="description">

                        @error('description')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit"
                            class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-gray-700 hover:bg-gray-500 sm:py-4">
                            {{ __('Register') }}
                        </button>

                        <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                            {{ __('Already have an account?') }}
                            <a class="text-blue-500 hover:text-blue-700 no-underline hover:underline" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </p>
                    </div>
                </form>

            </section>
        </div>
    </div>
</main>
@endsection