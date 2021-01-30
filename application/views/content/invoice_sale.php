<?php
$ids = explode(',', $invoice->item_ids);
$price = explode(',', $invoice->unit_prices);
$quantity = explode(',', $invoice->quantities);
?>
<div class="pull-right">
    <a class="btn btn-default" onclick="window.print()"><i class="glyphicon glyphicon-print"></i> Print</a>
    <div class="row">&nbsp;</div>
</div>

<div id="invoice" class="paid">
    <div class="this-is">
        <strong>Invoice</strong>
    </div><!-- invoice headline -->

    <header id="header">
            <div class="col-xs-12">
        <div class="invoice-intro">
            <h1><?php echo $this->session->userdata('brand');?></h1>
        </div>

        <dl class="invoice-meta">
            <dt class="invoice-due">&nbsp;</dt>
            <dd>&nbsp;</dd>
            <dt class="invoice-number">Invoice #</dt>
            <dd><?php echo $invoice->invoice_id ?></dd>
            <dt class="invoice-date">Date of Invoice</dt>
            <dd><?php echo $invoice->date ?></dd>
        </dl>
        </div>
    </header>
    <!-- e: invoice header -->

    <section id="parties" style="border: solid 1px white;">
        <div class="col-xs-12">
        <div class="invoice-from">
            <h2>Invoice To:</h2>
            <div id="hcard-Admiral-Valdore" class="vcard">
                <div class="org">Name: <?php echo $invoice->warehouse_name; ?></div>
                <div class="org">Contact Person: <?php echo $invoice->warehouse_incharge; ?></div>
                <div class="tel">Phone: <?php echo $invoice->warehouse_phone; ?></div>
                <div class="street-address">Address: <?php echo $invoice->warehouse_address; ?></div>
            </div><!-- e: vcard -->
        </div><!-- e invoice-from -->
        <div class="invoice-status">&nbsp;
        </div><!-- e: invoice-status -->
        <div class="invoice-to">
            <h2>Invoice From:</h2>
            <div id="hcard-Hiram-Roth" class="vcard">
                <div class="org">Name: <?php echo $this->session->userdata('brand'); ?></div>
                <div class="org">Invoice by: <?php echo $invoice->warehouse_incharge; ?></div>
                <div class="tel">Phone: <?php echo $this->session->userdata('phone'); ?></div>
                <div class="org">Address: <?php echo $this->session->userdata('address'); ?></div>
            </div><!-- e: vcard -->
        </div><!-- e invoice-to -->
        </div>
    </section><!-- e: invoice partis -->

    <section class="invoice-financials">
        <div class="invoice-items">
            <div class="col-xs-12">
            <table>
                <caption class="caption">Detail</caption>
                <thead>
                    <tr>
                        <th class="item_code">Code</th>
                        <th class="item_desc">Item &amp; Description</th>
                        <th>Quantity</th>
                        <th>Unit Price ( $USD )</th>
                        <th>Total ( $USD )</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($ids as $key => $id){ 
                    foreach ($items as $item){ 
                    if ($id == $item->item_id){  ?>
                        <tr>
                            <td class="item_code"><?php echo $item->item_code; ?></td>
                            <td class="item_desc"><?php echo $item->item_name; ?></td>
                            <td class="hidden-480"><?php echo $quantity[$key] ?></td>
                            <td class="hidden-480"><?php echo $price[$key] ?></td>
                            <td> <?php echo ($quantity[$key] * $price[$key]) ?></td>
                        </tr>
                        <?php
                        break;
                    }}} ?>
                </tbody>
            </table>
            </div>
        </div><!-- e: invoice items -->
        <br/><br/>
        <div class="invoice-totals">
            <div class="col-xs-12">
                <table>
                    <caption>Total:</caption>
                    <tbody>
                        <tr>
                            <td></td>
                            <th>Subtotal:</th>
                            <td><?php echo $invoice->total_price; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><!-- e: invoice totals -->
        <br/><br/><br/>

        <?php if ($invoice->note != '') { ?>
            <div class="invoice-notes col-xs-12">
                <h6>Note:</h6>
                <p><?php echo $invoice->note; ?></p>
            </div><!-- e: invoice-notes -->
        <?php } else { ?>
            <br/><br/><br/>
        <?php } ?>
    </section><!-- e: invoice financials -->
    <br/><br/>   <br/><br/>   <br/>
    <section id="signature">
        <div class="col-md-12">     
            <div class="col-md-4">
                <p>&nbsp;_____________________________</p>
                <p> &nbsp;&nbsp;
                    Signed for <?php echo $invoice->warehouse_name; ?>, Date
                </p>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <p>______________________________</p>
                <p> &nbsp;&nbsp;
                    Signed for <?php echo $this->session->userdata('brand'); ?>, Date
                </p>
            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">&nbsp;</div>
    </section>

    <footer id="footer">
        <p>&nbsp;
        </p>
    </footer>
</div><!-- e: invoice -->