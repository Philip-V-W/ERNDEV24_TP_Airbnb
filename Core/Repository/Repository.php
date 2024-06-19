<?php

namespace Core\Repository;

use Core\Database\Database;
use Core\Database\DatabaseConfigInterface;
use PDO;

abstract class Repository
{
    //on crée une propriété privée qui contiendra l'instance de PDO
    protected PDO $pdo;

    abstract public function getTableName(): string;

    public function __construct(DatabaseConfigInterface $config)
    {
        $this->pdo = Database::getPDO($config);
    }

    //ici on peut définir des méthodes génériques pour les repositories

    /**
     * méthode qui récupère tous les éléments de la table
     * ex: SELECT * FROM table
     * @param string $class_name
     * @return array
     */
    public function readAll(string $class_name): array
    {
        //on déclare un tableau vide
        $array_result = [];
        //on crée notre requete SQL
        $q = sprintf('SELECT * FROM %s', $this->getTableName());
        //on execute la requete
        $stmt = $this->pdo->query($q);
        //si la requete n'est pas valide, on retourne un tableau vide
        if (!$stmt) return $array_result;
        //on récupère les données
        while ($row_data = $stmt->fetch()) {
            $array_result[] = new $class_name($row_data);
        }
        return $array_result;
    }


    /**
     * méthode qui récupère un élément de la table par son id
     * ex: SELECT * FROM table WHERE id = $id
     * @param string $class_name
     * @param int $id
     * @return object
     */
    public function readById(string $class_name, int $id): ?object
    {
        //on crée notre requete SQL
        $q = sprintf('SELECT * FROM %s WHERE id = :id', $this->getTableName());
        //on prépare la requete
        $stmt = $this->pdo->prepare($q);
        //on vérifie que la requete est bien bien préparée
        if (!$stmt) return null;
        //si tout est bon, on bind les valeurs
        $stmt->execute(['id' => $id]);
        $row_data = $stmt->fetch();

        return !empty($row_data) ? new $class_name($row_data) : null;
    }

    public function getAllTypes(): array
    {
        $q = sprintf('SELECT `id`, `label` FROM `%s`', $this->getTableName());
        $stmt = $this->pdo->prepare($q);
        if (!$stmt) return [];

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}