<div class="col-lg-2">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>		
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index'), array('class' => 'btn btn-default')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add'), array('class' => 'btn btn-default')); ?> </li>		
	</ul>
</div>
<div class="col-lg-10">
	<h2><?php echo __('Users'); ?></h2>
	<div class="table-responsive">
		<table class="table">
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('username'); ?></th>
				<th><?php echo $this->Paginator->sort('contact_number'); ?></th>
				
				<th><?php echo $this->Paginator->sort('company_id'); ?></th>
				<th><?php echo $this->Paginator->sort('date_created'); ?></th>
				
				<!--th><?php echo $this->Paginator->sort('status'); ?></th-->
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['contact_number']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($user['Company']['name'], array('controller' => 'companies', 'action' => 'view', $user['Company']['id'])); ?>
				</td>
				<td><?php echo h($user['User']['date_created']); ?>&nbsp;</td>				
				<!--td><?php echo h($user['User']['status']); ?>&nbsp;</td-->
				<td class="actions">
					<!--?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id']), array('class' => 'btn btn-warning')); ?-->
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-warning')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-warning'), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<?php echo $this->element('pagination');?>
</div>

