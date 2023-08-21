<x-layouts.admin title="Home">
    <x-breadcrumb>
        <x-slot name="breadcrumb_title">
            <h3>Home Page</h3>
        </x-slot>
        <li class="breadcrumb-item">Home</li>
    </x-breadcrumb>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Sample Card</h5>
                        <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                    </div>
                    <div class="card-body">
                        <p>
                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea
                            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                            dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                            culpa qui officia deserunt mollit anim
                            id est laborum."
                        </p>
                        <pre>{{ json_encode(auth()->user(), 128) }}</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @includeIf('layouts.admin.partials.js')
</x-layouts.admin>
