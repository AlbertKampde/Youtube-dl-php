<?php

namespace Youtubedl;
use Exception;
use Youtubedl\Option\IPv4;

/**
 * @method Option setOutput(string $output)
 * @method Option getListExtractors()
 * @method Option getExtractorDescriptions()
 * @method Option setUserAgent(string $userAgent)
 * @method Option dumpUserAgent()
 */
class Option
{
    protected $options = [];

    public function __call($method, $args)
    {
        $cleanMethod = lcfirst(preg_replace('/get|set/', null, $method));
        if (preg_match_all('/[A-Z]/', $cleanMethod, $uppers)) {
            if (!is_array($uppers)) {
                throw new \Exception('$uppers must be an array');
            }
            foreach (current($uppers) as $key => $upper) {
                $cleanMethod = str_replace($upper, '-'.strtolower($upper), $cleanMethod);
            }
        }
        $this->options[$cleanMethod] = current($args) ? '"'.current($args).'"' : null;

        return $this;
    }

    public function __toString()
    {
        return $this->formatAll();
    }

    /**
     *
     */
    public function setAsIPv4()
    {
        $this->options[] = (new IPv4());
    }

    /**
     * @throws Exception
     * @return string
     */
    public function format()
    {
        throw new Exception('Must be implemented by the child classes');
    }

    /**
     * @return string
     * @throws Exception
     */
    private function formatAll()
    {
        $output = '';
        foreach ($this->options as $key => $option) {
            if ($option instanceof Option) {
                $output .= $option->format();
            } else {
                $output .= "--{$key} {$option} ";
            }
        }

        return $output;
    }
}
