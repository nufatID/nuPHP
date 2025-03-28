<?php

namespace Nufat\Nutemplete;

class BladeSyntax
{
    protected $environment;

    public function __construct($environment)
    {
        $this->environment = $environment;
    }
    protected function replaceLoopSyntax($content)
    {
        $patterns = [
            '/@for\s*\((.*?)\)\s*({{.*?}})/s',
            '/@foreach\s*\((.*?)\)\s*({{.*?}})/s',
            '/@forelse\s*\((.*?)\)\s*({{.*?}})\s*@empty\s*({{.*?}})\s*?@endforelse/s',
            '/@while\s*\((.*?)\)\s*({{.*?}})/s',
        ];

        $replacements = [
            '<?php for $1: ?>$2<?php endfor; ?>',
            '<?php foreach $1: ?>$2<?php endforeach; ?>',
            '<?php if(empty($1)): ?>$3<?php else: ?><?php foreach $1: ?>$2<?php endforeach; ?><?php endif; ?>',
            '<?php while $1: ?>$2<?php endwhile; ?>',
        ];

        return preg_replace($patterns, $replacements, $content);
    }
    public function replacePhpSyntax($content)
    {

        $content = preg_replace('/@islogin/', '<?php if (isLogin()) { ?>', $content);
        $content = preg_replace('/@else/', '<?php } else { ?>', $content);
        $content = preg_replace('/@end/', '<?php } ?>', $content);

        return $content;
    }
    public function replaceBladeSyntax($content, $variables)
    {
        $content = $this->replaceExtendSyntax($content);
        $content = $this->replaceSectionSyntax($content);
        $content = $this->replaceLoopSyntax($content);
        $content = $this->replacePhpSyntax($content);

        $patterns = [
            '/{{\s*\$(.*?)\s*}}/',
            '/{{\s*(.*?)\s*}}/'
        ];

        foreach ($patterns as $pattern) {
            $content = preg_replace_callback($pattern, function ($matches) use ($variables) {
                $keys = explode('.', $matches[1]);
                $value = $this->getValueFromArray($variables, $keys);

                if ($value !== null) {
                    return '<?php echo htmlspecialchars(' . var_export($value, true) . ', ENT_QUOTES, "UTF-8"); ?>';
                } else {
                    return $matches[0];
                }
            }, $content);
        }

        return $content;
    }

    protected function replaceSectionSyntax($content)
    {
        $patternSection = '/@section\(["\'](.+?)["\']\)/';
        $patternEndSection = '/@endsection/';

        $content = preg_replace_callback($patternSection, function ($matches) {
            return '<?php $this->block("' . $matches[1] . '") ?>';
        }, $content);

        $content = preg_replace($patternEndSection, '<?php $this->endblock() ?>', $content);

        return $content;
    }

    protected function replaceExtendSyntax($content)
    {
        $pattern = '/@extends\(["\'](.+?)["\']\)/';

        return preg_replace_callback($pattern, function ($matches) {
            $layoutPath = str_replace('.', DIRECTORY_SEPARATOR, $matches[1]) . '.nu.php';
            $layoutFullPath = $this->environment->getTemplateDir() . DIRECTORY_SEPARATOR . $layoutPath;

            if (file_exists($layoutFullPath)) {
                return '<?php $this->extend("' . $layoutPath . '"); ?>';
            } else {
                throw new \InvalidArgumentException(sprintf("Layout file %s could not be found", $layoutFullPath));
            }
        }, $content);
    }

    protected function getValueFromArray($array, $keys)
    {
        foreach ($keys as $key) {
            if (is_array($array) && array_key_exists($key, $array)) {
                $array = $array[$key];
            } else {
                return null;
            }
        }
        return $array;
    }
}
