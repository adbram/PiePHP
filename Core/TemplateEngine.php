<?php
namespace Core;

class TemplateEngine
{
    private static $_rules = [
        '/\{\{(.*)\}\}/' => '<?= htmlentities($1) ?>',
        '/\@if\s*\((.*)\)/' => '<?php if ($1): ?>',
        '/\@else\s*if\s*\((.*)\)/' => '<?php elseif ($1): ?>',
        '/\@else/' => '<?php else: ?>',
        '/\@endif/' => '<?php endif; ?>',
        '/\@foreach\s*\((.*)\)/' => '<?php foreach ($1): ?>',
        '/\@endforeach/' => '<?php endforeach; ?>',
        '/\@isset\s*\((.*)\)/' => '<?php if (isset($1)): ?>',
        '/\@endisset/' => '<?php endif; ?>',
        '/\@empty\s*\((.*)\)/' => '<?php if (empty($1)): ?>',
        '/\@endempty/' => '<?php endif; ?>',
        '/\@while\s*\((.*)\)/' => '<?php while ($1): ?>',
        '/\@endwhile/' => '<?php endwhile; ?>'
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