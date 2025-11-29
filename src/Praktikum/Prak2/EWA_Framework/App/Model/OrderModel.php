<?php
require_once 'App/Core/BaseModel.php';

class OrderModel extends BaseModel {
    /**
     * Fetch the full pizza menu from the database.
     * Returns an array of:
     * - article_id
     * - name
     * - picture
     * - price
     * @return array
     * @throws Exception
     */
    public function getMenu(): array {
        $sql = "SELECT article_id, name, picture, price FROM article";
        $result = $this->db->query($sql);

        if (!$result) {
            throw new Exception("Error reading article table: " . $this->db->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Create a new order.
     * 
     * steps:
     *  1. Insert into ordering (address only)
     *  2. Insert each selected pizza into ordered_article
     * 
     *  @param string $address
     *  @param array $pizzaIds
     *  @return int  The new ordering_id
     *  @throws Exception
     */
    public function createOrder(string $address, array $pizzaIds): int {
        if (trim($address) === '') {
            throw new Exception("Address cannot be empty.");
        }

        if (empty($pizzaIds)) {
            throw new Exception("No Pizzas selected.");
        }

        $sql = "INSERT INTO ordering (address) VALUES (?)";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            throw new Exception("Failed to prepare ordering INSERT: " . $this->db->error);
        }

        $stmt->bind_param("s", $address);
        $stmt->execute();

        if ($stmt->error) {
            throw new Exception("Error inserting into ordering: " . $stmt->error);
        }

        $orderId = $this->db->insert_id;
        $stmt->close();

        

        $sql = "INSERT INTO ordered_article (ordering_id, article_id, status)
                VALUES(?, ?, 0)";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            throw new Exception("Failed to prepare ordered_article INSERT: " . $this->db->error);
        }

        foreach ($pizzaIds as $pizzaId) {
            $stmt->bind_param("ii", $orderId, $pizzaId);
            $stmt->execute();

            if ($stmt->error) {
                throw new Exception("Error inserting into ordered_article: " . $stmt->error);
            }
        }

        $stmt->close();

        return $orderId;
    }
}
