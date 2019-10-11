<?php if (!isset($_COOKIE["cookieok"]) || $_COOKIE["cookieok"] != 1) {?>
<div class="alert alert-primary cookie-alert">
  Az oldalon <strong>sütiket használunk</strong> annak érdekében, hogy a lehető legjobb felhasználói élményt nyújtsuk.
  <div style="display: inline-block; cursor: pointer" class="btn btn-primary cookie">Elfogad</div>
</div>
<script>
$(document).ready(function(){
  $(".cookie").click(function(){
    $(".cookie-alert").hide(300, "swing");
    var now = new Date();
    var time = now.getTime();
    var expireTime = time + 3600*576*7*30*12*5;
    now.setTime(expireTime);
    document.cookie = 'cookieok=1;expires='+now.toGMTString()+';path=/';
  });
});
</script>
<?php
}
