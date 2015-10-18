<div class="navbar">
   <div class="navbar-inner">
      <ul class="nav nav-pills">
         <li><?= $this->Html->link('Step 1: ' . __('Import'), ['action' => 'import'],['title' => 'Import from pot File']) ?></li>
         <li><?= $this->Html->link('Step 2: ' . __('Prepare'), ['action' => 'prepare'],['title' => 'Prepare translation, please execute after each import (Step 1)']) ?></li>
         <li><?= $this->Html->link('Step 3a: ' . __('Google Translate'), ['action' => 'import']) ?></li>
         <li><?= $this->Html->link('Step 3b: ' . __('Manual Translate'), ['action' => 'import']) ?></li>
         <li><?= $this->Html->link('Step 4: ' . __('Export'), ['action' => 'export']) ?></li>
      </ul>
   </div>
</div>
