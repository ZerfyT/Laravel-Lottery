<div class="drawer lg:drawer-open">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
        <!-- Page content here -->
        @include('components.navbar')

        <div class="p-6 mx-auto lg:p-8">
            @yield('content')
        </div>

        <div class="h-20"></div>

    </div>
    <div class="drawer-side z-40">
        <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
        <aside class="bg-base-200 text-base-content min-h-screen w-80 p-4">
            <!-- Sidebar content here -->
            <div
                class="sticky top-0 z-20 hidden items-center gap-2 px-4 py-2 backdrop-blur lg:flex ">
                {{-- <a class="btn btn-ghost text-xl">Laravel Lottery</a> --}}
                @include('components.logo')
            </div>
            <ul class="menu px-4 py-0">
                <li><a>Sidebar Item 1</a></li>
                <li><a>Sidebar Item 2</a></li>
            </ul>
        </aside>
    </div>
</div>
