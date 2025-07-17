CREATE TABLE IF NOT EXISTS minerals (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  name VARCHAR(255) NOT NULL,
  origin VARCHAR(255),
  type VARCHAR(100),
  description TEXT,
  image VARCHAR(255),
  price NUMERIC(10, 2) NOT NULL,
  stock INTEGER DEFAULT 0
);
