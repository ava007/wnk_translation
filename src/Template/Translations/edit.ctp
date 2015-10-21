<div class="translations form large-9 medium-8 columns content">
    <?= $this->Form->create($translation) ?>
    <fieldset>
        <legend><?= __('Edit Translation') ?></legend>
        <?php
            echo $this->Form->input('msgid');
            echo $this->Form->input('locale');
            echo $this->Form->input('last_used');
            echo $this->Form->input('status');
            echo $this->Form->input('msgstr');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
