<?php

namespace Myklon\BracketsChecker;

class BracketsChecker
{
    protected array $openBrackets = ['(', '[', '{'];
    protected array $closeBrackets = [')', ']', '}'];
    public string $baseString = '';
    public string $validString = '';

    public function check(string $str): bool
    {
        $validString = $this->validateString($str);
        $validArray = $this->validateArray($validString);
        return $this->isCorrect($validArray);
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

    protected function validateString($str): string
    {
        $validStr = trim($str);
        $validStr = htmlspecialchars($validStr);
        var_dump($validStr);
        if(empty($validStr)) {
            throw new \InvalidArgumentException("Строка не может быть пустой");
        }
        $this->baseString = $validStr;
        return $validStr;
    }

    protected function validateArray(string $validString): array
    {
        $validArray = str_split($validString);
        $validArray = array_filter($validArray, function ($v) {
            return in_array($v, $this->openBrackets) || in_array($v, $this->closeBrackets);
        });
        if(empty($validArray)) {
            throw new \InvalidArgumentException("Строка не содержит необходимых символов");
        }
        $this->validString = implode($validArray);
        return $validArray;
    }

    protected function isCorrect(array $validArray): bool
    {
        $stack = [];
        foreach ($validArray as $bracket) {
            if (in_array($bracket, $this->openBrackets)) {
                $stack[] = $bracket;
            } else {
                $prev = array_pop($stack);
                // Поиск ключа текущей закрывающей скобки и её сравнение c ключом последней открывающей скобки
                if (array_search($bracket, $this->closeBrackets) !== array_search($prev, $this->openBrackets)) {
                    return false;
                }
            }
        }
        return empty($stack);
    }
}