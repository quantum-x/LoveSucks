<td class="padded" style="padding: 0;vertical-align: top;padding-left: 32px;padding-right: 32px">

            <h1 style="Margin-top: 0;color: #565656;font-weight: 700;font-size: 36px;Margin-bottom: 18px;font-family: sans-serif;line-height: 42px"><?php echo __('Thanks for your order') ?></h1><p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><?php echo __('Your order was approved, thank you.') ?><br>
<?php echo __('For your reference, payment summary is below:') ?></p><blockquote style="Margin-top: 0;Margin-right: 0;Margin-bottom: 0;padding-right: 0;font-style: italic;font-size: 14px;border-left: 2px solid #e9e9e9;Margin-left: 0;padding-left: 16px"><p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 24px"><strong style="font-weight: bold"><?php echo __('Order ID:') ?></strong>&nbsp;<?php echo $order['Order']['slug']; ?><br>
<strong style="font-weight: bold"><?php echo __('Transaction ID:') ?></strong><em>&nbsp;<?php echo $order['Transaction']['biller_id']; ?></em><br>
<strong style="font-weight: bold"><?php echo __('Amount:') ?></strong><em>&nbsp;<?php echo $order['Currency']['symbol']; ?><?php echo $order['Transaction']['amount']; ?></em><br>
<strong style="font-weight: bold"><?php echo __('Lock Size:') ?></strong><em>&nbsp;<?php echo __($order['Size']['size']); ?></em><br></p></blockquote><p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><?php echo __('We\'re loading up the bolt-cutters, and heading to the the nearest bridge infested with selfie-taking-horribly-in-love couples, and will pry you off a lock. As soon as the video is uploaded, we\'ll send you another email.') ?></p><?php if ($has_extra === true) { ?><p><?php echo __('You apparently give a fuck about the environment, so we\'ll toss the lock in the recycling.<br />In the meantime, ask yourself why you care for the environment more than other people\'s happiness. That\'s fairly fucking twisted.')?></p><?php } ?><p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 24px"><?php echo __('Or, you can refresh <a style="text-decoration: underline;transition: all .2s;color: #41637e" href="%s">your order summary</a> like it\'s a FedEx delivery.',$order_url) ?></p>

                            </td>