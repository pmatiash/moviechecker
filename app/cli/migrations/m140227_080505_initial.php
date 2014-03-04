<?php

class m140227_080505_initial extends CDbMigration
{
	public function up()
	{
        $sql = "
            CREATE TABLE IF NOT EXISTS `users` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(50) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `salt` VARCHAR(255) NOT NULL,
            `session` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`id`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB;

            CREATE UNIQUE INDEX user_name_idx on `users`(`name`);

             CREATE TABLE IF NOT EXISTS `movies` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `url` VARCHAR(255) NOT NULL,
            `genre` VARCHAR(255) NULL,
            `artist` VARCHAR(255) NULL,
            `title` VARCHAR(255) NULL,
            PRIMARY KEY (`id`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB;
        ";
        $this->execute($sql);
	}

	public function down()
	{
		echo "m140227_080505_initial does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}