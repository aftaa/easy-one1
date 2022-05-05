<link rel="stylesheet" type="text/css" href="/css/easy/debug.css">
<div id="debug-bottom">
    <ul>
        <li>
            <a data-href="debug-bottom-container">Service Container</a>
            <div id="debug-bottom-container" class="debug-bottom-sub">
                <?php
                echo '<h2 >Container</h2><pre>';
                print_r(\easy\Application::$serviceContainer->getInstances());
                echo '</pre>';
                ?>
            </div>
        </li>
        <li>
            <a data-href="debug-bottom-queries">Queries</a>
            <div id="debug-bottom-queries" class="debug-bottom-sub">
                <?= \easy\Application::$serviceContainer->init(\easy\helpers\QueryTimes::class)->debug() ?>
            </div>
        </li>
        <li>
            <a data-href="debug-bottom-routes">Routes</a>
            <div id="debug-bottom-routes" class="debug-bottom-sub">
                <?= \easy\Application::$serviceContainer->init(\easy\basic\Router::class)->debug() ?>
            </div>
        </li>
        <li>
            <a data-href="">
                <?php
                /** @var \easy\helpers\TimeExecution $timeExecution */
                $timeExecution = \easy\Application::$serviceContainer->init(\easy\helpers\TimeExecution::class);
                echo $timeExecution->stop(), 'sec.';
                ?>
            </a>
            <div id="debug-bottom-routes" class="debug-bottom-sub">
            </div>
        </li>
    </ul>
</div>

<script src="/js/jquery.js"></script>
<script type="text/javascript">
    $('#debug-bottom a').on('click', function () {
        $('div.debug-bottom-sub').fadeOut('slow');
        let id = $(this).data('href');
        $('#' + id).toggle();
    });
</script>