<?php if(isset($order)) { ?>
    <script>
        ga('ecommerce:addTransaction', {
          'id': '<?php echo $order['Order']['slug'] ?>',                     // Transaction ID. Required.
          'revenue': '<?php echo $order['Transaction']['amount'] ?>',               // Grand Total.
          'currency': '<?php echo $order['Transaction']['Currency']['currency'] ?>'
        });

      ga('ecommerce:addItem', {
        'id': '<?php echo $order['Order']['slug'] ?>',                     // Transaction ID. Required.
        'name': '<?php echo $order['Size']['size'] ?>',
        'price': '<?php echo $order['Price']['price' ?>',
        'quantity': '1',
        'currency': '<?php echo $order['Transaction']['Currency']['currency'] ?>' // local currency code.
      });
      ga('ecommerce:send');
    </script>
<?php } ?>