<?php

namespace App\services;

use Aura\SqlQuery\QueryFactory;
use PDO;


class QueryBuilder
{
    private PDO $pdo;
    private QueryFactory $queryFactory;

    public function __construct(PDO $pdo, QueryFactory $queryFactory)
    {
        $this->pdo = $pdo;
        $this->queryFactory = $queryFactory;
    }

    public function getMultiple(array $table, array $cols, array $joinCols, $paging, $numPage): array
    {
        $select = $this->queryFactory->newSelect();
        $select->cols($cols)
            ->from($table[0])
            ->join('INNER', $table[1], "$table[0].$joinCols[0] = $table[1].$joinCols[0]")
            ->setPaging($paging)
            ->page($numPage)
            ->orderBy(["$cols[1] DESC"]);



        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAllPosts(string $table)
    {
        $select = $this->queryFactory->newSelect();

        $select->cols(['count(*)'])->from($table);

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetch(PDO::FETCH_NUM);
    }

    public function getUserId(string $email, $table)
    {
        $select = $this->queryFactory -> newSelect ();
        $select->cols (['user_id'])
            ->from($table)
            ->where('email = :email')
            ->bindValues(['email' => $email]);


        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function insert(array $data, $table): bool
    {
        $insert = $this->queryFactory->newInsert();
        $insert->into($table);
        $insert->addRow($data);

        $sth = $this->pdo->prepare($insert->getStatement());

        return $sth->execute($insert->getBindValues());

    }

    public function checkUniqEmail(string $email, string $table)
    {
        $select = $this->queryFactory->newSelect();

        $select->cols([1])->from($table)->where('email = :email')->bindValues(['email' => $email]);

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetch(PDO::FETCH_NUM);
    }
}

