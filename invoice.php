<?php
require "components/connection.php";
require_once('tcpdf/tcpdf.php'); // Include TCPDF library

// Check if the download button is clicked
if (isset($_POST['download_invoice'])) {
    $orderId = $_POST['order_id'];

    // Generate PDF invoice
    generatePDFInvoice($orderId, $conn);
}

function generatePDFInvoice($orderId, $conn)
{
    ob_start(); // Start output buffering
    // Fetch order details from database
    $orderSql = "SELECT * FROM `orders` WHERE id = '$orderId'";
    $orderResult = mysqli_query($conn, $orderSql);

    // Check if query was successful
    if (!$orderResult) {
        die('Error fetching order details: ' . mysqli_error($conn));
    }

    // Check if order exists
    if (mysqli_num_rows($orderResult) == 0) {
        die('Order not found');
    }

    // Fetch the order details
    $order = mysqli_fetch_assoc($orderResult);

    // Create new PDF document
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator('Your Name');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Invoice');
    $pdf->SetSubject('Invoice');

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Add content to PDF
    $html = '
    <html>
    <head>
        <style>
            body { font-family: helvetica; }
            .invoice-container { width: 100%; }
            .invoice .header h1 { max-width: 50px; }
            .invoice .header h2 { text-align: right;  }
            .invoice .intro { margin-bottom: 20px; }
            .invoice .intro td { padding: 5px 0px; }
            .invoice .details { padding-bottom: 50px; }
            .invoice .details th, .invoice .details td { border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; text-align: center; }
            .invoice .totals { margin-top: 20px; }
            .invoice .totals td { padding: 8px; }
            .additional-info h5 { font-size: 12px; color: #1779ba; }
            
        </style>
    </head>
    <body>
        <div class="invoice-container">
            <table class="invoice">
                <tr class="header">
                    <td>
                        <h1 style="color: #F38BA0; font-family:KENAO;">Eclante team</h2>
                    </td>
                    <td class="align-right">
                        <h2 style="font-weight:200;">Invoice</h2>
                    </td>
                </tr>
                <br>
                <tr class="intro">
                    <td style="color:#6C6C6C;">
                        Hello, ' . $order['name'] . '.<br>
                        Thank you for your order.
                    </td>
                    <td style="color:#6C6C6C;" class="text-right">
                        <span class="num">Order #' . $order['id'] . '</span><br>
                        ' . $order['created_at'] . '
                    </td>
                </tr>
                <br><br>
                <tr class="details">
                    <td colspan="2">
                        <table>
                            <thead>
                                <tr>
                                    <th class="desc"><b>Item Description</b></th>
                                    <th class="id"><b>Item ID</b></th>
                                    <th class="qty"><b>Quantity</b></th>
                                    <th class="amt"><b>Subtotal</b></th>
                                </tr>
                            </thead>
                            <tbody>
                            <br>';

    // Fetch ordered products data
    $orderedProductsSql = "SELECT op.*, p.name AS product_name, p.mrp FROM `ordered-products` AS op JOIN `products` AS p ON op.product_id = p.id WHERE op.order_id = '$orderId'";
    $orderedProductsResult = mysqli_query($conn, $orderedProductsSql);

    // Loop through ordered products
    while ($product = mysqli_fetch_assoc($orderedProductsResult)) {
        $html .= '<tr class="item">
                    <td style="color:#6C6C6C;" class="desc">' . $product['product_name'] . '</td>
                    <td style="color:#6C6C6C;" class="id num">' . $product['id'] . '</td>
                    <td style="color:#6C6C6C;" class="qty">' . $product['quantity'] . '</td>
                    <td style="color:#6C6C6C;" class="amt">Rs.' . $product['mrp'] * $product['quantity'] . '</td>
                  </tr> <br>';
    }

    $html .= '</tbody>
                
                        </table>
                    </td> 
                </tr>
                <tr class="totals">
                    <td></td>
                    <td>
                    <br><br><br><br>
                        <table>
                            <tr class="subtotal">
                                <td style="color:#6C6C6C;" class="num">Subtotal</td>
                                <td style="color:#6C6C6C;" class="num">Rs.' . $order['total'] . '</td>
                            </tr>
                            <tr class="fees">
                                <td style="color:#6C6C6C;" class="num">Shipping & Handling</td>
                                <td style="color:#6C6C6C;" class="num">Rs.0.00</td>
                            </tr>
                            <tr class="tax">
                                <td style="color:#6C6C6C;" class="num">Tax (7%)</td>
                                <td style="color:#6C6C6C;" class="num">Rs.' . ($order['total'] * 0.07) . '</td>
                            </tr>
                            <tr class="total">
                                <td><b>Total</b></td>
                                <td><b>Rs.' . ($order['total'] * 1.07) . '</b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br><br><br><br>
            <section class="additional-info">
                <h5  style="color: #F38BA0;">Billing Information</h5>
                <p>' . $order['name'] . '<br>
                    ' . $order['address'] . ', ' . $order['city'] . ', ' . $order['state'] . ', ' . $order['zip'] . '<br>
                    India</p>
                <h5  style="color: #F38BA0;">Payment Information</h5>
                <p>' . $order['payment_method'] . '</p>
            </section>
        </div>
    </body>
    </html>';

    // Output HTML to PDF
    $pdf->writeHTML($html);

    // Output PDF as a download
    $pdf->Output('invoice.pdf', 'D');

    ob_end_flush(); // End output buffering and flush buffer
    exit;
}
?>
