<?php

namespace TaskForce\Helper;

class Stars
{
    public static function render(float $score): string
    {
        $markup = '';
        for ($i = 0; $i < 5; $i++) {
            $markup .= '<span ' . ($i < floor($score) ? '' : 'class="star-disabled"') . '></span>';
        }
        return $markup;
    }
}