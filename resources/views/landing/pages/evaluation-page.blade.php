<x-layouts.landing title="Home Page">
    <section class="framework section-py-space light-bg mt-5" id="framework">
        <div class="custom-container">
            <div class="row">
                <div class="col-md-12 wow pulse">
                    <div class="title">
                        <h2>Evaluasi Dan Pengendalian</h2>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <x-card class="text-center">
                            <center>
                                <h3 class="">Halaman ini masih dalam mode pengembangan.</h3>
                                <img src="{{ asset('assets/images/development_mode.png') }}" width="300"/>
                            </center>
                        </x-card>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-landing.section-footer/>
    @includeIf('layouts.landing.partials.js')
    <x-slot:script>
        <script>


        </script>
    </x-slot:script>
</x-layouts.landing>
