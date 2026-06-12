import { MigrationInterface, QueryRunner } from "typeorm";

export class GerarEstrutura1781218695458 implements MigrationInterface {
    name = 'GerarEstrutura1781218695458'

    public async up(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(`CREATE TABLE \`empresas\` (\`id\` varchar(36) NOT NULL, \`cnpj\` varchar(255) NOT NULL, \`nomeFantasia\` varchar(255) NOT NULL, \`razaoSocial\` varchar(255) NOT NULL, \`emailCoportaivo\` varchar(255) NOT NULL, \`senhaHash\` varchar(255) NOT NULL, \`statusAprovacao\` varchar(255) NOT NULL DEFAULT 'PENDENTE', \`telefone\` varchar(255) NULL, \`descricaoEmpresa\` text NULL, \`website\` varchar(255) NULL, \`created_at\` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6), \`updated_at\` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6), UNIQUE INDEX \`IDX_f5ed71aeb4ef47f95df5f8830b\` (\`cnpj\`), UNIQUE INDEX \`IDX_0beaf7007699343f28c7fb9cbf\` (\`emailCoportaivo\`), PRIMARY KEY (\`id\`)) ENGINE=InnoDB`);
        await queryRunner.query(`CREATE TABLE \`vagas\` (\`id\` varchar(36) NOT NULL, \`titulo\` varchar(255) NOT NULL, \`descricao\` text NOT NULL, \`requisitos\` text NOT NULL, \`beneficios\` varchar(255) NULL, \`cargaHoraria\` varchar(255) NULL, \`localizacao\` varchar(255) NULL, \`ativa\` tinyint NOT NULL DEFAULT 1, \`created_at\` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6), \`updated_at\` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6), \`empresaId\` varchar(36) NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`);
        await queryRunner.query(`CREATE TABLE \`candidaturas\` (\`id\` varchar(36) NOT NULL, \`status\` varchar(255) NOT NULL DEFAULT 'RECEBIDO', \`created_at\` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6), \`updated_at\` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6), \`alunoId\` varchar(36) NULL, \`vagaId\` varchar(36) NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`);
        await queryRunner.query(`CREATE TABLE \`alunos\` (\`id\` varchar(36) NOT NULL, \`ra\` varchar(255) NOT NULL, \`nome\` varchar(255) NOT NULL, \`emailAcademico\` varchar(255) NOT NULL, \`curso\` varchar(255) NOT NULL, \`periodo\` varchar(255) NOT NULL, \`statusAptoEstagio\` tinyint NOT NULL DEFAULT 0, \`telefone\` varchar(255) NOT NULL, \`senha\` varchar(255) NOT NULL, \`primeiroAcesso\` tinyint NOT NULL DEFAULT 1, \`resumoProfissional\` text NULL, \`linksSociais\` text NULL, \`habilidades\` text NULL, \`projetosExtensao\` json NULL, \`certificados\` json NULL, \`experienciaPrevia\` text NULL, \`created_at\` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6), \`updated_at\` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6), UNIQUE INDEX \`IDX_10966272854c55f95c9f941828\` (\`ra\`), UNIQUE INDEX \`IDX_c1f261c0107028ba10a1b4081f\` (\`emailAcademico\`), PRIMARY KEY (\`id\`)) ENGINE=InnoDB`);
        await queryRunner.query(`ALTER TABLE \`vagas\` ADD CONSTRAINT \`FK_61e2c2c348c984194644c17d5ab\` FOREIGN KEY (\`empresaId\`) REFERENCES \`empresas\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`);
        await queryRunner.query(`ALTER TABLE \`candidaturas\` ADD CONSTRAINT \`FK_1a8b17e64dbe67d674b2b135fa1\` FOREIGN KEY (\`alunoId\`) REFERENCES \`alunos\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`);
        await queryRunner.query(`ALTER TABLE \`candidaturas\` ADD CONSTRAINT \`FK_b74e588e756926be854b99f3405\` FOREIGN KEY (\`vagaId\`) REFERENCES \`vagas\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`);
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(`ALTER TABLE \`candidaturas\` DROP FOREIGN KEY \`FK_b74e588e756926be854b99f3405\``);
        await queryRunner.query(`ALTER TABLE \`candidaturas\` DROP FOREIGN KEY \`FK_1a8b17e64dbe67d674b2b135fa1\``);
        await queryRunner.query(`ALTER TABLE \`vagas\` DROP FOREIGN KEY \`FK_61e2c2c348c984194644c17d5ab\``);
        await queryRunner.query(`DROP INDEX \`IDX_c1f261c0107028ba10a1b4081f\` ON \`alunos\``);
        await queryRunner.query(`DROP INDEX \`IDX_10966272854c55f95c9f941828\` ON \`alunos\``);
        await queryRunner.query(`DROP TABLE \`alunos\``);
        await queryRunner.query(`DROP TABLE \`candidaturas\``);
        await queryRunner.query(`DROP TABLE \`vagas\``);
        await queryRunner.query(`DROP INDEX \`IDX_0beaf7007699343f28c7fb9cbf\` ON \`empresas\``);
        await queryRunner.query(`DROP INDEX \`IDX_f5ed71aeb4ef47f95df5f8830b\` ON \`empresas\``);
        await queryRunner.query(`DROP TABLE \`empresas\``);
    }

}
