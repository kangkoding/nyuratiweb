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
        <h2 style="margin-top:0px">Template_component Read</h2>
        <table class="table">
	    <tr><td>Id Template</td><td><?php echo $id_template; ?></td></tr>
	    <tr><td>Id Component</td><td><?php echo $id_component; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('template_component') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>