<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo MPG_APP_NAME . ' v' . MPG_APP_VERSION; ?></title>

    <link rel="stylesheet" href="<?php echo MPG_BASE_URL; ?>/static/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo MPG_BASE_URL; ?>/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo MPG_BASE_URL; ?>/static/css/mpg.login.css">

    <script src="<?php echo MPG_BASE_URL; ?>/static/js/mpg.login.js"></script>

</head>

<body>

    <div class="container h-100">

        <?php 
        if ( isset($errors) ) :
        ?>

            <div class="alert alert-danger text-center" role="alert">
                Please fill these fields: <?php echo join(', ', $errors); ?>
            </div>

        <?php
        endif;
        ?>

        <div class="d-flex justify-content-center h-100">

            <div class="card">

                <div class="card-header">
                    <h3 class="text-center"><?php echo MPG_APP_NAME; ?></h3>
                </div>
                
                <div class="card-body">

                    <form method="POST">

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-uri"></i></span>
                            </div>
                            <input type="text" class="form-control" <?php if($url=getenv('MONGO_URL')) { echo 'value="'.$url.'"'; } ?> placeholder="uri" name="uri">
                        </div>

                        <br>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="User" name="user">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-server"></i></span>
                            </div>
                            <input type="text" class="form-control" <?php if($host=getenv('MONGO_HOST')) { echo 'value="'.$host.'"'; } ?> placeholder="Host" name="host" >
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-filter"></i></span>
                            </div>
                            <input type="text" class="form-control" <?php if($port=getenv('MONGO_PORT')) { echo 'value="'.$port.'"'; } else { echo 'value="21017"'; } ?> name="port" >
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-database"></i></span>
                            </div>
                            <input type="text" class="form-control" <?php if($db=getenv('MONGO_SCHEMA')) { echo 'value="'.$db.'"'; } ?> placeholder="Database" name="database">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-authsource"></i></span>
                            </div>
                            <input type="text" class="form-control" value="admin" name="authsource">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-ssl"></i></span>
                            </div>
                            <input type="text" class="form-control" value="false" name="ssl">
                        </div>

                        <div class="form-group">
                            <input id="mpg-login-button" type="submit" name="login" value="Login" class="btn btn-primary float-right">
                        </div>

                    </form>
                    
                </div>
                
                <div class="card-footer d-none">
                </div>
                
            </div>
            
        </div>
        
    </div>

</body>
</html>