<?php

#Redirect function if user logged in, default to index.php
function redirect($url = "")
{
    echo
    "<script>
        window.location.href='" . $url . "';
    </script>";
}

function verifyCategory($getCategoryId, $categoryId)
{
    return $getCategoryId === $categoryId;
}

#Handle status to return it to javascript fetch
function throwStatusMessage($status)
{
    $jsonStatus = json_encode($status);
    echo $jsonStatus;
}

function createFilter(string $key, mixed $value, string | null $operator = null): array
{
    return ['column' => strval($key), 'operator' => strval($operator), 'value' => $value];
}

function generateSQLConditions(
    $filter = [],
    $sorter = ['id' => 'ASC'],
    $paginator = []
) {
    // handle filter
    $whereCondition = '';
    if (!empty($filter)) {
        $filterConditions = [];
        foreach ($filter as $filterItem) {
            if (!empty($filterItem['table']) && !empty($filterItem['column'])) {
                $filterConditions[] = "{$filterItem['table']}.{$filterItem['column']} LIKE '%{$filterItem['value']}%'";
            }
        }
        if (!empty($filterConditions)) {
            $whereCondition = 'WHERE ' . implode(' AND ', $filterConditions);
        }
    }

    // handle sorter
    $sortConditions = [];
    foreach ($sorter as $column => $order) {
        $sortConditions[] = "$column $order";
    }
    $orderByCondition = 'ORDER BY ' . implode(', ', $sortConditions);

    // handle paginator
    $limitCondition = '';
    $offsetCondition = '';
    if (!empty($paginator)) {
        if (!isset($paginator['limit'])) {
            throw new Exception('Invalid paginator param');
        }
        if (isset($paginator['page'])) {
            $offset = ($paginator['page'] - 1) * $paginator['limit'];
            $offsetCondition = 'OFFSET ' . $offset;
        }
        $limitCondition = 'LIMIT ' . $paginator['limit'];
    }

    return [
        'where' => $whereCondition,
        'orderBy' => $orderByCondition,
        'limit' => $limitCondition,
        'offset' => $offsetCondition
    ];
}

function getSQLQuery($projection = [], $join = [], $selection = [], $pagination = [], $sort = [])
{
    $sqlClauses = [];

    // handle select clause
    $sqlClauses[] = "SELECT " . implode(', ', array_map(function ($projectionItem) {
        $as = '';
        if (isset($projectionItem['as']) && $projectionItem['as']) {
            $as = "AS {$projectionItem['as']}";
        }
        return "{$projectionItem['table']}.{$projectionItem['column']} $as";
    }, $projection));

    // handle from clause
    $tables = $join['tables'];
    $on = $join['on'];
    if (count($tables) < 2) {
        return;
    }
    $joinClauses = [
        "{$tables[0]} JOIN {$tables[1]} ON {$on[0]['table1']}.{$on[0]['column1']} = {$on[0]['table2']}.{$on[0]['column2']}"
    ];
    for ($i = 2; $i < count($tables); $i++) {
        $joinClauses[] = "JOIN {$tables[$i]} ON {$on[$i - 1]['table1']}.{$on[$i - 1]['column1']} = {$on[$i - 1]['table2']}.{$on[$i - 1]['column2']}";
    }
    $sqlClauses[] = 'FROM ' . implode(" ", $joinClauses);

    // handle where clause
    /**
        [
            'table' => 'product',
            'column' => 'name',
            'value' => 'vn',
            'like' => true
            'int' => false,
        ]
     */
    $selectClauses = [];
    foreach ($selection as $selectItem) {
        $compareOperator = '=';
        $selectValue = '';
        if ($selectItem['like'] && !$selectItem['int']) {
            $compareOperator = 'LIKE';
            $selectValue = "{$selectItem['value']}";
        } else {
            $selectValue = "'{$selectItem['value']}'";
        }
        $selectClauses[] = "{$selectItem['table']}.{$selectItem['column']} $compareOperator $selectValue";
    }
    $sqlClauses[] = 'WHERE ' . implode(' AND ', $selectClauses);

    // handle order by clause
    $sqlClauses[] = "ORDER BY {$sort['table']}.{$sort['column']} {$sort['order']}";

    // handle limit offset clause
    if (isset($pagination['limit']) && isset($pagination['offset'])) {
        $sqlClauses[] = 'LIMIT ' . $pagination['limit'];
        $sqlClauses[] = 'OFFSET ' . $pagination['offset'];
    }

    return implode(' ', $sqlClauses);
}

// getSQLQuery(
//     [
//         [
//             "table" => "product",
//             "column" => "id"
//         ],
//         [
//             "table" => "product",
//             "column" => "name"
//         ]
//     ],
//     [
//         "tables" => [
//             "product",
//             "category",
//             "user",
//         ],
//         "on" => [
//             [
//                 'table1' => 'product',
//                 'table2' => 'category',
//                 'column1' => 'categoryId',
//                 'column2' => 'id'
//             ],
//             [
//                 'table1' => 'product',
//                 'table2' => 'user',
//                 'column1' => 'createdBy',
//                 'column2' => 'id'
//             ]
//         ]
//     ],
//     [
//         [
//             'table' => 'product',
//             'column' => 'name',
//             'value' => 'vn',
//             'like' => true,
//             'int' => false
//         ]
//     ],
//     [
//         'offset' => 0,
//         'limit' => 10
//     ]
// );

function deleteFileByURL($url)
{
    $pathToDelete = $_SERVER['DOCUMENT_ROOT'] . parse_url($url)['path'];
    if (file_exists($pathToDelete)) {
        unlink($pathToDelete);
        return;
    }
}

function checkFileExistsInLocalByURL($url)
{
    $pathToDelete = $_SERVER['DOCUMENT_ROOT'] . parse_url($url)['path'];
    if (file_exists($pathToDelete)) {
        return true;
    }
    return false;
}

function deleteFieldsHasEmptyString($array)
{
    return array_filter($array, function ($value) {
        return $value !== '';
    });
}

// Handle get order status

function pendingStatus()
{
    return "#ea5455";
}

function paidStatus()
{
    return "#28c76f";
}

function deliveringStatus()
{
    return "#28c76f";
}

function deliveredStatus()
{
    return "#28c76f";
}

function getStatusController()
{
    return [
        "paid" => "paidStatus",
        "pending" => "pendingStatus",
        "delivering" => "deliveringStatus",
        "delivered" => "deliveredStatus"
    ];
}


function getStatus($status)
{
    return getStatusController()[strtolower($status)]();
}
