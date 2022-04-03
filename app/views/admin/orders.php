<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
    <div class="row pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <h1 class="text-center display-4 my-5">All Orders</h1>
            <hr>
            <?php flash('update_message'); ?>
            <div class="table-responsive" style="max-height:600px">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center thead-light">
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Customer ID</th>
                            <th>Status</th>
                            <th>Ordered Date</th>
                            <th>Total Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['orders'] as $order) { ?>
                        <tr class="text-center text-nowrap">
                            <td><?php echo $order->order_id; ?></td>
                            <td><?php echo $order->customer_name; ?></td>
                            <td><?php echo $order->customer_id; ?></td>
                            <td>
                                <select class="options form-control-sm">
                                    <option
                                        value="<?php getLink('admin/setOrderStatus/' . $order->order_id . '?status=Pending'); ?>"
                                        <?php echo $order->status == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option
                                        value="<?php getLink('admin/setOrderStatus/' . $order->order_id . '?status=Confirmed'); ?>"
                                        <?php echo $order->status == 'Confirmed' ? 'selected' : ''; ?>>Confirmed
                                    </option>
                                    <option
                                        value="<?php getLink('admin/setOrderStatus/' . $order->order_id . '?status=In Process'); ?>"
                                        <?php echo $order->status == 'In Process' ? 'selected' : ''; ?>>In Process
                                    </option>
                                    <option
                                        value="<?php getLink('admin/setOrderStatus/' . $order->order_id . '?status=Ready For Delivery'); ?>"
                                        <?php echo $order->status == 'Ready For Delivery' ? 'selected' : ''; ?>>Ready
                                        For Delivery</option>
                                    <option
                                        value="<?php getLink('admin/setOrderStatus/' . $order->order_id . '?status=Delivered'); ?>"
                                        <?php echo $order->status == 'Delivered' ? 'selected' : ''; ?>>Delivered
                                    </option>
                                    <option
                                        value="<?php getLink('admin/setOrderStatus/' . $order->order_id . '?status=Refunded'); ?>"
                                        <?php echo $order->status == 'Refunded' ? 'selected' : ''; ?>>Refunded</option>
                                </select>
                            </td>
                            <td><?php echo $order->date; ?></td>
                            <td>Rs <?php echo number_format($order->total_amount); ?></td>
                            <td class="text-wrap">
                                <a href="<?php getLink('admin/order/' . $order->order_id); ?>"
                                    class="btn btn-primary m-1"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
var options = Array.from(document.getElementsByClassName('options'));
options.forEach(function(option) {
    option.addEventListener('change', function() {
        window.location = this.value;
    });
})
</script>

<?php require APPROOT . '/views/inc/dashboard-footer.php'; ?>