<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Template_component <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Template <?php echo form_error('id_template') ?></label>
            <input type="text" class="form-control" name="id_template" id="id_template" placeholder="Id Template" value="<?php echo $id_template; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Component <?php echo form_error('id_component') ?></label>
            <input type="text" class="form-control" name="id_component" id="id_component" placeholder="Id Component" value="<?php echo $id_component; ?>" />
        </div>
	    <input type="hidden" name="" value="<?php echo $; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('template_component') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>