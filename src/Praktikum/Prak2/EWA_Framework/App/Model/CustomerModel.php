<?php 
declare(strict_types =1);

require_once 'App/Core/BaseModel.php';

class CustomerModel extends BaseModel{

  public function getAllOrdersWithStatus(): array {

    $sql = "
    SELECT 
    o.ordering_id,
    a.name AS article_name ,
    oa.status 
    FROM ordering o 
    JOIN ordered_article oa ON o.ordering_id = oa.ordering_id
    JOIN article a ON oa.article_id = a.article_id 
    ORDER BY o.ordering_id ASC 
    ";


$result = $this->db->query($sql);
if(!$result){
    throw new  exception('DB Query failed: ' .$this->db->error);
}

return $result->fetch_all(MYSQLI_ASSOC);
}
}