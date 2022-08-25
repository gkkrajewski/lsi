<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220825085112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO public.report (id, name, date, username, placename) VALUES 
                ('1', 'test 1', '2020-06-23 19:12:25-07', 'Ola Mergi', 'Kraków'),
                ('2', 'test 2', '2020-07-23 19:14:25-07', 'Ania Ion', 'Wrocław'),
                ('3', 'test 3', '2020-08-23 19:16:25-07', 'Mio Opea', 'Warszawa'),
                ('4', 'test 4', '2020-10-23 19:20:25-07', 'Amanda Janu', 'Warszawa');
            "
        );

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            DELETE FROM public.report WHERE id IN (1,2,3,4);
            "
        );

    }
}
