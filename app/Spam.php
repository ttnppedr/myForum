<?php

namespace App;

class Spam
{
    public function detect($body)
    {
        $this->detectinvalidKeywords($body);

        return false;
    }

    protected function detectinvalidKeywords($body)
    {
        $invalidKeywords = [
            'yahoo customer support'
        ];

        foreach ($invalidKeywords as $keyword) {
            if (stripos(request('body'), $keyword) !== false) {
                throw new \Exception('Your reply contains spam');
            }
        }
    }
}