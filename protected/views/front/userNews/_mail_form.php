<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Добавлена новая новость</title>
    </head>
    <body>
        <p><strong><?php echo $model->user_name ?></strong></p>
        <p><strong><?php echo $model->user_email ?></strong></p>
        <p><strong><?php echo $model->user_phone ?></strong></p>
        <p <?php echo htmlspecialchars($model->title); ?></p>
        <p><?php echo htmlspecialchars($model->fulltext); ?></p>
    </body>
</html>