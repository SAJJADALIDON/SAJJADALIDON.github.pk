<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Munna Khan">
        <title>Inventory</title>

        <!--Header-->
        <?php echo $header; ?>
        
        <!--Page Specific Header-->
        <?php
        if (isset($extra_head)) {
            echo $extra_head;
        }
        ?>
    </head>
    <body>
        <div class="container">
            <!--Top Navigation-->
            <div class="row">
                <?php echo (isset($navigation)) ? $navigation : ''; ?>
            </div>
            <div id="note">
                <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';?>   
            </div>
            <section class="content">
                <?php echo (isset($content)) ? $content : ''; ?>
            </section> <!--content-->

            <!--Footer-->
            <?php echo $footer; ?>
            <!--Page Specific Footer-->
            <?php
            if (isset($extra_footer)) {
                echo $extra_footer;
            }
            ?>
        </div> <!--Container-->
    </body>
</html>