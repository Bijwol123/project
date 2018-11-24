<div class="articles index large-9 medium-8 columns content">
    <h3><?= __('Articles') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('S.No') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Category') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($articles)) {foreach ($articles as $key => $article): ?>
             <?php // debug($article);die(); ?>
            <tr>
                <td><?php echo $key+1;?></td>
                <td><?= h($article->title) ?></td>
                <td><?= h($article->created) ?></td>
                <td><?= h($article->modified) ?></td>
                <?php ?>
                <td><?= h($article->category->title) ?></td>
            </tr>
            <?php endforeach; } ?>
        </tbody>
    </table>
   <?php echo $this->element('pagination');?>
</div>