<div class="navbar">
   <div class="navbar-inner">
      <ul class="nav nav-pills">
         <li class="nav-item"><?= $this->Html->link('Step 1: ' . __('Import'), ['action' => 'import'],['title' => 'Import from pot File']) ?></li>
         <li class="nav-item"><?= $this->Html->link('Step 2: ' . __('Prepare'), ['action' => 'prepare'],['title' => 'Prepare translation, please execute after each import (Step 1)']) ?></li>
         <li class="nav-item"><?= $this->Html->link('Step 3a: ' . __('Google Translate'), ['action' => 'googletranslate'],['title' => 'Machine translation using Google API']) ?></li>
         <li class="nav-item"><?= $this->Html->link('Step 3b: ' . __('Manual Translate'), ['action' => 'index'],['title' => 'Edit each language item in the list below']) ?></li>
         <li class="nav-item"><?= $this->Html->link('Step 4: ' . __('Export'), ['action' => 'export'],['title' => 'Export translations to po-Files']) ?></li>
      </ul>
   </div>
</div>
