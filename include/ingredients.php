<script>
    let ingredients = [];
    $(function () {
        $("#ingredients1").autocomplete({
            source: ingredients
        });
    });
    $.ajax({
        url: 'getIngredients.php',
        type: 'post',
        cache: true,
        success: function (response) {
            $("body").append(response);
        },
        error: function (data) {
            ingredients.push("Hiba");
        }
    });
</script>
