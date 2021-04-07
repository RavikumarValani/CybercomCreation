<?php $tabs = $this->getTabs(); ?>
<?php foreach ($tabs as $key => $tab): ?>
    <a class="btn btn-primary" href="<?php echo $this->getUrl()->getUrl(null,null,['tab' => $key]); ?>"><?php echo $tab['label']; ?></a><br><br>
<?php endforeach; ?>
