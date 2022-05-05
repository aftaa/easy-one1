<?php
/** @var $this \easy\MVC\View */
$this->layout = 'docs';
$this->params['title'] = 'Установка';
?>
<h1>Установка</h1>
<p>
    При установленном <a href="https://getcomposer.org/">Composer</a>, установка выполняется командой

<code>
    composer create-project aftaa/easy-one folder
</code>
    где <i>folder</i> - папка назначения (обычно соответствует расположению домена).
</p>

<p></p>
<code>
    RewriteEngine on<br>
<br>
    # Если запрашиваемая в URL директория или файл существуют обращаемся к ним напрямую<br>
    RewriteCond %{REQUEST_FILENAME} !-f<br>
    RewriteCond %{REQUEST_FILENAME} !-d<br>
    # Если нет - перенаправляем запрос на index.php<br>
    RewriteRule . index.php<br>
</code>