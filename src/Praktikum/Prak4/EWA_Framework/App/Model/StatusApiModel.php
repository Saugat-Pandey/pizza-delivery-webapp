<?php 
require_once 'App/Core/BaseModel.php';

class StatusApiModel extends BaseModel {

    public function getStatusByOrderId(int $orderId): array {
        $orderId = (int)$orderId;

        $sql = "
            SELECT
                oa.ordered_article_id,
                a.name AS pizza_name,
                oa.status
            FROM ordered_article oa
            JOIN article a ON oa.article_id = a.article_id
            WHERE oa.ordering_id = $orderId
            ORDER BY oa.ordered_article_id ASC
            ";    

        $result = $this->db->query($sql);

        if (!$result) {
            throw new Exception("Database error: " . $this->db->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
        