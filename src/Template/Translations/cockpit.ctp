<table class="table">
<?php
if (isset($original)) {
  echo '<tr><td>' . $original[0]['locale'] . '</td><td>' . $original[0]['status'] . '</td><td>' . $original[0]['cnt'] . '</td></tr>';
}

if (isset($tsets)) {
  foreach ($tsets as $t) {
      echo '<tr><td>' . $t['locale'] . '</td><td>' . $t['status'] . '</td><td>' . $t['cnt'] . '</td></tr>';
  }
}

?>
</table>
</div>
