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
     *
     * @return string The table name.
     */
    public function getTableName(): string
    {
        return 'media';
    }

    /**
     * Adds a media record to the database.
     *
     * @param array $data The data of the media to add.
     */
    public function addMedia(array $data): void
    {
        $sql = "INSERT INTO media (image_path, residence_id) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['image_path'],
            $data['residence_id']
        ]);
    }

    /**
     * Finds media records by residence ID.
     *
     * @param int $residenceId The ID of the residence.
     * @return array An array of Media objects.
     */
    public function findByResidenceId(int $residenceId): array
    {
        try {
            $q = 'SELECT * FROM media WHERE residence_id = :residence_id';
            $stmt = $this->pdo->prepare($q);

            if (!$stmt) {
                return [];
            }

            $stmt->execute(['residence_id' => $residenceId]);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Debugging line
            error_log("Media results for residence ID {$residenceId}: " . print_r($results, true));

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

    /**
     * Updates the images associated with a residence.
     *
     * @param int $residenceId The ID of the residence.
     * @param array $imagePaths An array of image paths to update.
     */
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

    /**
     * Retrieves image paths associated with a residence ID.
     *
     * @param int $residenceId The ID of the residence.
     * @return array An array of image paths.
     */
    public function getImagesByResidenceId(int $residenceId): array
    {
        $stmt = $this->pdo->prepare('SELECT image_path FROM media WHERE residence_id = :residence_id');
        $stmt->execute(['residence_id' => $residenceId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
