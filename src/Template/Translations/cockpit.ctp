<table class="table">

<thead>
<tr><th>Language</th><th>Not Translated</th><th>Translated by User</th><th>Machine Translated</th></tr>
</thead>

<?php
if (isset($original)) {
  echo '<tr><td>' . $original[0]['locale'] . '</td><td colspan=3>' . $original[0]['status'] . 
  ': ' . $original[0]['cnt'] . '</td></tr>';
}

foreach ($WnkTranslation['trans_lang'] as $lng) {
   $lng_arr = array_filter($tsets, function ($k ) use ($lng) { return  $k['locale'] == $lng; }, ARRAY_FILTER_USE_BOTH);

   echo '<tr><td>' . $lng . '</td><td>';

   $key = array_filter($lng_arr, function ($k )  { return  $k['status'] =='NotTranslated'; }, ARRAY_FILTER_USE_BOTH);
   $k = array_column($key,'cnt');
   echo '<a href="/wnk-translation/translations/index?locale=' . $lng . '&status=NotTranslated">' . $k[0] . '</a>';
   echo '</td><td>';

   $key = array_filter($lng_arr, function ($k )  { return  $k['status'] =='TranslatedByUser'; }, ARRAY_FILTER_USE_BOTH);
   $k = array_column($key,'cnt');
   if (empty($k[0]))
     $k[0] = 0;
   echo '<a href="/wnk-translation/translations/index?locale=' . $lng . '&status=TranslatedByUser">' . $k[0] . '</a>';
   echo '</td><td>';

   $key = array_filter($lng_arr, function ($k )  { return  $k['status'] =='TranslatedByMachine'; }, ARRAY_FILTER_USE_BOTH);
   $k = array_column($key,'cnt');
   if (empty($k[0]))
      $k[0] = 0;
   echo '<a href="/wnk-translation/translations/index?locale=' . $lng . '&status=TranslatedByMachine">' . $k[0] . '</a>';
   
   echo '</td></tr>';
}
?>
</table>
