<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190816152139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE articulo (id INT AUTO_INCREMENT NOT NULL, codart VARCHAR(15) DEFAULT NULL, codalt VARCHAR(15) DEFAULT NULL, descart VARCHAR(100) DEFAULT NULL, activo TINYINT(1) DEFAULT NULL, prcventa DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cabepedv (id INT AUTO_INCREMENT NOT NULL, representante_id INT DEFAULT NULL, cliente_id INT DEFAULT NULL, fecha DATE NOT NULL, observaciones LONGTEXT DEFAULT NULL, INDEX IDX_9FBDBAF12FD20D28 (representante_id), INDEX IDX_9FBDBAF1DE734E51 (cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clientes (id INT AUTO_INCREMENT NOT NULL, representante_id INT DEFAULT NULL, codcli VARCHAR(8) DEFAULT NULL, nomcli VARCHAR(100) DEFAULT NULL, dircli VARCHAR(60) DEFAULT NULL, pobcli VARCHAR(60) DEFAULT NULL, activo TINYINT(1) DEFAULT NULL, INDEX IDX_50FE07D72FD20D28 (representante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE linepedi (id INT AUTO_INCREMENT NOT NULL, pedido_id INT DEFAULT NULL, articulo_id INT DEFAULT NULL, unidades INT NOT NULL, INDEX IDX_8FB82BB44854653A (pedido_id), INDEX IDX_8FB82BB42DBC2FC9 (articulo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cabepedv ADD CONSTRAINT FK_9FBDBAF12FD20D28 FOREIGN KEY (representante_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cabepedv ADD CONSTRAINT FK_9FBDBAF1DE734E51 FOREIGN KEY (cliente_id) REFERENCES clientes (id)');
        $this->addSql('ALTER TABLE clientes ADD CONSTRAINT FK_50FE07D72FD20D28 FOREIGN KEY (representante_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE linepedi ADD CONSTRAINT FK_8FB82BB44854653A FOREIGN KEY (pedido_id) REFERENCES cabepedv (id)');
        $this->addSql('ALTER TABLE linepedi ADD CONSTRAINT FK_8FB82BB42DBC2FC9 FOREIGN KEY (articulo_id) REFERENCES articulo (id)');
        $this->addSql('ALTER TABLE user ADD nomrep VARCHAR(50) DEFAULT NULL, ADD codrep VARCHAR(8) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE linepedi DROP FOREIGN KEY FK_8FB82BB42DBC2FC9');
        $this->addSql('ALTER TABLE linepedi DROP FOREIGN KEY FK_8FB82BB44854653A');
        $this->addSql('ALTER TABLE cabepedv DROP FOREIGN KEY FK_9FBDBAF1DE734E51');
        $this->addSql('DROP TABLE articulo');
        $this->addSql('DROP TABLE cabepedv');
        $this->addSql('DROP TABLE clientes');
        $this->addSql('DROP TABLE linepedi');
        $this->addSql('ALTER TABLE user DROP nomrep, DROP codrep');
    }
}
