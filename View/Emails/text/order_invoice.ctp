Thanks for your order
Your order was approved, thank you.

For your reference, payment summary is below:
Order ID: <?php echo $order['Order']['slug']; ?>
Transaction ID: <?php echo $order['Transaction']['biller_id']; ?>
Amount: <?php echo $order['Transaction']['Currency']['symbol']; ?><?php echo $order['Transaction']['amount']; ?>
Lock Size: <?php echo $order['Size']['size']; ?>

We're loading up the bolt-cutters, and heading to the the nearest bridge infested with selfie-taking-horribly-in-love couples, and will pry you off a lock. As soon as the video is uploaded, we'll send you another email.
Or, you can refresh your order summary <?php echo $order_url; ?> like it's a FedEx delivery.