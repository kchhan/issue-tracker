<div class="bg-gray-800 shadow-xl h-16 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48">
    <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
        <ul class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left">
            <li class="mr-3 flex-1">
                <a href="{{ route('home') }}"
                    class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-blue-600">
                    <i class="fas fa-chart-area pr-0 md:pr-3"></i><span
                        class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">Home</span>
                </a>
            </li>
            <li class="mr-3 flex-1">
                <a href="{{ route('projects') }}"
                    class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">
                    <i class="fas fa-tasks pr-0 md:pr-3"></i><span
                        class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">
                        Projects List</span>
                </a>
            </li>

            <li class="mr-3 flex-1">
                <a href="{{ route('tickets') }}"
                    class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-orange-500">
                    <i class="fas fa-receipt pr-0 md:pr-3"></i><span
                        class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">
                        Tickets List</span>
                </a>
            </li>

            <li class="mr-3 flex-1">
                <a href="{{ route('notifications') }}"
                    class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                    <i class="fas fa-bell pr-0 md:pr-3"></i><span
                        class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">Notifications
                        <span>
                        </span class="text-white">
                        @if (auth()->user()->unreadNotifications->count() > 0)
                        {{ auth()->user()->unreadNotifications->count() }}
                        @endif
                    </span>
                </a>
            </li>

            <li class="mr-3 flex-1">
                <a href="{{ route('users') }}"
                    class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-green-500">
                    <i class="fas fa-users pr-0 md:pr-3"></i><span
                        class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">Users
                        List</span>
                </a>
            </li>

            <li class="mr-3 flex-1">
                <a href="{{ route('profile', auth()->user()->username) }}"
                    class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-yellow-500">
                    <i class="fa fa-user pr-0 md:pr-3"></i><span
                        class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">Your
                        Profile</span>
                </a>
            </li>
            <li class="mr-3 flex-1">
                <form method="POST" action="{{ route('logout') }}"
                    class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-red-500">
                    @csrf
                    <i class="fas fa-sign-out-alt pl-0 md:pr-3"></i><button type="submit"
                        class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline">
                        Log Out
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>