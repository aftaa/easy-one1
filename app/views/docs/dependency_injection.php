<?php
/** @var $this \easy\MVC\View */
$this->layout = 'docs';
$this->params['title'] = 'Установка';
?>
<h1>Dependency Injection</h1>
<p>
    Dependency Injection используется по умолчанию для экшенов в контроллерах и для инжекшена
    в конструкторах сервисов. Под сервисами понимаются любые классы, расположенные в app/* директориях.
</p>
<h2>Dependency Injection в экшенах</h2>
<code>
    class LoginController extends Controller<br>
    {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;public function login(Request $request, Authenticate $authenticate, RememberMe $rememberMe)<br>
    &nbsp;&nbsp;&nbsp;&nbsp;{<br>
    ...<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$email = $request->query('email');<br>
    ...<br>
    &nbsp;&nbsp;&nbsp;&nbsp;}<br>
    }<br>
</code>
<p>
    Объект <b>easy\http\Request</b> - оболочка над входными аргументами скрипта, его методы:<br>
    <i>Request::query($name)</i> - берет переменную $_REQUEST[$name];<br>
    <i>Request::get($name)</i> - берет переменную $_GET[$name];<br>
    <i>Request::post($name)</i> - берет переменную $_POST[$name];<br>
</p>