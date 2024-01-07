<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            {{-- <img class="w-8 h-8 mr-2" src="" alt="logo"> --}}
            Hamba
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Login to Your Account
                </h1>
                <form wire:submit.prevent="submit">
                    {{$this->form}}
                    <button type="submit" class="w-full rounded-md mt-4 py-2 text-center text-[#F5E8C6] bg-[#435585]">
                        Login
                    </button>
                </form>

                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Don’t have an account yet? <a href="#"
                        class="font-medium text-primary-600 hover:underline dark:text-primary-500">Register</a>
                </p>
            </div>
        </div>
    </div>
</section>
