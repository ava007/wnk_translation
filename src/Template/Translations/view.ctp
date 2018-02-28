
<div class="col-md-8 col-xs-12">

   <nav class="large-3 medium-4 columns" id="actions-sidebar">
      <ul class="side-nav">
        <li><?= $this->Html->link(__('List Translations'), ['action' => 'index']) ?></li>
      </ul>
   </nav>
   <div class="container">
      <table>
        <tr><td>Msgid</td><td><?= $this->viewVars['translation']->msgid ?></td></tr>
        <tr><td><?= __('Language') ?></td><td><?= $this->viewVars['translation']->locale ?></td></tr>
        <tr><td><?= __('Last used') ?></td><td><?= $this->viewVars['translation']->last_used ?></td></tr>
        <tr><td><?= __('Status') ?></td><td><?= $this->viewVars['translation']->status ?></td></tr>
        <tr><td>MsgStr</td><td><?= $this->viewVars['translation']->msgstr ?></td></tr>
     </table>
     
     <a href="https://translate.google.com/#en/<?= $this->viewVars['translation']->locale ?>/<?= $this->viewVars['translation']->msgid ?> " rel="nofollow" target="_blank" class="btn">Google Translate</a>
     <a href="http://www.bing.com/translator/?ref=TThis&text=<?= $this->viewVars['translation']->msgid ?>&from=en&to=<?= $this->viewVars['translation']->locale ?>" rel="nofollow" target="_blank" class="btn">Bing Translate</a>
    
   </div>
</div>
