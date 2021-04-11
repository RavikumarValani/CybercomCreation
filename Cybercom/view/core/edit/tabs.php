<?php $tabs = $this->getTabs(); ?>
<?php foreach ($tabs as $key => $tab): ?>
    <a class="btn btn-primary" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl(null,null,['tab' => $key]); ?>').load()"><?php echo $tab['label']; ?></a><br><br>
<?php endforeach; ?>
