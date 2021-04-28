<?php
    /* param1:$adjacencyMatrix [in]ノードとコストを羅列した行列 */
    /* retval:各ノードに対する最短経路をあらわした配列 */
    function dijkstra(array $adjacencyMatrix): ?array
    {
        /* 最初のノード番号を0とする。 */
        define('START_POINT', 0);
        define('NODE_NUM', count($adjacencyMatrix));

        /* 初期化 */
        /* 各ノード番号に対するコストを負に、通過済みフラグをfalseにする。 */
        for ($i = 0; $i < NODE_NUM; $i++){
            $currentCost[$i] = -1;
            $fix[$i] = false;
        }

        /* スタート地点のコストを0とする。 */
        $currentCost[START_POINT] = 0;

        while (true){
            /* ノードの最短コストを確定させるまで演算する。 */
            $minNode = -1;
            $minCost = -1;
            for ($i = 0; $i < NODE_NUM; $i++){
                if (($fix[$i] == false       )
                &&  ($currentCost[$i] != -1 )){
                    /* パターンの洗い出しが完了していない */
                    if (($minCost == -1             )
                    ||  ($minCost > $currentCost[$i])){
                        /* まだ最短経路を見つけられていない */
                        $minCost = $currentCost[$i];
                        $minNode = $i;
                    }
                }
            }
            if ($minCost == -1){
                /* 上記for文にて更新がないということは、洗い出し完了済み */
                break;
            }

            /* スタート地点から伸びている全てのノードのコストを調べる。 */
            for ($i = 0; $i < NODE_NUM; $i++){
                if (($fix[$i] == false                      )
                &&  ($adjacencyMatrix[$minNode][$i] > 0  )){
                    /* 自分のノード経由での必要コスト */
                    $newCost = $minCost + $adjacencyMatrix[$minNode][$i];
                    if (($currentCost[$i] == -1     )
                    ||  ($currentCost[$i] > $newCost)){
                        /* コスト未登録もしくは現状コストよりも新しく計算したコストのほうが小さい場合は更新 */
                        $currentCost[$i] = $newCost;
                    }
                }
            }
            /* 現在のノード更新 */
            $fix[$minNode] = true;
        }

        return $currentCost;
    }
?>