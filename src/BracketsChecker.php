<?php

namespace Myklon\BracketsChecker;
use PHPUnit\Framework\EmptyStringException;

class BracketsChecker
{
    protected array $openBrackets = ['(', '[', '{', '<'];
    protected array $closeBrackets = [')', ']', '}', '>'];
    public string $valideString = '';

    public function check(string $str): bool
    {
        $validStr = $this->validate($str);
        return $this->isCorrect($validStr);

    }

    public function getAvailableBrackets() : string
    {
        $brackets = '';
        $size = count($this->openBrackets);
        for($i = 0; $i < $size; $i++)
        {
            $brackets .= $this->openBrackets[$i] . $this->closeBrackets[$i];
        }
        return $brackets;
    }

    protected function validate($str)
    {
        $validStr = trim($str);
        $validStr = htmlspecialchars($validStr);
        if(empty($validStr))
        {
            throw new EmptyStringException("Строка не может быть пустой");
        }
        $this->valideString = $validStr;
        return $validStr;
    }

    protected function isCorrect(string $str)
    {
        $arr = str_split($str);
        $last = 0;
        foreach ($arr as $value) {
            if ($value == '(') {
                $last++;
            } elseif ($value == ')') {
                $last--;
            }
            if ($last == -1) {
                return false;
            }
        }
        return !($last > 0);
    }
}