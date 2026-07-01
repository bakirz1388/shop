-- Security hardening migration
-- Run this against your existing shop_db database (phpMyAdmin > SQL tab,
-- or `mysql -u root shop_db < security_migration.sql`).

-- 1. Table used by includes/bootstrap.php to throttle login attempts
--    per IP address (see tooManyLoginAttempts()/recordFailedLoginAttempt()
--    in api/login_action.php).
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(45) NOT NULL,
  `attempted_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_ip_time` (`ip_address`, `attempted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional cleanup you can run periodically (e.g. via a cron job) to keep
-- this table small:
-- DELETE FROM login_attempts WHERE attempted_at < (NOW() - INTERVAL 1 DAY);

-- 2. The original db/shop_db.sql seed data stores PASSWORDS IN PLAIN TEXT
--    (e.g. '1234', '1388'). api/login_action.php already auto-upgrades any
--    plaintext password to a proper bcrypt hash the next time that user logs
--    in, so this isn't strictly required, but if you want the seed data
--    itself to be safe immediately (e.g. before the first login), run:
--
--    UPDATE `users` SET `pass` = '$2y$10$exampleHashReplaceThis...' WHERE user_id = 1;
--
--    Or, generate real hashes in PHP first:
--    php -r "echo password_hash('1388', PASSWORD_DEFAULT), PHP_EOL;"
--    and paste the result into the UPDATE statement for each user.
