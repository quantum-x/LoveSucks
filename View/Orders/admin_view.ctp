<div class="orders view">
<h2><?php echo __('Order'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($order['Order']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['User']['name'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($order['Order']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Size'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Size']['size'], array('controller' => 'sizes', 'action' => 'view', $order['Size']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Status']['status'], array('controller' => 'statuses', 'action' => 'view', $order['Status']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($order['Order']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($order['Order']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($order['Order']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order'), array('action' => 'edit', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order'), array('action' => 'delete', $order['Order']['id']), array(), __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sizes'), array('controller' => 'sizes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Size'), array('controller' => 'sizes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('controller' => 'transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction'), array('controller' => 'transactions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Videos'), array('controller' => 'videos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video'), array('controller' => 'videos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Credit Cards'), array('controller' => 'credit_cards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Credit Card'), array('controller' => 'credit_cards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Extras'), array('controller' => 'order_extras', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Extra'), array('controller' => 'order_extras', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Transactions'); ?></h3>
	<?php if (!empty($order['Transaction'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $order['Transaction']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Order Id'); ?></dt>
		<dd>
	<?php echo $order['Transaction']['order_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Biller Id'); ?></dt>
		<dd>
	<?php echo $order['Transaction']['biller_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
	<?php echo $order['Transaction']['amount']; ?>
&nbsp;</dd>
		<dt><?php echo __('Currency Id'); ?></dt>
		<dd>
	<?php echo $order['Transaction']['currency_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Status Id'); ?></dt>
		<dd>
	<?php echo $order['Transaction']['status_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Result'); ?></dt>
		<dd>
	<?php echo $order['Transaction']['result']; ?>
&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
	<?php echo $order['Transaction']['created']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
	<?php echo $order['Transaction']['modified']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Transaction'), array('controller' => 'transactions', 'action' => 'edit', $order['Transaction']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Videos'); ?></h3>
	<?php if (!empty($order['Video'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $order['Video']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Order Id'); ?></dt>
		<dd>
	<?php echo $order['Video']['order_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
	<?php echo $order['Video']['title']; ?>
&nbsp;</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
	<?php echo $order['Video']['description']; ?>
&nbsp;</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
	<?php echo $order['Video']['slug']; ?>
&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
	<?php echo $order['Video']['created']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
	<?php echo $order['Video']['modified']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Video'), array('controller' => 'videos', 'action' => 'edit', $order['Video']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Credit Cards'); ?></h3>
	<?php if (!empty($order['CreditCard'])): ?>
		<dl>
			</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Credit Card'), array('controller' => 'credit_cards', 'action' => 'edit', $order['CreditCard']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php echo __('Related Order Extras'); ?></h3>
	<?php if (!empty($order['OrderExtra'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Order Id'); ?></th>
		<th><?php echo __('Extra Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($order['OrderExtra'] as $orderExtra): ?>
		<tr>
			<td><?php echo $orderExtra['id']; ?></td>
			<td><?php echo $orderExtra['order_id']; ?></td>
			<td><?php echo $orderExtra['extra_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'order_extras', 'action' => 'view', $orderExtra['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'order_extras', 'action' => 'edit', $orderExtra['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'order_extras', 'action' => 'delete', $orderExtra['id']), array(), __('Are you sure you want to delete # %s?', $orderExtra['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order Extra'), array('controller' => 'order_extras', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
