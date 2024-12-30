<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require('../css/csslink.php');
    ?>
    <title><?php echo $settings_r['site_title'] ?> - facilities</title>
    <style>
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
    </style>
</head>

<body class="bg-light">

    <?php
    require('header.php');
    ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Doloribus ex magnam nemo <br> voluptatibus, obcaecati
            optio quibusdam soluta impedit nisi expedita.
        </p>
    </div>

    <div class="container">
        <div class="row">
            <?php
                $res = selectAll($con,'facilities');
                $path = Facilities_IMG_PATH;

                while ($row = $res->fetch_assoc())
                {
                    echo <<< data
                        <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                        <div class="d-flex align-items-center mb-2">
                        <img src="$path$row[icon]" width="40px" alt="Image not found">
                        <h5 class="m-0 ms-3">$row[name]</h5>
                        </div>
                        <p>
                        $row[description]
                        </p>
                        </div>
                        </div>
                    data;
                }
            ?>
        </div>
    </div>
    <?php
    require('footer.php');
    ?>
</body>

</html>