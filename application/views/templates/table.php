<div class="bd-example text-left" style="margin-top:10px;" >
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Customer Email</th>
                <th scope="col">Sale's Date</th>
                <th scope="col">Product Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($sales)>0){
                    $total_price = 0;
                    foreach($sales as $sale){
                        $total_price = $total_price+$sale['price'];
            ?>
                <tr>
                    <td><?= $sale['product_name'];?></td>
                    <td><?= $sale['customer_name'];?></td>
                    <td><?= $sale['customer_email'];?></td>
                    <td><?= date('Y-m-d',strtotime($sale['created_at']));?></td>
                    <td><?= $sale['price'];?></td>
                </tr>
            <?php } ?>
                <tr>            
                    <td colspan="4"><b>Total Price</b> </td>
                    <td><b><?= $total_price;?></b></td>
                </tr>
            <?php }else{ ?>
            <tr>
                <td colspan="5" class="text-center">No Record Found.</td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>