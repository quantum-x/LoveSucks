<?php echo __('Thanks for your order') ?>
<?php echo __('Your order was approved, thank you.') ?>

<?php echo __('For your reference, payment summary is below:') ?>
<?php echo __('Order ID:') ?> <?php echo $order['Order']['slug']; ?>
<?php echo __('Transaction ID:') ?> <?php echo $order['Transaction']['biller_id']; ?>
<?php echo __('Amount:') ?> <?php echo $order['Currency']['symbol']; ?><?php echo $order['Transaction']['amount']; ?>
<?php echo __('Lock Size:') ?> <?php echo __($order['Size']['size']); ?>
<?php echo __('We\'re loading up the bolt-cutters, and heading to the the nearest bridge infested with selfie-taking-horribly-in-love couples, and will pry you off a lock. As soon as the video is uploaded, we\'ll send you another email.') ?>
<?php if ($has_extra === true) { ?><?php echo __('You apparently give a fuck about the environment, so we\'ll toss the lock in the recycling.<br />In the meantime, ask yourself why you care for the environment more than other people\'s happiness. That\'s fairly fucking twisted.')?><br><?php } ?>
<?php echo __('Or, you can refresh your order summary %s like it\'s a FedEx delivery.',$order_url) ?>