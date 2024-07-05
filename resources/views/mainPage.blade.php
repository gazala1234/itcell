@include('TemplatePages.header')

@include('TemplatePages.sidebar')

<main id="main" class="main">
    <!-- End Page Title -->
    <div class="pagetitle" id="pagetitle">
        <h3 class="head text-center"  style="color: rgb(16, 47, 131)"><b>AMETHYST IT SERVICES Pvt Ltd</b></h3>
    </div>
    <!-- End Page Title -->

    {{-- dashboard content will come here --}}
    <section class="section dashboard" id="section">

        @yield('maincontent')

    </section>

</main><!-- End #main -->

@include('TemplatePages.footer')