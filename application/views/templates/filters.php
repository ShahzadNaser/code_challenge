<section class="search-sec mt-6">
    <div class="container">
        <?php 
            echo form_open('#', array('id' => 'searchFilters'));
                echo("<div class='row'>");
                    echo("<div class='col-lg-12'>");
                        echo("<div class='row'>");
                            echo("<div class='col-lg-3 col-md-3 col-sm-12 p-0' data-tip='Product Name'>");
                                echo form_input(array( 
                                    'name'          => 'product_name',
                                    'id'            => 'product_name',
                                    'placeholder'   => 'Product Name',
                                    'class'         => 'form-control search-slt',
                                    'autocomplete'  => "off"
                                ));    
                                echo form_hidden(array('product_id'=> ''));
                            echo("</div>");
                            echo("<div class='col-lg-3 col-md-3 col-sm-12 p-0' data-tip='Customer Name'>");
                                echo form_input(array( 
                                    'name'          => 'customer_name',
                                    'id'            => 'customer_name',
                                    'placeholder'   => 'Customer Name',
                                    'class'         => 'form-control search-slt',
                                    'autocomplete'  => "off"
                                ));
                                echo form_hidden(array('customer_id'=> ''));      
                            echo("</div>");
                            echo("<div class='col-lg-3 col-md-3 col-sm-12 p-0' data-tip='Product Price'>");
                                echo form_input(array( 
                                    'name'          => 'product_price',
                                    'id'            => 'product_price',
                                    'placeholder'   => 'Product Price',
                                    'class'         => 'form-control search-slt',
                                    'autocomplete'  => "off"
                                ));
                            echo("</div>");
                            echo("<div class='col-lg-3 col-md-3 col-sm-12 p-0'>");
                                echo form_submit(array(
                                    'name'          => 'Search',
                                    'value'         => 'Search',
                                    'class'         => 'btn btn-primary wrn-btn'
                                ));   
                            echo("</div>");
                    echo("</div>");
                echo("</div>");
            echo("</div>");
        echo form_close(); ?>
    </div>
</section>