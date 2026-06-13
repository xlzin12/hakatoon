import "reflect-metadata";
import path from "path";
import { DataSource } from "typeorm";
import { Aluno } from "../entities/Aluno";
import { Empresa } from "../entities/Empresa";
import { Vaga } from "../entities/Vaga";
import { Candidatura } from "../entities/Candidatura";

import dotenv from "dotenv";

dotenv.config();

const migrationsPath = path.join(__dirname, "migrations");

export const AppDataSource = new DataSource({
  type: "mysql",
  host: process.env.DATABASE_HOST || "localhost",
  port: Number(process.env.DATABASE_PORT || 3306),
  username: process.env.DATABASE_USER || "root",
  password: process.env.DATABASE_PASSWORD || "",
  database: process.env.DATABASE_NAME || "portal-estagios-unialfa",
  entities: [Aluno, Empresa, Vaga, Candidatura],
  migrations: [path.join(migrationsPath, "*.ts")],
  synchronize: false,
});
