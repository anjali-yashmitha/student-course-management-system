<?php
require_once "../Database.php";

function updateCourseTable()
{
    try {
        $db = new Database();
        $conn = $db->connect();

        // Check if columns exist first
        $result = $conn->query("SHOW COLUMNS FROM course LIKE 'category'");
        if ($result->rowCount() == 0) {
            $conn->exec("ALTER TABLE course ADD COLUMN category VARCHAR(50) DEFAULT 'programming' AFTER title");
        }

        $result = $conn->query("SHOW COLUMNS FROM course LIKE 'credits'");
        if ($result->rowCount() == 0) {
            $conn->exec("ALTER TABLE course ADD COLUMN credits INT DEFAULT 1 AFTER category");
        }

        // Update NULL values
        $conn->exec("UPDATE course SET category = 'programming' WHERE category IS NULL");
        $conn->exec("UPDATE course SET credits = 1 WHERE credits IS NULL");

        // Optional: Distribute sample data
        $conn->exec("UPDATE course 
                    SET category = CASE 
                        WHEN RAND() < 0.4 THEN 'programming'
                        WHEN RAND() < 0.7 THEN 'design'
                        ELSE 'business'
                    END,
                    credits = CASE 
                        WHEN RAND() < 0.5 THEN 1
                        WHEN RAND() < 0.8 THEN 2
                        ELSE 3
                    END
                    WHERE category = 'programming' AND credits = 1");

        echo "Course table updated successfully!";
        return true;

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Run the update
updateCourseTable();
