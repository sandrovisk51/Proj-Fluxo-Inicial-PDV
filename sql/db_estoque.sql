/*
 Navicat Premium Data Transfer

 Source Server         : POSTEGRESQL
 Source Server Type    : PostgreSQL
 Source Server Version : 160001 (160001)
 Source Host           : localhost:5432
 Source Catalog        : db_estoque
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 160001 (160001)
 File Encoding         : 65001

 Date: 14/01/2024 17:12:07
*/


-- ----------------------------
-- Sequence structure for tb_ breakdowns_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tb_ breakdowns_id_seq";
CREATE SEQUENCE "public"."tb_ breakdowns_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tb_categories_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tb_categories_id_seq";
CREATE SEQUENCE "public"."tb_categories_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tb_coupons_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tb_coupons_id_seq";
CREATE SEQUENCE "public"."tb_coupons_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tb_lots_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tb_lots_id_seq";
CREATE SEQUENCE "public"."tb_lots_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tb_product_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tb_product_id_seq";
CREATE SEQUENCE "public"."tb_product_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tb_seel_products_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tb_seel_products_id_seq";
CREATE SEQUENCE "public"."tb_seel_products_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tb_taxes_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tb_taxes_id_seq";
CREATE SEQUENCE "public"."tb_taxes_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Table structure for tb_breakdowns
-- ----------------------------
DROP TABLE IF EXISTS "public"."tb_breakdowns";
CREATE TABLE "public"."tb_breakdowns" (
  "id" int8 NOT NULL DEFAULT nextval('"tb_ breakdowns_id_seq"'::regclass),
  "id_product" int8 NOT NULL,
  "quantity_damage" int2 NOT NULL DEFAULT 1,
  "details_breakdown" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "date_create" timestamp(6)
)
;

-- ----------------------------
-- Records of tb_breakdowns
-- ----------------------------

-- ----------------------------
-- Table structure for tb_categories
-- ----------------------------
DROP TABLE IF EXISTS "public"."tb_categories";
CREATE TABLE "public"."tb_categories" (
  "id" int4 NOT NULL DEFAULT nextval('tb_categories_id_seq'::regclass),
  "name_category" varchar(60) COLLATE "pg_catalog"."default" NOT NULL,
  "date_create" timestamp(6)
)
;

-- ----------------------------
-- Records of tb_categories
-- ----------------------------
INSERT INTO "public"."tb_categories" VALUES (24, 'Bebidas', '2024-01-14 15:15:58');
INSERT INTO "public"."tb_categories" VALUES (21, 'Congelados', '2024-01-12 16:57:16');

-- ----------------------------
-- Table structure for tb_coupons
-- ----------------------------
DROP TABLE IF EXISTS "public"."tb_coupons";
CREATE TABLE "public"."tb_coupons" (
  "id" int8 NOT NULL DEFAULT nextval('tb_coupons_id_seq'::regclass),
  "date" timestamp(6) NOT NULL,
  "operator" int2 NOT NULL,
  "total" numeric(10,2) NOT NULL,
  "payment_method" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "discount" numeric(10,2),
  "total_tax" numeric(10,2) NOT NULL,
  "amount_received" numeric(10,2)
)
;

-- ----------------------------
-- Records of tb_coupons
-- ----------------------------
INSERT INTO "public"."tb_coupons" VALUES (13, '2024-01-14 16:46:36', 1, 43.12, 'Dinheiro', NULL, 18.42, 50.00);

-- ----------------------------
-- Table structure for tb_lots
-- ----------------------------
DROP TABLE IF EXISTS "public"."tb_lots";
CREATE TABLE "public"."tb_lots" (
  "id" int8 NOT NULL DEFAULT nextval('tb_lots_id_seq'::regclass),
  "id_product" int8 NOT NULL,
  "batch" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "amount" int2 NOT NULL,
  "weight" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "due_date" date NOT NULL,
  "purchase_price" numeric(10,2) NOT NULL,
  "sale_value" numeric(10,2) NOT NULL,
  "tax" int4 NOT NULL,
  "date_create" timestamp(6)
)
;

