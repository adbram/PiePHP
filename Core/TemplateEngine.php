<?php
namespace Core;

class TemplateEngine
{
    private static $_rules = [
        '/\{\{(.*)\}\}/' => '<?= htmlentities(($1)) ?>',
        '/\s*\@if\s*\((.*)\)\s*/' => '<?php if (($1)): ?>',
        '/\s*\@else\s*if\s*\((.*)\)\s*/' => '<?php elseif (($1)): ?>',
        '/\s*\@else\s*/' => '<?php else: ?>',
        '/\s*\@endif\s*/' => '<?php endif; ?>',
        '/\s*\@foreach\s*\((.*)\)\s*/' => '<?php foreach (($1)): ?>',
        '/\s*\@endforeach\s*/' => '<?php endforeach; ?>',
        '/\s*\@isset\s*\((.*)\)\s*/' => '<?php if (isset(($1))): ?>',
        '/\s*\@endisset\s*/' => '<?php endif; ?>',
        '/\s*\@empty\s*\((.*)\)\s*/' => '<?php if (empty(($1))): ?>',
        '/\s*\@endempty\s*/' => '<?php endif; ?>',
        '/\s*\@while\s*\((.*)\)\s*/' => '<?php while (($1)): ?>',
        '/\s*\@endwhile\s*/' => '<?php endwhile; ?>'
    ];

    public static function parsePHP($file)
    {
        if(file_exists($file)) {
            $content = file_get_contents($file);
            $newcontent = preg_replace(array_keys(self::$_rules), self::$_rules, $content);
            file_put_contents($file, $newcontent);
        }
    }
}