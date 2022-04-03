<?php require APPROOT . '/views/inc/dashboard-header.php';?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
    <div class="row pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <h1 class="text-center display-4 my-5">All Customers</h1>
            <hr>
            <div class="table-responsive" style="max-height:600px">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center thead-light">
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>Email ID</th>
                            <th>Subscriber</th>
                            <th>Address</th>
                            <th>Since</th>
                            <th>Amount Spent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $db = new Database();?>
                        <?php foreach ($data['customers'] as $customer) {?>
                        <tr>
                            <td><?php echo $customer->customer_id; ?></td>
                            <td><?php echo $customer->first_name . ' ' . $customer->last_name; ?></td>
                            <td><?php echo $customer->email_id; ?></td>
                            <td><?php echo $customer->subscriber ? 'Yes' : 'No'; ?></td>
                            <td><?php echo $customer->email_id; ?></td>
                            <td><?php echo $customer->created_at; ?></td>
                            <?php
$db->query("SELECT SUM(total_amount) AS total_amount_spent FROM orders WHERE customer_id = $customer->customer_id");
    $total_amount_spent = $db->fetchOne()->total_amount_spent;
    ?>
                            <td><?php echo $total_amount_spent ? 'Rs ' . number_format($total_amount_spent) : 'None'; ?>
                            </td>
                        </tr>
                        <?php }?>
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

<?php require APPROOT . '/views/inc/dashboard-footer.php';?>