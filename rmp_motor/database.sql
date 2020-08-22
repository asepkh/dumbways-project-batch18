-- create brand table
create table brand_tb (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(200) NOT NULL,
    PRIMARY KEY (id)
);

--  create motorcycle table
create table motorcycle_tb (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    brand_id int NOT NULL,
    image varchar(200),
    color varchar(200),
    specification varchar(200),
    stock int(15),
    PRIMARY KEY (id),
    FOREIGN KEY (brand_id) REFERENCES brand_tb(id)
);

-- create customer table
create table customer_tb (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(200) NOT NULL,
    address varchar(200) NOT NULL,
    phone varchar(200) NOT NULL,
    motorcycle_id int NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(motorcycle_id) REFERENCES motorcycle_tb(id)
);

-- insert brand type table
insert into brand_tb (name)
values
("Honda"),
("Yamaha"),
("Suzuki"),
("Kawasaki");

-- insert motorcycle table 
insert into motorcycle_tb (name, brand_id, image, color, specification, stock)
values
(1, 'Vario 110cc eSP', 1, 'https://static.wixstatic.com/media/116677_dddbecf26f2642d39b7db2b47a003cbb.png/v1/fill/w_455,h_445,al_c,q_95,usm_0.66_1.00_0.01/116677_dddbecf26f2642d39b7db2b47a003cbb.webp', 'Grande White', 'Tipe Kopling = Otomatis\r\nPanjang X Lebar X Tinggi = 1.888 x 679 x 1.091 mm\r\nKapasitas tangki bahan bakar = 3,7 liter', 5),
(2, 'FREEGO S VERSION ABS', 2, 'https://www.yamaha-motor.co.id/uploads/products/2020010716032844774W85632.png', 'Blue Navy', 'Tipe Kopling = Otomatis,\r\nTipe Mesin = Air Cooled 4-Stroke,SOHC, \r\nDiameter x Langkah	52,4 x 57,9 mm', 7),
(3, 'MIO S SMART & SOPHISTICATED', 2, 'https://www.yamaha-motor.co.id/uploads/products/tCpouemtB8EzqgRjVmQ7.png', 'Magnivicient Cyan', 'Tipe Kopling = Otomatis, LAMPU LED, ANSWER BACK SYSTEM, BAN TUBELESS DENGAN TAPAK LEBAR, MESIN BLUECORE 125 CC', 11),
(4, 'NINJA 250SL', 4, 'https://content2.kawasaki.com/ContentStorage/KMI/Products/4895/f17c0a99-a087-422f-ae54-c4807afeccb9.jpg?w=800', 'Green', 'Tipe Kopling = Manual,\r\nJenis Mesin = Liquid-cooled, 4-stroke Single, Sistem Pengapian Digital', 4),
(5, 'Satria F150', 3, 'https://suzukicdn.net/themes/default2019/img/motorcycle/all-new-satria-f150/main-blue.png', 'Matt Blue', 'Jenis Mesin = 4-tak, Liquid cooled,\r\nKapasitas Tangki = 4.0 liter,\r\nSistem Katup = DOHC 4-valve', 0);

-- insert customer table 
insert into customer_tb (name, address, phone, motorcycle_id)
values
("Asep Khairul Anam", "JL. Parkit Raya No.62, Bekasi", "081319796877", 1),
("Rediansyah Rahman", "JL. Cendrawasih No.17, Bekasi", "081282885431", 1),
("Rifa Nurrakhmah", "JL. Kasuari No.28", "089621961352", 1);

-- jawaban dari soal 4.1
select * from motorcycle_tb;

-- jawaban dari soal 4.2
select * from motorcycle_tb where brand_id=1;

-- jawaban dari soal 4.3
select customer_tb.name as customer_name, customer_tb.phone as customer_phone, customer_tb.address as customer_address, motorcycle_tb.name as motorcycle_name, brand_tb.name as brand_name
from customer_tb
inner join motorcycle_tb on customer_tb.motorcycle_id = motorcycle_tb.id
inner join brand_tb on brand_tb.id = motorcycle_tb.brand_id