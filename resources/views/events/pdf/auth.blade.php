<div class="pdf-authorities">
  <?php
  $i = 0;
  $authorities = [1, 2, 3, 4];

  foreach ($authorities as $authority) {
    if ($i === 0) {
      echo "<div class=\"group\">";
    }

    echo "<div class=\"name\">
      PREFIJO TAL. AUTORIDAD TAL $authority
      <br>
      TITULO TAL
    </div>";

    if ($i === 1) {
      $i = 0;
      echo "</div>";
      continue;
    }
    $i++;
  }
  ?>
</div>