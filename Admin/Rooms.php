<?php
require_once('db_config.php');
require_once('essentials.php');
adminLogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Rooms</title>
    <?php
    require('css/csslink.php');
    ?>
</head>

<body class="bg-light">
    <?php require_once('header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Rooms</h3>


                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                data-bs-target="#add-room">
                                Add
                                <i class="bi bi-plus-square"></i>
                            </button>
                        </div>
                        <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Guests</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="room-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add room modal -->
    <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control fs-5" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Area</label>
                                <input type="number" min="1" class="form-control fs-5" name="area" placeholder="In sq.ft." required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="number" min="1" class="form-control fs-5" name="price" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" min="1" class="form-control fs-5" name="quantity" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Adult (Max.)</label>
                                <input type="number" class="form-control fs-5" name="adult" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Children (Max.)</label>
                                <input type="number" class="form-control fs-5" name="children" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Features</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll($con, 'features');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                        <label>
                                        <input type='checkbox' name='features' value='$opt[id]' class='form-check-input'>
                                        $opt[name]
                                        </label>
                                        </div>
                                        ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Facilities</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll($con, 'facilities');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                        <label>
                                        <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input'>
                                        $opt[name]
                                        </label>
                                        </div>
                                        ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="desc" rows="4" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg text-white">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit room modal -->
    <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Room</h5>                        
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control fs-5" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Area</label>
                                <input type="number" min="1" class="form-control fs-5" name="area" placeholder="In sq.ft." required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="text" min="1" class="form-control fs-5" name="price" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="text" min="1" class="form-control fs-5" name="quantity" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Adult (Max.)</label>
                                <input type="text" min="1" class="form-control fs-5" name="adult" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Children (Max.)</label>
                                <input type="text" min="1" class="form-control fs-5" name="children" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Features</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll($con, 'features');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                        <label>
                                        <input type='checkbox' name='features' value='$opt[id]' class='form-check-input'>
                                        $opt[name]
                                        </label>
                                        </div>
                                        ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Facilities</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll($con, 'facilities');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                        <label>
                                        <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input'>
                                        $opt[name]
                                        </label>
                                        </div>
                                        ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="desc" rows="4" class="form-control" required></textarea>
                            </div>
                            <input type="hidden" name="room_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg text-white">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Manage room images modal -->
    <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="room-images">Room name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-alert"></div>
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="add_image_form">
                            <label class="form-label fw-bold">Add image</label>
                            <input type="file" class="form-control mb-3" name="image" accept=".jpg, .png, .webp, .jpeg"
                                required>
                            <button class="btn custom-bg text-white">ADD</button>
                            <input type="hidden" name="room_id">
                        </form>
                    </div>
                    <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                        <table class="table table-hover border text-center">
                            <thead>
                                <tr class="bg-dark text-light stcky-top">
                                    <th scope="col" width="60%">Image</th>
                                    <th scope="col">Thumbnail</th>
                                    <th scope="col">Delete</th>                                    
                                </tr>
                            </thead>
                            <tbody id="room-image-data">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('js/jslink.php') ?>
    <script src="js/rooms.js"></script>
</body>

</html>