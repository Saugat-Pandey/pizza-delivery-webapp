<?php 
declare (strict_types=1);

require_once 'App/Core/BaseModel.php';

class DriverModel extends BaseModel{
    
    public function getOpenOrders():array
    {
    $sql= "
    SELECT 
    o.ordering_id,
    o.address,
    o.ordering_time,
    a.name As article_name,
    a.picture AS article_picture,
    a.price AS article_price,
    oa.status
    FROM ordering o 
    JOIN ordered_article oa on o.ordering_id = oa.ordering_id
    JOIN article a on oa.article_id = a.article_id
    ORDER BY o.ordering_time ASC, o.ordering_id ASC 

    ";
    $result = $this->db->query($sql);
    if(!$result){
        throw new Exception('DB Query failed: '. $this->db->error);

    }

    $rows =$result->fetch_all(MYSQLI_ASSOC);

    $orders = [];

    foreach($rows as $row){
        $id = (int)$row['ordering_id'];
        $status=(int)$row['status'];
        if(!isset($orders[$id])){
            $orders[$id]= [
                'ordering_id' => $id,
                'address' => $row['address'],
                'ordering_time' => $row['ordering_time'],
                'articles'    => [],
                'total_price' => 0.0,
                'min_status'      => $status,
                'max_status'  => $status,
                
             ];
        }

        $orders[$id]['articles'][] = [
            'name' => $row['article_name'],
            'picture' => $row['article_picture'],
            'price' => (float)$row['article_price'],
        ];
        $orders[$id]['total_price'] += (float)$row['article_price'];
        $orders[$id]['min_status'] =min($orders[$id]['min_status'],$status);
        $orders[$id]['max_status'] =max($orders[$id]['max_status'],$status);

    }
    $readyForDriver =[];
    foreach($orders as $order){
        if($order['min_status'] >=2 && $order['max_status'] < 4){

            $order['status']= $order['max_status'];
            unset($order['min_status'], $order['max_status']);
            $readyForDriver[] =$order;
        }
    }


    return $readyForDriver;
    
}

    public function updateOrderStatus(int $orderingId, int $status): void {
        $stmt = $this->db->prepare(
            "UPDATE ordered_article SET status = ? WHERE ordering_id = ?");
        
        if(!$stmt){
            throw new Exception('Prepare failed: ' .$this->db->error);
        }
        
        $stmt->bind_param('ii', $status, $orderingId);
        if(!$stmt->execute()){
            throw new Exception('Execute failed:' .$stmt->error);
        }
        $stmt->close();
    }


    public function deleteOrder(int $orderingId):void {
        //zurerst Kindtabelle 
        $stmt = $this->db->prepare(
            "DELETE FROM ordered_article where ordering_id = ?"
        );
        if(!$stmt){
            throw new Exception('Prepare failed: ' .$this->db->error);
        }

        $stmt->bind_param('i',$orderingId);
        $stmt->execute();
        $stmt->close();
        
        $stmt =$this->db->prepare(
            "DELETE FROM ordering where ordering_id = ?"
        );
        if(!$stmt){
            throw new Exception('prepare failed:' .$this->db->error);
        }
        $stmt->bind_param('i', $orderingId);
        $stmt->execute();
        $stmt->close();
    }
}
