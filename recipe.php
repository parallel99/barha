<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | <?php echo($_GET['name']); ?></title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("none");
            echo "<h6 id=\"email\" style=\"display: none\">" . $_SESSION['user']['email'] . "</h6>";
        ?>
        <div class="container recipe-container">
            <div class="row">
                <div class="col-sm-5">
                    <h1 id="name"><?php echo $_GET['name'] ?></h1>
                    <hr>
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo "<div class=\"favourite\"><div class=\"favourite-star\"></div><h5>Hozzáadás a kedvencekhez</h5></div>";
                    }
                    ?>
                    <hr>
                    <h3>Hozzávalók</h3>
                    <div class="ingredients">
                        <ul>
                            <li>Lorem ipsum</li>
                            <li>Donec gravida</li>
                            <li>Nunc mattis malesuada</li>
                            <li>Curabitur risus nunc</li>
                            <li>Vestibulum</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-7">
                    <img src="/images/test-recipe.jpg" loading="lazy" alt="<?php echo($_GET['name']); ?>">
                </div>
            </div>
            <div class="row">
                <div class="recipe">
                    <h3>Elkészítés</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec semper sem nec purus condimentum facilisis. Ut sollicitudin turpis at dolor gravida, vitae aliquam lorem accumsan. Aenean efficitur mollis convallis. Nam fringilla ligula arcu, quis interdum justo blandit non. Donec semper, ipsum eu malesuada ornare, turpis quam volutpat turpis, id iaculis diam nulla vel lectus. Vivamus suscipit venenatis orci sit amet vestibulum. Mauris semper sollicitudin orci, eget tincidunt mi facilisis a. Quisque vitae ultricies arcu. Sed at lacinia sem, non consectetur risus.</p>

                    <p>Donec gravida, magna in aliquam facilisis, enim dolor tempus ex, a sagittis elit erat vitae magna. Proin volutpat feugiat augue nec tempus. Fusce faucibus elementum elit vitae aliquam. Fusce ultricies eu dolor luctus suscipit. Aliquam vel iaculis lacus, sit amet laoreet nibh. Duis tristique lectus sed justo blandit, in feugiat nisi porta. Nunc vel pellentesque velit. Pellentesque condimentum nisi sed ex commodo, quis commodo ligula euismod. Sed accumsan eu mi eu tincidunt. Curabitur risus nunc, volutpat ultricies consectetur eu, mollis accumsan neque. Phasellus iaculis auctor orci in congue. Sed laoreet tortor non dui pretium viverra. Nunc at varius eros. Phasellus posuere diam eget lectus ultrices elementum.</p>

                    <p>Nunc mattis malesuada iaculis. Duis facilisis ullamcorper ante et iaculis. Sed fringilla dui a erat aliquam, ac posuere enim scelerisque. Pellentesque vitae dolor quis justo rutrum elementum id quis leo. Fusce blandit velit dui, et auctor turpis malesuada ac. Nullam sagittis id nisl a sollicitudin. In hac habitasse platea dictumst. Phasellus quis sodales ex. Ut nisl leo, fringilla sollicitudin neque id, venenatis egestas diam. Cras eget iaculis tellus. Phasellus porta placerat diam. Nam consectetur cursus malesuada. Ut molestie est quam, eu hendrerit enim pellentesque at. Integer ultricies sem a congue facilisis.</p>

                    <p>Curabitur risus nunc, rutrum at quam vitae, mollis gravida massa. Integer augue arcu, dictum id imperdiet eget, imperdiet in sapien. Proin ultrices fringilla orci, finibus ultrices mi. Morbi elit metus, fringilla sit amet semper vel, consequat euismod nisi. Aliquam sed augue et nisi pretium ultricies. Duis ipsum diam, ullamcorper eu egestas ac, porta sed nisl. Integer molestie felis non ullamcorper blandit. Nulla lectus ipsum, aliquet non nisi non, aliquet bibendum nunc. Nulla vel dapibus nulla. Nullam molestie libero quis tellus dapibus, a tempus ante laoreet. Phasellus urna justo, tristique ullamcorper ipsum vel, lacinia faucibus libero. Nulla eget magna sit amet nunc bibendum tempus. Etiam in orci in enim tempor efficitur nec id mauris. Vivamus et varius purus, et consequat neque.</p>

                    <p>Vestibulum suscipit ornare nibh, non dignissim augue hendrerit sodales. Vestibulum aliquet porta nibh, et hendrerit est vulputate non. Sed tincidunt luctus blandit. Vestibulum maximus malesuada urna, nec pellentesque augue tincidunt vitae. Sed in orci nibh. Donec et sem id lacus porta tempor sed nec mauris. Curabitur tincidunt tristique orci, id fringilla libero consectetur vel. Morbi maximus erat ex, pretium euismod ex fringilla in. Nunc sit amet tristique mauris. Morbi et odio tristique, feugiat velit nec, rhoncus augue.</p>
                </div>
            </div>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
    <script>
    $(".favourite").click(function() {
        $.ajax({
        url: 'include/addToFavourite.php',
                type: 'post',
                data: {
                    "name": $("#name").text(),
                    "email": $("#email").text()
                },
                success: function (response) {
                    $('html').append(response)
                },
                error: function (data) {}
        });
    });
    </script>
</html>
