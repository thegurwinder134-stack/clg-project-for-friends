-- SQLite schema for Fashion Hub (College Project)

CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT,
  email TEXT UNIQUE,
  password TEXT,
  role TEXT DEFAULT 'user',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT,
  description TEXT,
  price REAL,
  image TEXT,
  category TEXT,
  brand_style TEXT,
  size TEXT,
  color TEXT,
  stock INTEGER DEFAULT 0,
  link TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cart (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER,
  product_id INTEGER,
  quantity INTEGER,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER,
  total REAL,
  status TEXT DEFAULT 'Pending',
  address TEXT,
  phone TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  order_id INTEGER,
  product_id INTEGER,
  quantity INTEGER,
  price REAL
);

CREATE TABLE wishlist (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER,
  product_id INTEGER
);