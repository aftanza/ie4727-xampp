<?php
$recipient = $_POST['customer_email'];
$order_status = $_POST['order_status'];
$order_id = $_POST['order_id'];
// $recipient = 'dummy@gmai.com';
// $order_status = 'sent';

$to = $recipient;
$subject = "Update on Your Order Status";

$txt = "Dear Customer,\n\n";
$txt .= "We are writing to update you on the status of your order of id: $order_id . ";
$txt .= "Your order is currently: $order_status.\n\n";
$txt .= "Thank you for shopping with us!\n\n";
$txt .= "Best Regards,\n";
$txt .= "IE4727";

$headers = "From: ie47727proj@example.com" . "\r\n" .
    "CC: support@example.com";

// if (mail($to, $subject, $txt, $headers)) {
//     echo 'Email sent successfully!';
// } else {
//     echo 'Failed to send email.';
// }

mail($to, $subject, $txt, $headers);