-- ----------------------------
-- Records of tb_lots
-- ----------------------------
INSERT INTO "public"."tb_lots" VALUES (10, 28, '321654', 78, '1 litro', '2026-08-14', 4.56, 10.55, 31, '2024-01-14 16:30:29');
INSERT INTO "public"."tb_lots" VALUES (9, 27, '789654', 45, '3 Kilos', '2025-11-15', 5.63, 21.56, 28, '2024-01-12 16:14:27');

-- ----------------------------
-- Table structure for tb_product
-- ----------------------------
DROP TABLE IF EXISTS "public"."tb_product";
CREATE TABLE "public"."tb_product" (
  "id" int8 NOT NULL DEFAULT nextval('tb_product_id_seq'::regclass),
  "name" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "category" int4 NOT NULL,
  "bar_code" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "type" char(1) COLLATE "pg_catalog"."default" NOT NULL,
  "description" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "date_create" timestamp(6),
  "date_update" timestamp(6)
)
;

-- ----------------------------
-- Records of tb_product
-- ----------------------------
INSERT INTO "public"."tb_product" VALUES (28, 'Cerveja Heineken', 24, '963258741', 'L', 'Cerveja é uma bebida alcoólica carbonatada, produzida através da fermentação de materiais com amido, principalmente cereais maltados como a cevada e o trigo.', '2024-01-14 16:26:54', NULL);
INSERT INTO "public"."tb_product" VALUES (27, 'Frango Sales', 21, '147852369', 'S', 'Estrutura. São partes principais do frango: peito, coxa, sobrecoxa e asas. Também fazem parte, o coração, a moela e o fígado, porém estes geralmente são comercializados separadamente do frango em si.', '2024-01-12 15:59:52', NULL);

-- ----------------------------
-- Table structure for tb_seel_products
-- ----------------------------
DROP TABLE IF EXISTS "public"."tb_seel_products";
CREATE TABLE "public"."tb_seel_products" (
  "id" int8 NOT NULL DEFAULT nextval('tb_seel_products_id_seq'::regclass),
  "id_coupon" int8 NOT NULL,
  "id_product" int8 NOT NULL,
  "amount" int2 NOT NULL,
  "date" timestamp(6) NOT NULL
)
;

-- ----------------------------
-- Records of tb_seel_products
-- ----------------------------
INSERT INTO "public"."tb_seel_products" VALUES (10, 13, 27, 2, '2024-01-14 16:46:36');

-- ----------------------------
-- Table structure for tb_taxes
-- ----------------------------
DROP TABLE IF EXISTS "public"."tb_taxes";
CREATE TABLE "public"."tb_taxes" (
  "id" int4 NOT NULL DEFAULT nextval('tb_taxes_id_seq'::regclass),
  "percentage" float4 NOT NULL,
  "type" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "date_create" timestamp(6)
)
;

