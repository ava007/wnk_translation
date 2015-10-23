<div class="col-md-8 col-xs-12">

   <nav class="large-3 medium-4 columns" id="actions-sidebar">
      <ul class="side-nav">
        <li><?= $this->Html->link(__('List Translations'), ['action' => 'index']) ?></li>
      </ul>
   </nav>
   <div class="container">
      <?= $this->Form->create(null, ['class' => 'form-horizontal']); ?>
      <fieldset>
         <legend><?= __('Edit Translation') ?></legend>

         <div class="form-group">
            <label class="control-label col-md-2"><?= __('Language to be translated') ?></label>
            <div class="col-md-4">
                 <select class="form-control" name="lang" id="lang">
                 <?php foreach ($lang as $lng) {
                     echo '<option value="'.$lng['locale'].'">Language: '.$lng['locale'].', items to be translated: '.$lng['count'].'</option>';
                 }
                 ?>
                 </select>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-md-2">Google Key</label>
            <div class="col-md-3"><input name="gkey" id="gkey" /></div>
         </div>
      </fieldset>
      <?= $this->Form->button(__('Translate'),['class' => 'btn btn-primary']) ?>
      <?= $this->Form->end() ?>
      <script type="text/javascript">document.getElementById("locale").focus()</script>
   </div>
</div>
