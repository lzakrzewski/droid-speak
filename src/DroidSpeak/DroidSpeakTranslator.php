<?php

declare(strict_types=1);

namespace DroidSpeak;

use DroidSpeak\Exception\CanNotTranslateInputException;

class DroidSpeakTranslator
{
    public function translate(array $input): array
    {
        $result = [];

        foreach ($input as $key => $value) {
            if (true == \is_array($value)) {
                $result[$key] = $this->translate($value);

                continue;
            }

            $result[$key] = $this->translateValue($value);
        }

        return $result;
    }

    private function translateValue(string $value): string
    {
        $chars = explode(' ', $value);

        $translatedChars = array_map(
            function (string $char) {
                if (0 === preg_match('~^[01]+$~', $char)) {
                    throw new CanNotTranslateInputException(sprintf('Given string "%s" is not binary.', $char));
                }

                return \chr(bindec($char));
            },
            $chars
        );

        return implode('', $translatedChars);
    }
}
