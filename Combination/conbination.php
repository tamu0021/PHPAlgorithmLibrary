<?php
    function combination(array $arr, int $r): ?array
    {
        // 重複した値を削除して，数値添字配列にする
        $arr = array_values(array_unique($arr));
    
        $n = count($arr);
        $result = []; // 最終的に二次元配列にして返す
    
        // nCr の条件に一致していなければ null を返す
        if($r < 0 || $n < $r){ return null; }
    
        if($r === 1){
            foreach($arr as $item){
                $result[] = [$item];
            }
        }
    
        if($r > 1){
            // n - r + 1 回ループ
            for($i = 0; $i < $n-$r+1; $i++){
                // $sliced は $i + 1 番目から末尾までの要素
                $sliced = array_slice($arr, $i + 1);
                // 再帰処理 二次元配列が返ってくる
                $recursion = combination($sliced, $r - 1);
                foreach($recursion as $one_set){
                    array_unshift($one_set, $arr[$i]);
                    $result[] = $one_set;
                }
            }
        }
    
        return $result;
    }
?>