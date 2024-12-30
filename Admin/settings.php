<?php
require_once ('essentials.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Setting</title>
    <?php
    require ('css/csslink.php');
    ?>
</head>

<body class="bg-light">
    <?php require_once ('header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">SETTINGS</h3>
                <!-- General Settings -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex align-item-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                data-bs-target="#general-s">
                                Edit
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </div>

                        <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                        <p class="card-text h-font fw-bold fs-3" id="site_title"></p>
                        <h6 class="card-subtitle mb-1 fw-bold">About US</h6>
                        <p class="card-text" id="site_about"></p>
                    </div>
                </div>
                <!--General Settings Modal -->
                <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="general_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">General Settings</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Site title</label>
                                        <input type="text" class="form-control h-font fw-bold fs-3" name="site_title"
                                            id="site_title_input" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">About US</label>
                                        <textarea class="form-control" rows="4" name="site_about" id="site_about_input"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                        onclick="site_title.value = general_data.site_title,site_about.value = general_data.site_about"
                                        class="btn text-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Shutdown section -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex align-item-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Shutdown Website</h5>
                            <div class="form-check form-switch">
                                <form>
                                    <input onclick="upd_shutdown(this.value)" class="form-check-input" type="checkbox"
                                        id="shutdown-toggle">
                                </form>
                            </div>
                        </div>
                        <p class="card-text">
                            No customers will be allowed to book hotel room, when shutdown mode
                            is turned on.
                        </p>
                    </div>
                </div>
                <!-- Contact details section -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex align-item-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Contacts setting</h5>
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                data-bs-target="#contacts-s">
                                Edit
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                                    <p class="card-text fs-5" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                    <p class="card-text fs-5" id="gmap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-2 fw-bold">Phone number</h6>
                                    <p class="card-text mb-1 fs-5">
                                        <i class="bi bi-telephone-fill"></i>
                                        +<span id="pn1"></span>
                                    </p>
                                    <p class="card-text mb-1 fs-5">
                                        <i class="bi bi-telephone-fill"></i>
                                        +<span id="pn2"></span>
                                    </p>
                                    <p class="card-text mb-1 fs-5">
                                        <i class="bi bi-telephone-fill"></i>
                                        +<span id="pn3"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Email</h6>
                                    <p class="card-text fs-5" id="email"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-2 fw-bold">Social Links</h6>
                                    <p class="card-text mb-1 fs-5">
                                        <i class="bi bi-facebook me-1"></i>
                                        <span id="fb"></span>
                                    </p>
                                    <p class="card-text mb-1 fs-5">
                                        <i class="bi bi-instagram me-1"></i>
                                        <span id="insta"></span>
                                    </p>
                                    <p class="card-text mb-1 fs-5">
                                        <i class="bi bi-twitter-x me-1"></i>
                                        <span id="tw"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-2 fw-bold">iFrame</h6>
                                    <iframe id="iframe" class="border p-2 w-100" loading="lazy" allowfullscreen=""
                                        height="320"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Contacts details Modal -->
                <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form id="contacts_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Contacts Settings</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Address</label>
                                                    <input type="text" class="form-control" name="address"
                                                        id="address_inp" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Google Map Link</label>
                                                    <input type="text" class="form-control" name="gmap" id="gmap_inp"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Phone numbers (with country
                                                        code)</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-telephone-fill"></i></span>
                                                        <input type="number" name="pn1" id="pn1_inp" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-telephone-fill"></i></span>
                                                        <input type="number" name="pn2" id="pn2_inp" class="form-control">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-telephone-fill"></i></span>
                                                        <input type="text" name="pn3" id="pn3_inp" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">E-mail</label>
                                                    <input type="email" class="form-control" name="email" id="email_inp"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Social Links</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-facebook me-1"></i></span>
                                                        <input type="text" name="fb" id="fb_inp" class="form-control">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-instagram me-1"></i></span>
                                                        <input type="text" name="insta" id="insta_inp"
                                                            class="form-control">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-twitter-x me-1"></i></span>
                                                        <input type="text" name="tw" id="tw_inp" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">iFrame src</label>
                                                    <input type="text" class="form-control" name="iframe"
                                                        id="iframe_inp" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="contacts_inp(contacts_data)"
                                        class="btn text-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Management team section -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex align-item-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Management team</h5>
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                data-bs-target="#team-s">
                                Add
                                <i class="bi bi-plus-square"></i>
                            </button>
                        </div>

                        <div class="row" id="team-data">                            
                        </div>
                    </div>
                </div>

                <!--Management team Modal -->
                <div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="team_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Add Team Member</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" class="form-control fs-5" name="member_name"
                                            id="member_name_inp" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Picture</label>
                                        <input type="file" class="form-control" name="member_picture"
                                            id="member_picture_inp" accept=".jpg, .png, .webp, .jpeg" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="member_name.value='',member_picture.value=''" class="btn text-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php require_once ('js/jslink.php') ?>
    <script src="js/settings.js"></script>
</body>

</html>