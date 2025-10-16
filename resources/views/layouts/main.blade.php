<!DOCTYPE html>
<html lang="en">
<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        {{-- head--}}
        @include('inc.head')

        {{-- header --}}
        @include('inc.header')
        {{-- Main Page Content --}}
        @yield('content')


        {{-- Footer --}}
        @include('inc.footer')

    </div>
</body>
</html>
