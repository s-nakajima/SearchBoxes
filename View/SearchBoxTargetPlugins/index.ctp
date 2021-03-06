<div class="searchBoxTargetPlugins index">
	<h2><?php echo __('Search Box Target Plugins'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('search_box_id'); ?></th>
			<th><?php echo $this->Paginator->sort('plugin_key'); ?></th>
			<th><?php echo $this->Paginator->sort('created_user'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified_user'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($searchBoxTargetPlugins as $searchBoxTargetPlugin): ?>
	<tr>
		<td><?php echo h($searchBoxTargetPlugin['SearchBoxTargetPlugin']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($searchBoxTargetPlugin['SearchBox']['id'], array('controller' => 'search_boxes', 'action' => 'view', $searchBoxTargetPlugin['SearchBox']['id'])); ?>
		</td>
		<td><?php echo h($searchBoxTargetPlugin['SearchBoxTargetPlugin']['plugin_key']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($searchBoxTargetPlugin['TrackableCreator']['id'], array('controller' => 'users', 'action' => 'view', $searchBoxTargetPlugin['TrackableCreator']['id'])); ?>
		</td>
		<td><?php echo h($searchBoxTargetPlugin['SearchBoxTargetPlugin']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($searchBoxTargetPlugin['TrackableUpdater']['id'], array('controller' => 'users', 'action' => 'view', $searchBoxTargetPlugin['TrackableUpdater']['id'])); ?>
		</td>
		<td><?php echo h($searchBoxTargetPlugin['SearchBoxTargetPlugin']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $searchBoxTargetPlugin['SearchBoxTargetPlugin']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $searchBoxTargetPlugin['SearchBoxTargetPlugin']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $searchBoxTargetPlugin['SearchBoxTargetPlugin']['id']), null, __('Are you sure you want to delete # %s?', $searchBoxTargetPlugin['SearchBoxTargetPlugin']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Search Box Target Plugin'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Search Boxes'), array('controller' => 'search_boxes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Search Box'), array('controller' => 'search_boxes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trackable Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
