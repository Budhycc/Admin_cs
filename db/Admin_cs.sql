-- Buat database
CREATE DATABASE IF NOT EXISTS Admin_cs;
USE Admin_cs;

-- Tabel Galery
CREATE TABLE IF NOT EXISTS Galery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    img VARCHAR(255),
    jutul VARCHAR(255),
    deskripsi TEXT,
    kategori VARCHAR(255)
);

-- Tabel akreditas
CREATE TABLE IF NOT EXISTS akreditas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255),
    masa INT,
    link VARCHAR(255)
);

-- Tabel User
CREATE TABLE IF NOT EXISTS User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    password VARCHAR(255)
);

-- Tabel kategori
CREATE TABLE IF NOT EXISTS kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(255)
);

-- Tabel dosen
CREATE TABLE IF NOT EXISTS dosen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_dosen VARCHAR(255),
    jabatan VARCHAR(255),
    pangkat VARCHAR(255),
    keahlian VARCHAR(255),
    img VARCHAR(255)
);