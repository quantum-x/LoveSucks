<?php echo $user['User']['first_name']; ?> -
<?php echo __('There was recently a request made to reset your password.')?>.
<?php echo __('To complete the reset, simply click on the link below:')?>

<?php echo $reset_url; ?>

<?php echo __("If you didn't request a password reset, simply discard this email.")?>