			<!--- start-recent-posts----->
			<div class="recent-posts" id="blog">
				<div class="wrap">
				<div class="recent-posts-head">
					<h3><?php echo __('Thank you') ?></h3>
					<p><?php echo __('Your order has been approved!') ?></p>
				</div>
				<div class="summary">
					<h4><?php echo __('Order Summary') ?></h4>
					<ul>
						<li><b><?php echo __('Order Number:') ?></b> <?php echo $order['Order']['slug'] ?></li>
						<li><b><?php echo __('Transaction ID:') ?></b> <?php echo $order['Transaction']['biller_id'] ?></li>
						<li><b><?php echo __('Amount:') ?></b> <?php echo $order['Transaction']['Currency']['symbol'] ?><?php echo $order['Transaction']['amount'] ?></li>
						<li><b><?php echo __('Lock Size:') ?></b> <?php echo __($order['Size']['size']) ?></li>
						<li><b><?php echo __('Message:') ?></b> <?php echo $order['Order']['message'] ?></li>
						<li><b><?php echo __('Status:') ?></b> <?php echo __($order['Status']['status']) ?></li>
						<?php if (!empty($order['OrderExtra']) && $order['OrderExtra'][0]['Extra']['name'] == "bio") { ?>
						    <li><?php echo __('You apparently give a fuck about the environment, so we\'ll toss the lock in the recycling.<br />In the meantime, ask yourself why you care for the environment more than other people\'s happiness. That's fairly fucking twisted.')?></li>
						<?php } ?>
					</ul>
					<?php if (isset($order['Video']['slug']) && !empty($order['Video']['slug'])) { ?>
    					<h4><a href="<?php echo $this->Html->url(array('controller' => 'videos', 'action' => 'view', $order['Order']['slug']))?>"><?php echo __('Your video') ?></a></h4>
					<?php } ?>
				</div>
				<ol class="blue white-text">
					<li>
						<h4><?php echo __('Sit tight') ?></h4>
						<p><?php echo __('We\'re going to go out and execute a lock on your behalf. This requires us going outside. And if you\'ve ever tried walking around a city at midnight with boltcutters, you\'ll know why we prefer daytime.') ?>
						<?php echo __('Within 24 hours (or so..) - we\'ll have cut your lock, and you\'ll get an email. You can also refresh this page lots, because it will update.') ?></p>
					</li>
					<li>
						<h4><?php echo __('Share your video, tell your friends.') ?></h4>
						<p><?php echo __('You\'ll get an email with your video link. Send it to your friends. Brag about it to your mother.') ?>
						<?php echo __('Use it to mock your stupidly-in-love friends and co-workers. Especially the ones that recently took a trip to Paris.') ?></p>
					</li>
				</ol>
			</div>
			<!--- //End-recent-posts----->