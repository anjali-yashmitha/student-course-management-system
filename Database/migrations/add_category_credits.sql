-- Check and add category column
SET @dbname = DATABASE();
SET @tablename = "course";
SET @columnname = "category";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      (table_name = @tablename)
      AND (table_schema = @dbname)
      AND (column_name = @columnname)
  ) > 0,
  "SELECT 1",
  "ALTER TABLE course ADD COLUMN category VARCHAR(50) DEFAULT 'programming' AFTER title"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- Check and add credits column
SET @columnname = "credits";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      (table_name = @tablename)
      AND (table_schema = @dbname)
      AND (column_name = @columnname)
  ) > 0,
  "SELECT 1",
  "ALTER TABLE course ADD COLUMN credits INT DEFAULT 1 AFTER category"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- Update existing rows with default values
UPDATE course SET category = 'programming' WHERE category IS NULL;
UPDATE course SET credits = 1 WHERE credits IS NULL;

-- Optional: Distribute sample data
UPDATE course 
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
WHERE category = 'programming' AND credits = 1;