-- ----------------------------
-- Records of tb_taxes
-- ----------------------------
INSERT INTO "public"."tb_taxes" VALUES (29, 38.06, 'Achocolatados', '2024-01-14 15:32:59');
INSERT INTO "public"."tb_taxes" VALUES (28, 21.36, 'Congelados', '2024-01-12 16:57:57');
INSERT INTO "public"."tb_taxes" VALUES (31, 37.89, 'Cervejas', '2024-01-12 19:57:57');

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tb_ breakdowns_id_seq"
OWNED BY "public"."tb_breakdowns"."id";
SELECT setval('"public"."tb_ breakdowns_id_seq"', 6, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tb_categories_id_seq"
OWNED BY "public"."tb_categories"."id";
SELECT setval('"public"."tb_categories_id_seq"', 24, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tb_coupons_id_seq"
OWNED BY "public"."tb_coupons"."id";
SELECT setval('"public"."tb_coupons_id_seq"', 13, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tb_lots_id_seq"
OWNED BY "public"."tb_lots"."id";
SELECT setval('"public"."tb_lots_id_seq"', 10, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tb_product_id_seq"
OWNED BY "public"."tb_product"."id";
SELECT setval('"public"."tb_product_id_seq"', 28, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tb_seel_products_id_seq"
OWNED BY "public"."tb_seel_products"."id";
SELECT setval('"public"."tb_seel_products_id_seq"', 10, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."tb_taxes_id_seq"
OWNED BY "public"."tb_taxes"."id";
SELECT setval('"public"."tb_taxes_id_seq"', 31, true);

-- ----------------------------
-- Indexes structure for table tb_breakdowns
-- ----------------------------
CREATE UNIQUE INDEX "indx_id_breakdowns" ON "public"."tb_breakdowns" USING btree (
  "id" "pg_catalog"."int8_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table tb_breakdowns
-- ----------------------------
ALTER TABLE "public"."tb_breakdowns" ADD CONSTRAINT "tb_ breakdowns_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table tb_categories
-- ----------------------------
CREATE UNIQUE INDEX "indx_id_category" ON "public"."tb_categories" USING btree (
  "id" "pg_catalog"."int4_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table tb_categories
-- ----------------------------
ALTER TABLE "public"."tb_categories" ADD CONSTRAINT "tb_categories_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table tb_coupons
-- ----------------------------
CREATE UNIQUE INDEX "indx_id_coupons" ON "public"."tb_coupons" USING btree (
  "id" "pg_catalog"."int8_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table tb_coupons
-- ----------------------------
ALTER TABLE "public"."tb_coupons" ADD CONSTRAINT "tb_coupons_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table tb_lots
-- ----------------------------
CREATE UNIQUE INDEX "indx_id_lots" ON "public"."tb_lots" USING btree (
  "id" "pg_catalog"."int8_ops" ASC NULLS LAST
);
CREATE INDEX "indx_id_product" ON "public"."tb_lots" USING btree (
  "id_product" "pg_catalog"."int8_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table tb_lots
-- ----------------------------
ALTER TABLE "public"."tb_lots" ADD CONSTRAINT "tb_lots_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table tb_product
-- ----------------------------
CREATE INDEX "indx_bar_code_product" ON "public"."tb_product" USING btree (
  "bar_code" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST
);
CREATE UNIQUE INDEX "indx_id_products" ON "public"."tb_product" USING btree (
  "id" "pg_catalog"."int8_ops" ASC NULLS LAST
);
CREATE INDEX "indx_name" ON "public"."tb_product" USING btree (
  "name" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table tb_product
-- ----------------------------
ALTER TABLE "public"."tb_product" ADD CONSTRAINT "tb_produtos_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table tb_seel_products
-- ----------------------------
CREATE UNIQUE INDEX "indx_id_seel" ON "public"."tb_seel_products" USING btree (
  "id" "pg_catalog"."int8_ops" ASC NULLS LAST
);
CREATE INDEX "indx_id_seel_coupon" ON "public"."tb_seel_products" USING btree (
  "id_coupon" "pg_catalog"."int8_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table tb_seel_products
-- ----------------------------
ALTER TABLE "public"."tb_seel_products" ADD CONSTRAINT "tb_seel_products_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table tb_taxes
-- ----------------------------
CREATE INDEX "indx_id_taxes" ON "public"."tb_taxes" USING btree (
  "id" "pg_catalog"."int4_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table tb_taxes
-- ----------------------------
ALTER TABLE "public"."tb_taxes" ADD CONSTRAINT "tb_taxes_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Foreign Keys structure for table tb_breakdowns
-- ----------------------------
ALTER TABLE "public"."tb_breakdowns" ADD CONSTRAINT "frk_product" FOREIGN KEY ("id_product") REFERENCES "public"."tb_product" ("id") ON DELETE CASCADE ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table tb_lots
-- ----------------------------
ALTER TABLE "public"."tb_lots" ADD CONSTRAINT "frk_product" FOREIGN KEY ("id_product") REFERENCES "public"."tb_product" ("id") ON DELETE CASCADE ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table tb_seel_products
-- ----------------------------
ALTER TABLE "public"."tb_seel_products" ADD CONSTRAINT "frk_coupons" FOREIGN KEY ("id_coupon") REFERENCES "public"."tb_coupons" ("id") ON DELETE CASCADE ON UPDATE NO ACTION;
