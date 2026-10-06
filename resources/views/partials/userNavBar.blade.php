<div x-data="{ open: false }" class="w-full text-green-900 bg-cream"> <!-- cream green background -->
    <div class="flex flex-col max-w-screen-xl px-8 mx-auto md:items-center md:justify-between md:flex-row">
        <!-- Logo + Brand -->
        <div class="flex flex-row items-center justify-between py-6">
            <div class="relative md:mt-8">
                <a href="#" class="text-lg relative z-50 font-bold tracking-widest text-green-900 rounded-lg focus:outline-none focus:shadow-outline">
                    GreenSpaces
                </a>
                <!-- Leaf icon instead of diamond -->
                <svg class="h-11 z-40 absolute -top-2 -left-3" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M40 2C58 10 75 30 70 50C65 70 40 78 25 65C10 50 5 25 20 10C25 5 32 2 40 2Z"
                          fill="#4CAF50" stroke="#2E7D32" stroke-width="2"/>
                </svg>
            </div>
            <!-- Mobile Menu Button -->
            <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav :class="{ 'transform md:transform-none': !open, 'h-full': open }"
            class="h-0 md:h-auto flex flex-col flex-grow md:items-center pb-4 md:pb-0 md:flex md:justify-end md:flex-row origin-top duration-300 scale-y-0">
            
            <a class="px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-8 md:ml-4 hover:text-green-600 focus:outline-none focus:shadow-outline" href="/">Home</a>
            <a class="px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-8 md:ml-4 hover:text-green-600 focus:outline-none focus:shadow-outline" href="/Projects">Projects</a>
            <a class="px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-8 md:ml-4 hover:text-green-600 focus:outline-none focus:shadow-outline" href="/events">Events</a>
            @if(auth()->check())
            <a class="px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-8 md:ml-4 hover:text-green-600 focus:outline-none focus:shadow-outline" href="/MyActivities">My Activities</a>
            @endif

            @if(auth()->check())
                <!-- User Name -->
                <a 
                    href="{{ route('profile') }}" 
                    class="px-4 py-3 mt-2 text-sm bg-white text-green-800 rounded-full md:mt-8 md:ml-4 shadow-md hover:bg-green-50 transition inline-block">
                    {{ auth()->user()->nom }} {{ auth()->user()->prenom }}
                </a>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="px-10 py-3 mt-2 text-sm text-center bg-red-600 text-white rounded-full md:mt-8 md:ml-4 shadow-md hover:bg-red-700 transition">
                        Logout
                    </button>
                </form>
            @else
                <!-- Login Button -->
                <a class="px-10 py-3 mt-2 text-sm text-center bg-white text-green-800 rounded-full md:mt-8 md:ml-4 shadow-md hover:bg-green-100 transition" href="{{ route('login') }}">Login</a>
                
                <!-- Sign Up Button -->
                <a class="px-10 py-3 mt-2 text-sm text-center text-white rounded-full md:mt-8 md:ml-4 shadow-md transition" 
                style="background: linear-gradient(105.5deg, #2E7D32 19.57%, #4CAF50 78.85%);" 
                href="{{ route('register') }}">
                Sign Up
                </a>
            @endif
        </nav>

    </div>
</div>
