<div class="container-fluid bg-dark text-light p-3 d-flex align-itmes-center justify-content-between sticky-top">
    <h3 class="mb-0 h-font">ROYAL HOTEL</h3>
    <a href="logout.php" class="btn btn-light btn-sm">LOG OUT</a>
</div>

<div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashboard-menu">
    <nav class="navbar navbar-expand-lg navbar-dark shadow">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2 text-light h-font">ADMIN PANEL</h4>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#admindropdown"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="admindropdown">
                <ul class="nav nav-pills flex-column">

                    <li class="nav-item">
                        <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <button
                            class="btn text-white px-3 w-100 text-start d-flex align-items-center justify-content-between"
                            type="button" data-bs-toggle="collapse" data-bs-target="#bookkingsLinks"
                            aria-expanded="false" aria-controls="collapseExample">
                            <span>Bookings</span>
                            <span><i class="bi bi-caret-down-fill"></i></span>
                        </button>
                        <div>
                            <div class="collapse show px-3 small mb-1" id="bookkingsLinks">
                                <ul class="nav nav-pills">
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Link</a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="Rooms.php">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="features.php">Features & Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="User_Queries.php">User Queries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="Carousel.php">Carousel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="settings.php">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>