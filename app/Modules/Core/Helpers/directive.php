<?php

Blade::directive('errors', function ($expression) {
    $return = "<?php if(View::shared('errors')->has($expression)) : ?>";
    $return .= "<span class=\"help-block text-danger\">
                      <strong>{{ View::shared('errors')->first($expression) }}</strong>
                  </span>";
    $return .= "<?php endif;?>";
    return $return;
});