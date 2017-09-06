BEGIN TRANSACTION;

CREATE TABLE `todo` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`subject`	TEXT NOT NULL,
	`status`	INTEGER NOT NULL,
	`created_at`	NUMERIC NOT NULL,
	`updated_at`	NUMERIC
);

INSERT INTO `todo` VALUES (1,'Create a demo with Slim 3',0,1504695625,NULL);
INSERT INTO `todo` VALUES (2,'Create a README.md file',1,1504695636,NULL);

CREATE TABLE `category` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`name`	TEXT NOT NULL,
	`created_at`	NUMERIC NOT NULL,
	`updated_at`	NUMERIC
);

INSERT INTO `category` VALUES (1,'Category 1',1504711816,NULL);
INSERT INTO `category` VALUES (2,'Category 2',1504711819,NULL);
INSERT INTO `category` VALUES (3,'Category 3',1504711910,NULL);
INSERT INTO `category` VALUES (4,'Category 4',1504711922,NULL);

CREATE TABLE `todo_category` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`todo_id`	INTEGER NOT NULL,
	`category_id`	INTEGER NOT NULL,
	`created_at`	NUMERIC NOT NULL
);

INSERT INTO `todo_category` VALUES (1,1,1,1504714096);
INSERT INTO `todo_category` VALUES (2,1,2,1504714500);
INSERT INTO `todo_category` VALUES (3,1,3,1504714502);

COMMIT;
