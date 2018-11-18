<?php echo $this->element('subnavigation'); ?>
<div class="col-md-12">
    <h3><?= __('Translations') ?></h3>


    <table class="table">
        <thead>
        <tr>
        <?php
            echo $this->Form->create('WnkTranslation.Translation',['class' => 'form-inline','type' => 'GET']);
            echo '<th>' .$this->Form->input('msgstr', ['label' => false]) . '</th>';
            echo '<th>' .$this->Form->input('locale', ['label' => false,
                                                       'type' => 'select',
                                                       'multiple' => false,
                                                       'empty' => true,
                                                       'value' => $this->request->getQuery('locale'),
                                                       'options' => array_merge(
                                                         array($WnkTranslation['default_lang'] => $WnkTranslation['default_lang']),
                                                         array_combine($WnkTranslation['trans_lang'],$WnkTranslation['trans_lang'])
                                                        ) 
                                                      ]). '</th>';
            echo '<th>' .$this->Form->input('status', ['label' => false,'type' => 'select',
                         'multiple' => false, 
                         'options' => array('Original' => 'Original','NotTranslated' => 'NotTranslated','TranslatedByUser' => 'TranslatedByUser'), 
                         'empty' => true,
                         'value' => $this->request->getQuery('status')
                         ]). '</th>';
            echo'<th>' . $this->Form->button(__('Filter')) . '</th>';
            echo $this->Form->end();
        ?>
        </tr>


            <tr>
                <th><?= $this->Paginator->sort('msgstr') ?></th>
                <th><?= $this->Paginator->sort('locale') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('last_used') ?></th>

                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($translations as $translation): ?>
            <tr>
                <td><?= h($translation->msgstr) ?></td>
                <td><?= h($translation->locale) ?></td>
                <td><?= h($translation->status) ?></td>
                <td><?= h($translation->created) ?></td>
                <td><?= h($translation->last_used) ?></td>

                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $translation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $translation->id], ['target' => '_blank', 'rel'=>'nofollow']) ?>
                    <?= $this->Html->link(__('Propose better translation'), ['controller' => 'Proposedtranslations','action' => 'add', $translation->id], ['target' => '_blank', 'rel'=>'nofollow']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $translation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $translation->id), 'rel'=>'nofollow']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>


<?php echo '<small>Default Language:<b>' . $WnkTranslation['default_lang'] . '</b> additional Languages: ' . print_r($WnkTranslation['trans_lang'],true); ?>
