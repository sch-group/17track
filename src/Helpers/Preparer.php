<?php


namespace SchGroup\SeventeenTrack\Helpers;


class Preparer
{
    /**
     * @param array $array
     * @param string $keyName
     * @return array
     */
    public function makeUniqueArray(array $array, string $keyName) : array
    {
        $uniqueArray = array();
        foreach ($array as $key => $value) {
            if (!isset($new_array[$value[$keyName]])) {
                $uniqueArray[$value[$keyName]] = $value;
            }
        }

        return array_values($uniqueArray);
    }
}