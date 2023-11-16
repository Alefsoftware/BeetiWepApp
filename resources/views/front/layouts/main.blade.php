@include('front.layouts.header')
<main class="main">
    <!-- Add this to your HTML file -->
<div class="modal " id="cartAddModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-warning-soft">
            {{-- <div class="modal-header">
                <h5 class="modal-title">Success</h5>

            </div> --}}
            <div class="modal-body" >
                <p id="cartAddMessage" ></p>
            </div>
        </div>
    </div>
</div>
    @yield('content')
</main>
@include('front.layouts.footer')
