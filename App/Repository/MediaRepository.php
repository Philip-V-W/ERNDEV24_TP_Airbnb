<?php

namespace App\Repository;

use Core\Repository\Repository;
use App\Model\Media;
use Exception;
use PDO;

class MediaRepository extends Repository
{
    /**
     * Returns the name of the table associated with the repository.
     * @return string The table name.
     */
    public function getTableName(): string
    {
        return 'media';
    }

    public function addMedia($data): void
    {
        $sql = "INSERT INTO media (image_path, residence_id) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['image_path'], $data['residence_id']
        ]);
    }

    public function findByResidenceId(int $residenceId): array
    {
        try {
            $q = 'SELECT * FROM media WHERE residence_id = :residence_id';
            $stmt = $this->pdo->prepare($q);

            if (!$stmt) return [];

            $stmt->execute(['residence_id' => $residenceId]);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("Media results for residence ID {$residenceId}: " . print_r($results, true)); // Debugging line

            $mediaList = [];
            foreach ($results as $result) {
                $mediaList[] = new Media($result);
            }

            return $mediaList;
        } catch (Exception $e) {
            error_log("Error finding media by residence ID: " . $e->getMessage());
            return [];
        }
    }

    public function updateResidenceImages(int $residenceId, array $imagePaths): void
    {
        // Delete existing images for the residence
        $stmt = $this->pdo->prepare('DELETE FROM media WHERE residence_id = :residence_id');
        $stmt->execute(['residence_id' => $residenceId]);

        // Insert new images
        $stmt = $this->pdo->prepare('INSERT INTO media (residence_id, image_path) VALUES (:residence_id, :image_path)');
        foreach ($imagePaths as $imagePath) {
            $stmt->execute([
                'residence_id' => $residenceId,
                'image_path' => $imagePath
            ]);
        }
    }


    public function getImagesByResidenceId(int $residenceId): array
    {
        $stmt = $this->pdo->prepare('SELECT image_path FROM media WHERE residence_id = :residence_id');
        $stmt->execute(['residence_id' => $residenceId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    public function deleteImageById(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM media WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }


}