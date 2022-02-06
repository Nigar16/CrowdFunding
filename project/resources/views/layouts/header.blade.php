<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="{{route("index")}}" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <h3 style="color:#f0ad4e">Crowd</h3> <h3 style="color:white">Funding</h3>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 mx-5">


            </ul>
            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle btn-warning" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{session("user")->email}}
                </a>
                <ul class="dropdown-menu text-small text-center" aria-labelledby="dropdownUser1">
                    <li><a href="{{route("own")}}" >Own projects</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <a  href="{{ route('logout') }}"> <button type="button" class="btn btn-warning btn-sm">Logout</button></a>

                </ul>
            </div>

        </div>
    </div>
</header>
