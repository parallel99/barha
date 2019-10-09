<?php if (!isset($_COOKIE["cookieok"]) || $_COOKIE["cookieok"] != 1) {?>
<div class="alert alert-primary cookie-alert">
  Az oldalon <strong>sütiket használunk</strong> annak érdekében, hogy a lehető legjobb felhasználói élményt nyújtsuk.
  <form method="post" style="display: inline"><button type="submit" name="cookie-OK" class="btn btn-primary">Elfogad</button></form>
</div>
<?php
}
