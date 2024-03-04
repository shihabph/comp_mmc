<style>
    .result_table td {
        text-align: center;
    }

    .result_table td a {
        font-size: smaller;
    }
</style>

<div class="table-responsive-sm">
    <table class="table ">
        <thead class="thead-custom">
            <tr>
                <th>Session</th>
                <th>Voucher No</th>
                <th>Month</th>
                <th>Date of Payment</th>
                <th>Payment Method</th>
                <th>Paid Amount</th>
                <th>Balance Due</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        </tr>
        </thead>
        <tbody class="result_table">
            <?php foreach ($transactions as $transaction) {
            ?>
                <tr>
                    <td><?= $transaction['session_id']?></td>

                    <td><?php echo $transaction['voucher_no'] ?></td>
                    <td>Month Name</td>
                    <td><?php echo $transaction['transaction_date'] ?></td>
                    <td><?php echo $transaction['bank_name'] ?></td>
                    <td><?php echo $transaction['amount'] ?></td>
                    <td style="font-weight:600">Due Amount</td>
                    <td style="font-weight:600">Paid/Unpaid</td>
                    <td style="font-weight:600">Download Recipt</td>



                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
