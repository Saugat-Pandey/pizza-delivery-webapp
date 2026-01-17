<?php

require_once 'App/Core/BaseModel.php';

class BakerModel extends BaseModel {
    /**
     * Get all pizzas that are still relevant for the baker.
     * 
     * @return array
     * @throws Exception
     */
    public function getOpenPizzas(): array {
        $sql = "
            SELECT
                oa.ordered_article_id,
                oa.status,
                o.ordering_id,
                o.address,
                o.ordering_time,
                a.name       AS pizza_name,
                a.price
            FROM ordered_article oa
            JOIN ordering o ON oa.ordering_id = o.ordering_id
            JOIN article a ON oa.article_id = a.article_id
            WHERE oa.status < 3
            ORDER BY o.ordering_time ASC, oa.ordered_article_id ASC
        ";

        $result = $this->db->query($sql);

        if (!$result) {
            throw new Exception("Error loading baker data:" . $this->db->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Update the status of a single ordered pizza.
     * 
     * @param int $orderedArticleId
     * @param int $newStatus
     * @return bool
     * @throws Exception
     */
    public function updateStatus(int $orderedArticleId, int $newStatus): bool {
        $orderedArticleId = (int)$orderedArticleId;
        $newStatus = (int)$newStatus;
        
        $sql = "UPDATE ordered_article SET status = ? WHERE ordered_article_id = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            throw new Exception('Failed to prepare UPDATE in BakerModel: ' . $this->db->error);
        }

        $stmt->bind_param("ii", $newStatus, $orderedArticleId);
        $ok = $stmt->execute();

        if ($stmt->error) {
            throw new Exception('Error updating status: ' . $stmt->error);
        }

        $stmt->close();
        return $ok;
    }
}