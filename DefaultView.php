<!DOCTYPE html>
<html>
<head>
    <!-- SIMPLE META -->
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, shrink-to-fit=no, user-scalable=yes">

    <!-- FAVICON & PAGE IDENTIFICATION -->
    <link data-id="favicon" rel="shortcut icon" href="<?= base_url("favicon.ico") ?>" type="image/x-icon">
    <title>Vuenized | CodeIgniter 4 with Vue JS 3 Application</title>
    <meta name="description" content="">
</head>
<body>
    <div id="app" data-page='<?= isset($app->getPageData()) ? $app->getPageData() : "" ?>'></div>
</body>
</html>
