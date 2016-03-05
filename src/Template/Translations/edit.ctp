<div class="col-md-8 col-xs-12">

   <nav class="large-3 medium-4 columns" id="actions-sidebar">
      <ul class="side-nav">
        <li><?= $this->Html->link(__('List Translations'), ['action' => 'index']) ?></li>
      </ul>
   </nav>
   <div class="container">
      <?= $this->Form->create($translation, ['class' => 'form-horizontal']); ?>
      <fieldset>
         <legend><?= __('Edit Translation') ?></legend>

         <div class="form-group">
            <label class="control-label col-md-2"><?= 'Msgid' ?></label>
            <div class="col-md-3"><p class="form-control-static"><?= $this->viewVars['translation']->msgid ?></p></div>
         </div>

         <div class="form-group">
            <label class="control-label col-md-2"><?= __('Language') ?></label>
            <div class="col-md-3"><p class="form-control-static"><?= $this->viewVars['translation']->locale ?></p></div>
         </div>

         <div class="form-group">
            <label class="control-label col-md-2"><?= __('Last used') ?></label>
            <div class="col-md-3"><p class="form-control-static"><?= $this->viewVars['translation']->last_used ?></p></div>
         </div>

         <div class="form-group">
            <label class="control-label col-md-2">Status</label>
            <div class="col-md-3"><p class="form-control-static"><?= $this->viewVars['translation']->status ?></p></div>
         </div>

         <div class="form-group">
            <label class="control-label col-md-2">MsgStr</label>
            <div class="col-md-3">
               <text<?= 'area'?> name="msgstr" id="msgstr" rows="4" cols="72"><?= $this->viewVars['translation']->msgstr ?></text<?= 'area'?>>
            </div>
         </div>
   

      </fieldset>
      <?= $this->Form->button(__('Save'),['class' => 'btn btn-primary']) ?>
      <?= $this->Form->end() ?>
      <script type="text/javascript">document.getElementById("msgstr").focus()</script>
      
      <a href="https://translate.google.com/#en/<?= $this->viewVars['translation']->locale ?>/<?= $this->viewVars['translation']->msgid ?> " rel="nofollow" target="_blank" class="btn">Google Translate</a>
      
      <a href="http://www.bing.com/translator/?ref=TThis&text=<?= $this->viewVars['translation']->msgid ?>&from=en&to=<?= $this->viewVars['translation']->locale ?>" rel="nofollow" target="_blank" clas="btn">Bing Translate</a>

      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $translation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $translation->id), 'class' => 'btn btn-danger']
         ) ?>
   </div>
</div>
