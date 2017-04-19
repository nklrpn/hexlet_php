-- Adding a column
ALTER TABLE products ADD COLUMN description text;
ALTER TABLE products DROP COLUMN description;

-- Adding a constraint
ALTER TABLE products ADD CONSTRAINT some_name UNIQUE (product_no);
ALTER TABLE products DROP CONSTRAINT some_name;

ALTER TABLE products ALTER COLUMN product_no SET NOT NULL;
ALTER TABLE products ALTER COLUMN product_no DROP NOT NULL;

-- Changing a coliumn's default value
ALTER TABLE products ALTER COLUMN price SET DEFAULT 7.77;
ALTER TABLE products ALTER COLUMN price DROP DEFAULT;

-- Changing a column's data type
ALTER TABLE products ALTER COLUMN price TYPE numeric(10,2);

-- Renaming a column
ALTER TABLE products RENAME COLUMN product_no TO product_number;

-- Renaming a table
ALTER TABLE products RENAME TO items;

--------------------------------------------------------------

-- Напишите запрос который изменит таблицу products так как описано ниже:
-- 
-- Поле name должно стать not null, unique и иметь тип character varying;
-- Добавьте поле amount типа integer;
-- Удалите default у поля price;
-- BEGIN
ALTER TABLE products ADD CONSTRAINT name_uniq UNIQUE (name);
ALTER TABLE products ALTER COLUMN name SET NOT NULL;
ALTER TABLE products ALTER COLUMN name TYPE varchar;
ALTER TABLE products ADD COLUMN amount int;
ALTER TABLE products ALTER COLUMN price DROP DEFAULT;
-- END

----------------------
-- BEGIN
ALTER TABLE products
    ADD CONSTRAINT name_uniq UNIQUE (name),
    ALTER COLUMN name SET NOT NULL,
    ALTER COLUMN name TYPE varchar,
    ADD COLUMN amount integer,
    ALTER COLUMN price DROP DEFAULT;
-- END