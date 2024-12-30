<?php
require_once ('essentials.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Carousel</title>
    <?php
    require ('css/csslink.php');
    ?>
</head>

<body class="bg-light">
    <?php require_once ('header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Carousel</h3>
                
                <!-- Carousel section -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex align-item-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Images</h5>
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                data-bs-target="#carousel-s">
                                Add
                                <i class="bi bi-plus-square"></i>
                            </button>
                        </div>

                        <div class="row" id="carousel-data">                            
                        </div>
                    </div>
                </div>

                <!--Carousel Modal -->
                <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="carousel_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Add Image(for carousel)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Picture</label>
                                        <input type="file" class="form-control" name="carousel_picture"
                                            id="carousel_picture_inp" accept=".jpg, .png, .webp, .jpeg" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="carousel_picture.value=''" class="btn text-secondary"
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
    <script src="js/Carousel.js"></script>
</body>

</html>