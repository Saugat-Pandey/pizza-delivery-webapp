<?php 
declare(strict_types =1);

require_once 'App/Core/BaseModel.php';

class CustomerModel extends BaseModel{

  public function getOrdersByOrderId(int $orderId): array {
    $orderId = (int)$orderId;

    $sql = "
    SELECT 
    o.ordering_id,
    a.name AS article_name ,
    oa.status 
    FROM ordering o 
    JOIN ordered_article oa ON o.ordering_id = oa.ordering_id
    JOIN article a ON oa.article_id = a.article_id
    WHERE o.ordering_id = $orderId
    ORDER BY oa.ordered_article_id ASC 
    ";


$result = $this->db->query($sql);
if(!$result){
    throw new  exception('DB Query failed: ' .$this->db->error);
}

return $result->fetch_all(MYSQLI_ASSOC);
}
}