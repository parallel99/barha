<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<?php if (!isset($_COOKIE["cookieok"]) || $_COOKIE["cookieok"] != 1) { ?>
    <div class="alert alert-primary cookie-alert">
        Az oldalon <strong>sütiket használunk</strong> annak érdekében, hogy a lehető legjobb felhasználói élményt
        nyújtsuk.
        <div style="display: inline-block; cursor: pointer" class="btn btn-primary cookie">Elfogad</div>
    </div>
    <script>
        $(document).ready(function () {
            $(".cookie").click(function () {
                $(".cookie-alert").hide(300, "swing");
                let now = new Date();
                let time = now.getTime();
                let expireTime = time + 3600 * 576 * 7 * 30 * 300;
                now.setTime(expireTime);
                document.cookie = 'cookieok=1;expires=' + now.toGMTString() + ';path=/';
            });
        });
    </script>
    <?php
}
