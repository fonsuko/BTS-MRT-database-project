<?php
class UCSQueue extends SplHeap
{
    public function compare($array1, $array2)
    {
        if ($array1[1] === $array2[1]) return 0;
        return $array1[1] > $array2[1] ? -1 : 1;
    }
}
